const express = require("express");
const stringController = require("../controllers/StringController");

const router = express.Router();

router.get("/check-string", stringController.checkString);

module.exports = router;