const express = require("express");
const router = express.Router();
const csv = require("csv-parser");
const db = require("../model/index");
const fs = require("fs");

const item = db.items;

router.get("/", function (req, res) {
  const results = [];
  fs.createReadStream("./uploads/data.csv")
    .pipe(csv())
    .on("data", (data) => results.push(data))
    .on("end", () => {
      //   console.log(results);

      for (let result of results) {
        item
          .create({
            date: result.date,
            category: result.category,
            lot_title: result["lot title"],
            lot_location: result["lot location"],
            lot_condition: result["lot condition"],
            pre_tax_amount: result["pre-tax amount"],
            tax_name: result["tax name"],
            tax_amount: result["tax amount"],
          })
          .then((res) => {
            // console.log(res);
          })
          .catch((error) => {
            console.error("Failed to create a new record : ", error);
          });
      }
    });
  res.redirect("/dashboard");
});

module.exports = router;
