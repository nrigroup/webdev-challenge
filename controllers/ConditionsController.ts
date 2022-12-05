import { NextApiRequest, NextApiResponse } from "next"
import prisma from "../lib/prisma"
import catchAsyncErrors from "../middlewares/catchAsyncErrors"

const getConditionsSaleTotals = catchAsyncErrors(
  async (req: NextApiRequest, res: NextApiResponse) => {
    const results = []
    const conditionsSaleTotals = await prisma.itemSale.groupBy({
      by: ["conditionId"],
      _sum: {
        preTaxAmount: true,
      },
    })
    for (const sum of conditionsSaleTotals) {
      const condition = await prisma.condition.findUnique({
        where: {
          id: sum.conditionId,
        },
      })
      results.push({ ...sum, condition })
    }
    res.status(200).json({
      status: "success",
      data: results,
    })
  },
)

export { getConditionsSaleTotals }
