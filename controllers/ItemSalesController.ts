import catchAsyncErrors from "../middlewares/catchAsyncErrors"
import { NextApiRequest, NextApiResponse } from "next"
import prisma from "../lib/prisma"

const getAllItemSales = catchAsyncErrors(async (req: NextApiRequest, res: NextApiResponse) => {
  const itemSales = await prisma.itemSale.findMany()

  res.status(200).json({
    status: "success",
    data: {
      itemSales,
    },
  })
})

export { getAllItemSales }
