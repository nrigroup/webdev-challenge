const express = require("express");
const router = express.Router();

const { read, newtables } = require("../controllers/inventory");

router.get("/v1/inventory", read);

router.post("/v1/inventory", newtables);

module.exports = router;
