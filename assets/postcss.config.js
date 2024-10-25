// postcss.config.js
module.exports = {
    plugins: [
        require('tailwindcss'),
        require('autoprefixer'),
        require('postcss-prefix-selector')({
            prefix: '.ux-pagination',
            exclude: [/^html$/, /^body$/],
        }),
    ],
};
