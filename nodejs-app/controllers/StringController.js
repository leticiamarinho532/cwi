const StringService = require("../services/StringService");

const checkString = (request, response) => {
    const { text, key } = request.query;

    const result = StringService.containsKey(text, key);

    response.status(200).json({
        route: "check-string",
        text,
        key,
        result
    });
};

module.exports = { checkString };