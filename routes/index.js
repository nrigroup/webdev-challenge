const express = require("express");
const router = express.Router();

router.get("/", function (req, res) {
  console.log("dashboard route has been hit");
  res.sendFile(__dirname + "/public/index.html");
});

module.exports = router;
