import nc from "next-connect"
import { getAllCategories, getCategory } from "../../../controllers/CategoriesController"
import onError from "../../../middlewares/errors"

const handler = nc({ onError })

handler.get(getAllCategories)
handler.get(getCategory)

export default handler