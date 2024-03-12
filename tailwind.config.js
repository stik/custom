const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './**/*.php',
        './*.php',
    ],

    safelist: [
    ],

    theme: {
        screens: {
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1260px',
            '2xl': '1600px',
        },

        container: {
            center: true,
            screens: {
                'sm': "100%",
                'md': "600px",
                'lg': "1024px",
                'xl': "1260px",
                '2xl': "1260px",
            },
            padding: {
                DEFAULT: '1.875rem',
                md: '1.875rem',
            }
        },
        extend: {
            colors: {
                primary: "#333333",
                current: "currentColor"
            },
            lineHeight: {
                'extratight': '1.1',
                'tighter': '1.2',
            }
        },
    },
    plugins: [
    ],
}
