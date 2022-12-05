import catchAsyncErrors from "../middlewares/catchAsyncErrors"
import { NextApiRequest, NextApiResponse } from "next"
import prisma from "../lib/prisma"
import { ItemSaleData, ItemSaleRelation } from "../types"
import * as fs from "fs"
import csv from "csv-parser"

const getAllItemSales = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  const { orderBy, direction } = req.query
  const itemSales = await prisma.itemSale.findMany({
    orderBy: {
      [orderBy ? (orderBy as string) : "id"]: direction ? direction : "asc",
    },
  })

  res.status(200).json({
    status: "success",
    data: {
      itemSales,
    },
  })
})

const getItemSale = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  const { itemSaleId } = req.query
  if (itemSaleId === undefined) return
  if (typeof itemSaleId === typeof "string") {
    const itemSales = await prisma.itemSale.findUnique({
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
      data: itemSales,
    })
  }
})

// TODO merge these into one handleitemSaleRelations func to dry up code

const handleCategory = async (name: string) => {
  let category = await prisma.category.findFirst({
    where: {
      name: {
        equals: name,
        mode: "insensitive",
      },
    },
  })
  if (!category) {
    category = await prisma.category.create({
      data: {
        name,
      },
    })
  }
  return category
}

const handleAuctionItem = async (itemTitle: string, categoryId: number) => {
  let item = await prisma.auctionItem.findFirst({
    where: {
      name: {
        equals: itemTitle,
        mode: "insensitive",
      },
    },
  })
  if (!item) {
    item = await prisma.auctionItem.create({
      data: {
        name: itemTitle,
        categoryId,
      },
    })
  }
  return item
}

const handleLocation = async (address: string) => {
  let location = await prisma.location.findFirst({
    where: {
      address: {
        equals: address,
        mode: "insensitive",
      },
    },
  })
  if (!location) {
    location = await prisma.location.create({
      data: {
        address,
      },
    })
  }
  return location
}

const handleTaxName = async (taxName: string | undefined) => {
  if (taxName === undefined) return
  let tax = await prisma.tax.findFirst({
    where: {
      name: {
        equals: taxName,
        mode: "insensitive",
      },
    },
  })
  if (!tax) {
    tax = await prisma.tax.create({
      data: {
        name: taxName,
      },
    })
  }
  return tax
}

const handleCondition = async (description: string) => {
  let condition = await prisma.condition.findFirst({
    where: {
      description: {
        equals: description,
        mode: "insensitive",
      },
    },
  })
  if (!condition) {
    condition = await prisma.condition.create({
      data: {
        description,
      },
    })
  }
  return condition
}

// const handleRelation = async (
//   modelName: ItemSaleRelation,
//   propName: string,
//   propValue: string,
//   categoryId?: number,
// ) => {
//   if (modelName === ItemSaleRelation.tax && propValue === undefined) return
//   let record = await prisma[modelName].findFirst({
//     where: {
//       [propName]: propValue,
//     },
//   })
//   if (!record) {
//     if (modelName === ItemSaleRelation.auctionItem && categoryId !== undefined) {
//       record = await prisma[modelName].create({
//         data: {
//           name: propValue,
//           categoryId,
//         },
//       })
//     } else {
//       record = await prisma[modelName].create({
//         data: {
//           [propName]: propValue,
//         },
//       })
//     }
//   }
//   return record
// }

const handleItemSaleRelations = async (itemSale: ItemSaleData) => {
  const category = await handleCategory(itemSale.category)
  const item = await handleAuctionItem(itemSale.auctionItem, category.id)
  const location = await handleLocation(itemSale.location)
  const tax = await handleTaxName(itemSale.tax)
  const condition = await handleCondition(itemSale.condition)

  return { item, location, tax, condition }
}

const postItemSales = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  fs.writeFileSync("data", req.body)
  const results: ItemSaleData[] = []
  fs.createReadStream("data")
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
          } else if (header === "preTaxAmount" || header === "taxAmount") {
            return parseFloat(value)
          }
          return value
        },
      }),
    )
    .on("data", (data) => results.push(data))
    .on("end", async () => {
      fs.unlinkSync("data")

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

      const itemSalesData = await Promise.all(
        filteredResults.map(async (itemSale: ItemSaleData) => {
          const { item, location, tax, condition } = await handleItemSaleRelations(itemSale)
          return {
            date: itemSale.date,
            preTaxAmount: itemSale.preTaxAmount,
            taxAmount: itemSale.taxAmount,
            itemId: item.id,
            locationId: location.id,
            conditionId: condition.id,
            taxId: tax ? tax.id : undefined,
          }
        }),
      )
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
