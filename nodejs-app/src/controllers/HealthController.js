const systemHealth = (request, response) => {
    response.status(200).json({
        status: "ok"
    });
};

module.exports = { systemHealth };