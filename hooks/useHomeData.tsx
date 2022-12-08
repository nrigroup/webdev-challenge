import { useMemo } from "react"
import { get } from "../utils"
import { useAddItemSales } from "./mutations"
import { useCategories, useConditions, useItemSales } from "./queries"

const useHomeData = () => {
  const addItemSales = useAddItemSales()

  const totalSalesPerDay = useItemSales(
    {
      groupBy: "date",
      orderBy: "date",
      sum: "preTaxAmount",
    },
    { queryKey: ["itemSalesDailyTotals"] },
  )
  const totalSalesByCategory = useCategories(
    {},
    { queryKey: ["categoriesTotalSales"], queryFn: () => get({ route: "/categories/totalSales" }) },
  )
  const totalSalesByCondition = useConditions(
    {},
    { queryKey: ["conditionsTotalSales"], queryFn: () => get({ route: "/conditions/totalSales" }) },
  )

  const totalSalesPerDayData = useMemo(
    () =>
      totalSalesPerDay.data?.data.map((row) => {
        row.date = new Date(row.date).toLocaleDateString("en-US")
        row._sum.preTaxAmount = parseFloat(row._sum.preTaxAmount as unknown as string)
        return row
      }),
    [totalSalesPerDay.data],
  )

  const totalSalesByCategoryData = useMemo(
    () =>
      totalSalesByCategory.data?.data.map((row) => {
        row._sum.preTaxAmount = parseFloat(row._sum.preTaxAmount as unknown as string)
        return row
      }),
    [totalSalesByCategory.data],
  )

  const totalSalesByConditionData = useMemo(
    () =>
      totalSalesByCondition.data?.data.map((row) => {
        row._sum.preTaxAmount = parseFloat(row._sum.preTaxAmount as unknown as string)
        return row
      }),
    [totalSalesByCondition.data],
  )

  return {
    addItemSales,
    totalSalesPerDay,
    totalSalesPerDayData,
    totalSalesByCategory,
    totalSalesByCategoryData,
    totalSalesByCondition,
    totalSalesByConditionData,
  }
}

export default useHomeData
