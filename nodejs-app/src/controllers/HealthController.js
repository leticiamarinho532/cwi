/**
 * @typedef {import('express').Request} Request
 * @typedef {import('express').Response} Response
 * @param {Request} request 
 * @param {Response} response
 * @returns {void}
 */
const systemHealth = (request, response) => {
    response.status(200).json({
        status: "ok"
    });
};

module.exports = { systemHealth };