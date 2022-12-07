import { useMutation, UseMutationOptions } from "@tanstack/react-query"
import { Params } from "next/dist/shared/lib/router/utils/route-matcher"
import { ItemSaleData } from "../../types"
import { post } from "../../utils"

export const useAddItemSales = (
  params: Params = {},
  useMutationOptions: UseMutationOptions<
    any,
    unknown,
    ItemSaleData[],
    unknown
  > = {},
) => {
  return useMutation({
    mutationKey: ["itemSales"],
    mutationFn: (itemSalesData: ItemSaleData[]) =>
      post({
        route: "/itemSales",
        body: JSON.stringify(itemSalesData),
        params,
      }),
    ...useMutationOptions,
  })
}
