import { NodeHeaders } from "next/dist/server/web/types"
import { Params } from "next/dist/shared/lib/router/utils/route-matcher"
import { BACKEND_URL } from "../config"

export const get = async ({
  route,
  params,
  headers,
}: {
  route: string
  params?: Params
  headers?: NodeHeaders
}) => {
  const url = new URL(BACKEND_URL + route)
  url.search = new URLSearchParams(params).toString()
  const response = await fetch(url, {
    headers: { "Content-Type": "application/json", ...headers },
  })

  const data = await response.json()
  return data
}

export const post = async ({
  route,
  body,
  params,
  headers,
}: {
  route: string
  body: BodyInit
  params?: Params
  headers?: NodeHeaders
}) => {
  const url = new URL(BACKEND_URL + route)
  url.search = new URLSearchParams(params).toString()
  const response = await fetch(url, {
    body,
    method: "POST",
    headers: { "Content-Type": "application/json", ...headers },
  })

  const data = await response.json()
  return data
}
