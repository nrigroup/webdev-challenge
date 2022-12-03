import nc from "next-connect"
import {
  getAllItemSales,
  getItemSale,
  postItemSales,
} from "../../../controllers/ItemSalesController"
import onError from "../../../middlewares/errors"

const handler = nc({ onError })

handler.get(getAllItemSales)
handler.get(getItemSale)
handler.post(postItemSales)

export default handler
