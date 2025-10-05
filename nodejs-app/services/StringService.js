const StringService = {

    /**
     * @param {string} text 
     * @param {string} key 
     * @returns {boolean}
     */
    containsKey: (text, key) => {
        if (typeof text !== "string" || typeof key !== "string") {
            return false;
        }

        const formatedText = text.trim().toLowerCase();
        const formatedKey = key.trim().toLowerCase();

        return formatedText.includes(formatedKey);
    }
}

module.exports = StringService;