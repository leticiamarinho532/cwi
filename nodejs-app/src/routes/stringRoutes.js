const express = require("express");
const validateStringQuery = require("../middlewares/stringValidator");
const stringController = require("../controllers/StringController");

const router = express.Router();

router.get("/check-string", validateStringQuery, stringController.checkString);

module.exports = router;