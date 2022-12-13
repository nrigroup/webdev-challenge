require("dotenv").config();
const db = require("./db.js");
const express = require("express");
const app = express();
const cors = require("cors");
const bodyParser = require("body-parser");

app.use(bodyParser.json());
app.use(cors({ origin: "*" }));

// Routing
const inventoryRoutes = require("./routes/inventory");
app.use("/api", inventoryRoutes);

const PORT = process.env.PORT || 8000;
app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
