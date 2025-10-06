const stringService = {

    /**
     * @param {string} text 
     * @param {string} key 
     * @returns {string}
     */
    containsKey: (text, key) => {
        const formatedText = text.trim().toLowerCase();
        const formatedKey = key.trim().toLowerCase();

        if (formatedText.includes(formatedKey)) {
            return `O texto contém ${formatedKey}`;
        }
        
        return `O texto não contém ${formatedKey}`;
    }
}

module.exports = stringService;