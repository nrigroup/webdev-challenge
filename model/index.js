const Sequelize = require("sequelize");
const sequelize = new Sequelize("items", "root", "iwy", {
  host: "127.0.0.1",
  dialect: "mysql",
});

sequelize
  .authenticate()
  .then(() => {
    console.log("Connection has been established successfully.");
  })
  .catch((error) => {
    console.error("Unable to connect to the database: ", error);
  });

sequelize
  .sync()
  .then(() => {
    console.log("Items table created successfully!");
  })
  .catch((error) => {
    console.error("Unable to create table : ", error);
  });

const db = {};

db.Sequelize = Sequelize;
db.sequelize = sequelize;

db.items = require("./items.model.js")(sequelize, Sequelize);

module.exports = db;
