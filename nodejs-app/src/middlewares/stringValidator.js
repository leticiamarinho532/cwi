const { query, validationResult } = require("express-validator");

const validateStringQuery = [
  query("text")
    .exists().withMessage("O campo texto é obrigatório")
    .isString().withMessage("O campo texto deve ser um valor de texto"),
  
  query("key")
    .exists().withMessage("O campo chave é obrigatório")
    .isString().withMessage("O campo chave deve ser um valor de texto"),

  (request, response, next) => {
    const errors = validationResult(request);
    if (!errors.isEmpty()) {
      return response.status(402).json({
        route: request.originalUrl,
        errors: errors.array().map(e => e.msg)
      });
    }
    next();
  }
];

module.exports = validateStringQuery;