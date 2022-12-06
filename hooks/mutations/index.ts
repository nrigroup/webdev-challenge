import {
  useMutation,
  UseMutationOptions,
} from "@tanstack/react-query"
import { Params } from "next/dist/shared/lib/router/utils/route-matcher"
import instance from "../../lib/axios"

export const useAddItemSales = ({
  params = {},
  useMutationOptions = {},
}: {
  params: Params
  useMutationOptions: UseMutationOptions<any, unknown, FormData, unknown>
}) => {
  return useMutation({
    mutationKey: ["itemSales"],
    mutationFn: (itemSalesData: FormData) => {
      return instance.post("/itemSales", itemSalesData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
        ...params,
      })
    },
    ...useMutationOptions,
  })
}
