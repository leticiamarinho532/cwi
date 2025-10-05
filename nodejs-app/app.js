const express = require("express");
const routes = require("./routes/index");

const app = express();

app.use(express.json());

app.use("/", routes);

console.log(routes.stack);

module.exports = app;