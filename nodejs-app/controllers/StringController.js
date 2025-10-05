const StringService = require("../services/StringService");

const checkString = (request, response) => {
    const { text, key } = request.query;

    const result = StringService.containsKey(text, key);

    response.json({
        route: "validar-string",
        text,
        key,
        result
    });
};

module.exports = { checkString };