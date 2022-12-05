import prisma from "../lib/prisma"
import { ItemSaleData } from "../types"

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

export const handleItemSaleRelations = async (itemSale: ItemSaleData) => {
  const category = await handleCategory(itemSale.category)
  const item = await handleAuctionItem(itemSale.auctionItem, category.id)
  const location = await handleLocation(itemSale.location)
  const tax = await handleTaxName(itemSale.tax)
  const condition = await handleCondition(itemSale.condition)

  return { item, location, tax, condition }
}