import nc from "next-connect"
import { getItemSale } from "../../../controllers/ItemSalesController"
import onError from "../../../middlewares/errors"

const handler = nc({ onError })

handler.get(getItemSale)

export default handler
