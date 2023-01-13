const express = require("express");
const router = express.Router();
const db = require("../model/index");

const item = db.items;

router.get("/", function (req, res) {
  console.log("dashboard route has been hit");

  res.sendFile(__dirname + "/public/dashboard.html");
});

router.get("/data", (req, res) => {
  let data = [];
  item
    .findAll()
    .then((result) => {
      result.sort(function (a, b) {
        // time complexity: O(nlogn)
        return new Date(b.date) - new Date(a.date);
      });
      result.forEach((item) => {
        data.push({
          date: item.dataValues.date,
          category: item.dataValues.category,
          condition: item.dataValues.lot_condition,
          pre_tax_amount: item.dataValues.pre_tax_amount,
        });
        // console.log(data);
      });
      res.send(data);
    })
    .catch((error) => {
      console.error("Failed to retrieve data : ", error);
    });
});

module.exports = router;
