const express = require("express");
const stringRoutes = require("./StringRoutes");

const router = express.Router();

router.use("/", stringRoutes);

module.exports = router;