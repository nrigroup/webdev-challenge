const db = require("../db.js");

exports.read = (req, res) => {
  db.query(
    `Select * from ${req.query.table} where posteddate='${req.query.posteddate}'`,
    (err, result) => {
      if (!err) {
        res.send(result.rows);
      } else {
        res.send([]);
      }
    }
  );
  db.end;
};

exports.newTable = (req, res) => {
  const inv = req.body;

  for (const key in inv) {
    // First check if table exist
    db.query(
      `SELECT EXISTS (SELECT relname FROM pg_class WHERE relname = '${key}');`,
      (err, result) => {
        // Create table if it doesnot xist
        if (!result["rows"][0].exists) {
          let insertTable = `CREATE TABLE ${key} (
            id    SERIAL PRIMARY KEY,
            date VARCHAR(10) NOT NULL,
            category VARCHAR(100) NOT NULL,
            lottitle VARCHAR(200) NOT NULL,
            lotlocation VARCHAR(200) NOT NULL,
            lotcondition VARCHAR(200) NOT NULL,
            pretaxamount FLOAT NOT NULL,
            taxname VARCHAR(100) NOT NULL,
            taxamount FLOAT NOT NULL,
            posteddate VARCHAR(10) NOT NULL
          )`;
          db.query(insertTable, (err, result) => {
            if (err) {
              console.log(err.message);
            }
          });
        }

        // Insert data into postgresql
        let insertDataTable = `insert into ${key}(date, category, lottitle, lotlocation, lotcondition, pretaxamount, taxname, taxamount, posteddate) values `;
        let initialVal = 0;
        inv[key].forEach((row) => {
          const data =
            "('" +
            row.date +
            "', '" +
            row.category +
            "', '" +
            row.lottitle.replaceAll("'", "''") +
            "', '" +
            row.lotlocation.replaceAll("'", "''") +
            "', '" +
            row.lotcondition.replaceAll("'", "''") +
            "', '" +
            row.pretaxamount +
            "', '" +
            row.taxname +
            "', '" +
            parseFloat(row.taxamount) +
            "', '" +
            row.posteddate +
            "')";
          if (initialVal === 0) {
            insertDataTable += data;
          } else {
            insertDataTable += ", " + data;
          }
          initialVal = 1;
        });
        db.query(insertDataTable, (err, result) => {
          if (err) {
            console.log(err.message);
          }
        });
      }
    );
  }

  res.send("Insertion was done");

  db.end;
};

exports.deleteTable = (req, res) => {
  const info = req.body;
  db.query(
    `DELETE FROM ${info.table} WHERE posteddate = '${info.date}'`,
    (err, result) => {
      if (!err) {
        res.send("Successful!");
      } else {
        res.send("Fail!");
      }
    }
  );
  db.end;
};
