const express = require("express");
const stringRoutes = require("./StringRoutes");
const healthRoutes = require("./HealthRoutes");

const router = express.Router();

router.use("/", stringRoutes);
router.use("/", healthRoutes);

module.exports = router;