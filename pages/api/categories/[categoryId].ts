import nc from "next-connect"
import { getCategory } from "../../../controllers/CategoriesController"
import onError from "../../../middlewares/errors"

const handler = nc({ onError })

handler.get(getCategory)

export default handler
