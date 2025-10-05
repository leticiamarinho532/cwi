const stringService = {

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

        if (formatedText.includes(formatedKey)) {
            return `O texto contém ${formatedKey}`;
        }
        
        return `O texto não contém ${formatedKey}`;
    }
}

module.exports = stringService;