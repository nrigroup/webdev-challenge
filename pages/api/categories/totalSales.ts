import nc from "next-connect"
import { getCategorySaleTotals } from "../../../controllers/CategoriesController"
import onError from "../../../middlewares/errors"

const handler = nc({ onError })

handler.get(getCategorySaleTotals)

export default handler
