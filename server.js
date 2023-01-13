const dash = require("./routes/dashboard");
const index = require("./routes/index");
const result = require("./routes/result");
const express = require("express");
const multer = require("multer");
const cors = require("cors");

var storage = multer.diskStorage({
  destination: "uploads/",
  filename: function (req, file, callback) {
    callback(null, file.originalname);
  },
});

const upload = multer({ storage: storage });

const app = express();
const port = 3000;

const corsOptions = {
  origin: "http://localhost:3000",
  credentials: true, //access-control-allow-credentials:true
  optionSuccessStatus: 200,
};

class Server {
  constructor(app) {
    this.app = app;
    this.app.use(cors(corsOptions));
    this.app.use("/", index);
    this.app.use("/dashboard", dash);
    this.app.use("/result", result);
    this.app.post("/file", upload.single("file"), function (req, res, next) {
      console.log(req.file, req.body);
      res.redirect("/result");
    });
  }
  start() {
    this.app.listen(port, function () {
      console.log(`Server listening on port ${port}!`);
    });
  }
}

const server = new Server(app);
server.start(port);
