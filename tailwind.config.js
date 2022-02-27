const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inria Sans', ...defaultTheme.fontFamily.sans],
                serif: ['Inria Serif', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                mf: "990px",
            },
            colors: {
                theme: {
                    blue: {
                        100:'#2B91BF',
                        200:'#2682ab',
                        300:'#227498',
                        400:'#1e6585',
                        500:'#195772',
                        600:'#15485f',
                        700:'#113a4c',
                        800:'#0c2b39',
                        900:'#081d26',
                    },
                    light: '#F8F3DA',
                    slate: '#708090',
                    charcoal: '#333333',
                    davy: '#555555',
                }
            },
            keyframes: {
                "slide-in": {
                  "0%": {
                    "-webkit-transform": "translateX(120%)",
                    transform: "translateX(120%)",
                  },
                  "100%": {
                    "-webkit-transform": "translateX(0%)",
                    transform: "translateX(0%)",
                  },
                },
            },
            animation: {
                "slide-in": "slide-in 0.5s ease-out",
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
