import nc from "next-connect"
import { getAllItemSales, postItemSales } from "../../../controllers/ItemSalesController"
import onError from "../../../middlewares/errors"

const handler = nc({ onError })

handler.get(getAllItemSales)

handler.post(postItemSales)

export default handler
