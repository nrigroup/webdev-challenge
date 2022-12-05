import nc from "next-connect"
import { getConditionsSaleTotals } from "../../../controllers/ConditionsController"
import onError from "../../../middlewares/errors"

const handler = nc({ onError })

handler.get(getConditionsSaleTotals)

export default handler
