import { useMutation, UseMutationOptions } from "@tanstack/react-query"
import { Params } from "next/dist/shared/lib/router/utils/route-matcher"
import { post } from "../../utils"

export const useAddItemSales = (
  params: Params = {},
  useMutationOptions: UseMutationOptions<
    any,
    unknown,
    { [key: string]: string | number | Date }[],
    unknown
  > = {},
) => {
  return useMutation({
    mutationKey: ["itemSales"],
    mutationFn: (itemSalesData: { [key: string]: string | number | Date }[]) =>
      post({
        route: "/itemSales",
        body: JSON.stringify(itemSalesData),
        params,
      }),
    ...useMutationOptions,
  })
}
