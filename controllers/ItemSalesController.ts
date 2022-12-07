import catchAsyncErrors from "../middlewares/catchAsyncErrors"
import { NextApiRequest, NextApiResponse } from "next"
import prisma from "../lib/prisma"
import { handleItemSaleRelations } from "../utils/recordUpdateHandlers"

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
  const itemSalesData: any[] = []
  for (const itemSale of req.body) {
    // convert values to valid schema format
    itemSale.date = new Date(itemSale.date)
    itemSale.preTaxAmount = parseFloat(itemSale.preTaxAmount)
    if (itemSale.taxAmount) {
      itemSale.taxAmount = parseFloat(itemSale.taxAmount)
    }

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

export { getAllItemSales, postItemSales, getItemSale }
