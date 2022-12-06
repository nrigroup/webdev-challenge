import { useQuery, UseQueryOptions, UseQueryResult } from "@tanstack/react-query"
import { Params } from "next/dist/shared/lib/router/utils/route-matcher"
import { get } from "../../utils"

export const useItemSales = (
  params: Params = {},
  useQueryOptions: UseQueryOptions = {},
): UseQueryResult<{ success: string; data: { [key: string]: any }[] }> => {
  return useQuery({
    queryKey: ["itemSales"],
    queryFn: () => get({ route: "/itemSales", params }),
    enabled: true,
    ...useQueryOptions,
  }) as UseQueryResult<{ success: string; data: { [key: string]: any }[] }>
}

export const useCategories = (
  params: Params = {},
  useQueryOptions: UseQueryOptions = {},
): UseQueryResult<{ success: string; data: { [key: string]: any }[] }> => {
  return useQuery({
    queryKey: ["categories"],
    queryFn: () => get({ route: "/categories", params }),
    enabled: true,
    ...useQueryOptions,
  }) as UseQueryResult<{ success: string; data: { [key: string]: any }[] }>
}

export const useConditions = (
  params: Params = {},
  useQueryOptions: UseQueryOptions = {},
): UseQueryResult<{ success: string; data: { [key: string]: any }[] }> => {
  return useQuery({
    queryKey: ["conditions"],
    queryFn: () => get({ route: "/conditions", params }),
    enabled: true,
    ...useQueryOptions,
  }) as UseQueryResult<{ success: string; data: { [key: string]: any }[] }>
}
