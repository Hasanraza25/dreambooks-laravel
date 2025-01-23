const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                xs: '480px', // Extra small devices (custom)
                sm: '640px', // Small devices
                md: '768px', // Medium devices
                lg: '1024px', // Large devices
                xl: '1280px', // Extra large devices
                '2xl': '1536px', // Default 2xl (you can keep it or remove it if not needed)
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
