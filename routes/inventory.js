const express = require("express");
const router = express.Router();

const { read, newTable, deleteTable } = require("../controllers/inventory");

router.get("/v1/inventory", read);

router.post("/v1/inventory", newTable);

router.delete("/v1/inventory", deleteTable);

module.exports = router;
