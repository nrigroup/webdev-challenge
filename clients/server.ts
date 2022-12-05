import axios from "axios"
import { BACKEND_URL } from "../config"

const server = axios.create({
  baseURL: BACKEND_URL,
  headers: {
    "Content-Type": "application/json",
    "accept-encoding": null,
  },
  paramsSerializer: {
    indexes: null
  },
})

export default server
