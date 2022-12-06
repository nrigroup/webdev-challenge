import { useQuery, UseQueryOptions } from "@tanstack/react-query"
import { Params } from "next/dist/shared/lib/router/utils/route-matcher"
import instance from "../../lib/axios"

export const useItemSales = ({
  params = {},
  useQueryOptions = {},
}: {
  params: Params
  useQueryOptions: UseQueryOptions
}) => {
  return useQuery({
    queryKey: ["itemSales"],
    queryFn: () => instance.get("/itemSales", { params }),
    enabled: true,
    ...useQueryOptions,
  })
}

export const useCategoriesPreTaxTotals = ({
  params = {},
  useQueryOptions = {},
}: {
  params: Params
  useQueryOptions: UseQueryOptions
}) => {
  return useQuery({
    queryKey: ["categories"],
    queryFn: () => instance.get("/categories", { params }),
    enabled: true,
    ...useQueryOptions,
  })
}

export const useConditionsPreTaxTotals = ({
  params = {},
  useQueryOptions = {},
}: {
  params: Params
  useQueryOptions: UseQueryOptions
}) => {
  return useQuery({
    queryKey: ["conditions"],
    queryFn: () => instance.get("/conditions", { params }),
    enabled: true,
    ...useQueryOptions,
  })
}
