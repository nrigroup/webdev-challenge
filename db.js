const { Pool } = require("pg");

const connectionString = process.env.DATABASE_URL;

const db = new Pool({
  connectionString,
});

module.exports = db;
