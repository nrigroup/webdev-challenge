import catchAsyncErrors from "../middlewares/catchAsyncErrors"
import { NextApiRequest, NextApiResponse } from "next"
import prisma from "../lib/prisma"
import { ItemSaleData } from "../types"
import * as fs from "fs"
import csv from "csv-parser"
import { handleItemSaleRelations } from "../utils/recordUpdateHandlers"
import stripBom from "strip-bom-stream"

const getAllItemSales = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  const { orderBy, direction, limit, groupBy, sum } = req.query
  const itemSales = groupBy
    ? await prisma.itemSale.groupBy({
        by: Array.isArray(groupBy) ? groupBy : ([groupBy] as any),
        orderBy: orderBy ? { [orderBy as string]: direction ? direction : "asc" } : undefined,
        take: limit ? parseInt(limit as string) : undefined,
        _sum: sum ? { [sum as string]: true } : undefined,
      })
    : await prisma.itemSale.findMany({
        orderBy: orderBy ? { [orderBy as string]: direction ? direction : "asc" } : undefined,
        take: limit ? parseInt(limit as string) : undefined,
        include: {
          item: true,
          category: true,
          location: true,
          tax: true,
          condition: true,
        },
      })

  console.log("req.query: ", req.query)

  res.status(200).json({
    status: "success",
    data: itemSales,
  })
})

const getItemSale = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  const { itemSaleId } = req.query
  if (itemSaleId === undefined) return
  if (typeof itemSaleId === typeof "string") {
    const itemSale = await prisma.itemSale.findUnique({
      where: {
        id: parseInt(itemSaleId as string),
      },
      include: {
        item: {
          include: {
            category: true,
          },
        },
        location: true,
        tax: true,
        condition: true,
      },
    })

    res.status(200).json({
      status: "success",
      data: itemSale,
    })
  }
})

const postItemSales = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  fs.writeFileSync("data", req.body)
  const results: ItemSaleData[] = []
  fs.createReadStream("data")
    .pipe(stripBom())
    .pipe(
      csv({
        skipComments: true,
        skipLines: 4,
        mapHeaders: ({ header }) => {
          switch (header) {
            case "lot title":
              return "auctionItem"
            case "lot location":
              return "location"
            case "lot condition":
              return "condition"
            case "pre-tax amount":
              return "preTaxAmount"
            case "tax amount":
              return "taxAmount"
            case "tax name":
              return "tax"
            default:
              return header
          }
        },
        mapValues: ({ header, value }) => {
          // TODO write validation to check for required columns
          if (header === "date") {
            return new Date(value)
          } else if (!isNaN(value)) {
            return parseFloat(value)
          }
          return value
        },
      }),
    )
    .on("data", (data) => results.push(data))
    .on("end", async () => {
      // delete file
      fs.unlinkSync("data")

      // filter out invalid rows
      const filteredResults = results.filter((row) => {
        if (Object.prototype.toString.call(row.date) === "[object Date]") {
          if (isNaN(row.date as unknown as number)) {
            return false
          }
          return true
        } else {
          return false
        }
      })

      const itemSalesData: any[] = []
      for (const itemSale of filteredResults) {
        const { item, category, location, tax, condition } = await handleItemSaleRelations(itemSale)
        itemSalesData.push({
          date: itemSale.date,
          preTaxAmount: itemSale.preTaxAmount,
          taxAmount: itemSale.taxAmount,
          itemId: item.id,
          categoryId: category.id,
          locationId: location.id,
          conditionId: condition.id,
          taxId: tax ? tax.id : undefined,
        })
      }

      // create new item sale records
      const { count } = await prisma.itemSale.createMany({
        data: itemSalesData,
      })
      // fetch new item sales
      const itemSales = await prisma.itemSale.findMany({
        orderBy: [
          {
            updatedAt: "desc",
          },
        ],
        take: count,
      })
      res.status(200).json({
        status: "success",
        data: itemSales,
      })
    })
})

export { getAllItemSales, postItemSales, getItemSale }
