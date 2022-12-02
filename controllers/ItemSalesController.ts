import catchAsyncErrors from "../middlewares/catchAsyncErrors"
import { NextApiRequest, NextApiResponse } from "next"
import prisma from "../lib/prisma"
import { ItemSaleData } from "../types"

const getAllItemSales = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  const itemSales = await prisma.itemSale.findMany()

  res.status(200).json({
    status: "success",
    data: {
      itemSales,
    },
  })
})

const handleAuctionItem = async (itemTitle: string, categoryName: string) => {
  const lowerCaseItemTitle = itemTitle.toLowerCase()
  const lowerCaseCategory = categoryName.toLowerCase()
  let item = await prisma.auctionItem.findFirst({
    where: {
      name: lowerCaseItemTitle,
    },
  })
  let category = await prisma.category.findFirst({
    where: {
      name: lowerCaseCategory,
    },
  })
  if (!category) {
    category = await prisma.category.create({
      data: {
        name: lowerCaseCategory,
      },
    })
  }
  if (!item) {
    item = await prisma.auctionItem.create({
      data: {
        name: lowerCaseItemTitle,
        categoryId: category.id,
      },
    })
  }
  return item
}

const handleLocation = async (address: string) => {
  const lowerCaseAddress = address.toLowerCase()
  let location = await prisma.location.findFirst({
    where: {
      address: lowerCaseAddress,
    },
  })
  if (!location) {
    location = await prisma.location.create({
      data: {
        address: lowerCaseAddress,
      },
    })
  }
  return location
}

const handleTaxName = async (taxName: string | undefined) => {
  if (taxName === undefined) return
  const lowerCaseName = taxName.toLowerCase()
  let tax = await prisma.tax.findFirst({
    where: {
      name: lowerCaseName,
    },
  })
  if (!tax) {
    tax = await prisma.tax.create({
      data: {
        name: lowerCaseName,
      },
    })
  }
  return tax
}

const handleCondition = async (description: string) => {
  const lowerCaseDesc = description.toLowerCase()
  let condition = await prisma.condition.findFirst({
    where: {
      description: lowerCaseDesc,
    },
  })
  if (!condition) {
    condition = await prisma.condition.create({
      data: {
        description: lowerCaseDesc,
      },
    })
  }
  return condition
}

const postItemSales = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  const itemSalesData = await Promise.all(
    req.body.data.map(async (itemSale: ItemSaleData) => {
      const item = await handleAuctionItem(itemSale.auctionItem, itemSale.category)
      const location = await handleLocation(itemSale.location)
      const tax = await handleTaxName(itemSale.tax)
      const condition = await handleCondition(itemSale.condition)
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
  const itemSales = await prisma.itemSale.createMany({
    data: itemSalesData,
  })
  res.status(200).json({
    status: "success",
    data: itemSales,
  })
})

export { getAllItemSales, postItemSales }
