module.exports = {
    input: {
        path: './resources', // only files in this directory are considered for extraction
        include: ['**/*.js', '**/*.ts', '**/*.vue'], // glob patterns to select files for extraction
        exclude: [], // glob patterns to exclude files from extraction
    },
    output: {
        path: './resources/language', // output path of all created files
        potPath: './messages.pot', // relative to output.path, so by default "./src/language/messages.pot"
        jsonPath: './translations.json', // relative to output.path, so by default "./src/language/translations.json"
        locales: ['en', 'hr'],
        flat: false, // don't create subdirectories for locales
        linguas: true, // create a LINGUAS file
    },
};
