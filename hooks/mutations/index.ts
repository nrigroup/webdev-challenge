import { useMutation, UseMutationOptions } from "@tanstack/react-query"
import { Params } from "next/dist/shared/lib/router/utils/route-matcher"
import { post } from "../../utils"

export const useAddItemSales = (
  params: Params = {},
  useMutationOptions: UseMutationOptions<any, unknown, FormData, unknown> = {},
) => {
  return useMutation({
    mutationKey: ["itemSales"],
    mutationFn: (itemSalesData: FormData) =>
      post({
        route: "/itemSales",
        body: itemSalesData,
        headers: {
          "Content-Type": "multipart/form-data",
        },
        params,
      }),
    ...useMutationOptions,
  })
}
