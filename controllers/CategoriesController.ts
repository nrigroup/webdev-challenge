import { NextApiRequest, NextApiResponse } from "next"
import prisma from "../lib/prisma"
import catchAsyncErrors from "../middlewares/catchAsyncErrors"

const getAllCategories = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  const { orderBy, direction, limit, groupBy, sum } = req.query
  const categories = groupBy
    ? await prisma.category.groupBy({
        by: Array.isArray(groupBy) ? groupBy : ([groupBy] as any),
        orderBy: orderBy ? { [orderBy as string]: direction ? direction : "asc" } : undefined,
        take: limit ? parseInt(limit as string) : undefined,
        _sum: sum ? { [sum as string]: true } : undefined,
      })
    : await prisma.category.findMany({
        orderBy: orderBy ? { [orderBy as string]: direction ? direction : "asc" } : undefined,
        take: limit ? parseInt(limit as string) : undefined,
        include: {
          itemSale: true,
          auctionItem: true,
        },
      })

  res.status(200).json({
    status: "success",
    data: categories,
  })
})

const getCategorySaleTotals = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  const results = []
  const categorySalesSums = await prisma.itemSale.groupBy({
    by: ["categoryId"],
    _sum: {
      preTaxAmount: true,
    },
  })
  for (const sum of categorySalesSums) {
    const category = await prisma.category.findUnique({
      where: {
        id: sum.categoryId,
      },
    })
    results.push({ ...sum, category })
  }
  res.status(200).json({
    status: "success",
    data: results,
  })
})

const getCategory = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  const { categoryId } = req.query
  if (categoryId === undefined) return
  if (typeof categoryId === typeof "string") {
    const category = await prisma.category.findUnique({
      where: {
        id: parseInt(categoryId as string),
      },
      include: {
        auctionItem: true,
        itemSale: true,
      },
    })

    res.status(200).json({
      status: "success",
      data: category,
    })
  }
})

export { getAllCategories, getCategory, getCategorySaleTotals }
