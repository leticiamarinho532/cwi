const express = require("express");
const stringRoutes = require("./stringRoutes");
const healthRoutes = require("./healthRoutes");

const router = express.Router();

router.use("/", stringRoutes);
router.use("/", healthRoutes);

module.exports = router;