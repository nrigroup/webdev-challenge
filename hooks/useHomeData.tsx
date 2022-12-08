import { useMemo, useState } from "react"
import { get } from "../utils"
import { useAddItemSales } from "./mutations"
import { useCategories, useConditions, useItemSales } from "./queries"
import { format } from "timeago.js"
import ErrorToast from "../components/ErrorToast"

const useHomeData = () => {
  const [queryErrors, setQueryErrors] = useState()
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

  const errorToasts = useMemo(() => {
    const errors = []

    if (totalSalesPerDay.isError) {
      const updated = format(totalSalesPerDay.errorUpdatedAt, "en_US")
      errors.push(
        <ErrorToast
          key="error-1"
          message="There was an error fetching daily pre-tax totals."
          updatedAt={updated}
        />,
      )
    } else if (totalSalesByCategory.isError) {
      const updated = format(totalSalesByCategory.errorUpdatedAt, "en_US")
      errors.push(
        <ErrorToast
          key="error-2"
          message="There was an error fetching category pre-tax totals."
          updatedAt={updated}
        />,
      )
    } else if (totalSalesByCondition.isError) {
      const updated = format(totalSalesByCondition.errorUpdatedAt, "en_US")
      errors.push(
        <ErrorToast
          key="error-3"
          message="There was an error fetching condition pre-tax totals."
          updatedAt={updated}
        />,
      )
    }

    return errors
  }, [
    totalSalesByCategory.errorUpdatedAt,
    totalSalesByCategory.isError,
    totalSalesPerDay.errorUpdatedAt,
    totalSalesPerDay.isError,
    totalSalesByCondition.isError,
    totalSalesByCondition.errorUpdatedAt,
  ])

  return {
    addItemSales,
    totalSalesPerDay,
    totalSalesPerDayData,
    totalSalesByCategory,
    totalSalesByCategoryData,
    totalSalesByCondition,
    totalSalesByConditionData,
    errorToasts,
  }
}

export default useHomeData
