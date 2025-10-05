const stringService = require("../services/stringService");

/**
 * @typedef {import('express').Request} Request
 * @typedef {import('express').Response} Response
 * @param {Request} request 
 * @param {Response} response
 * @returns {void}
 */
const checkString = (request, response) => {
    const { text, key } = request.query;

    const result = stringService.containsKey(text, key);

    response.status(200).json({
        route: "check-string",
        text,
        key,
        result
    });
};

module.exports = { checkString };