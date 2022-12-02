import nc from "next-connect";
import { getAllItemSales } from "../../../controllers/ItemSalesController";
import onError from "../../../middlewares/errors";

const handler = nc({ onError });

handler.get(getAllItemSales);

export default handler;