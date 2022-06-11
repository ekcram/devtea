const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                // sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                primary: ["Inter"],
                ...defaultTheme.fontFamily.primary,
            },
            colors: {
                'regal-blue': '#074388',
                'red-salsa' : '#E94A47',
                'midnight-green': '#1F4D5B',
                'steel-teal': '#5C8D89',
                'green-sheen': '#74B49B',
                'turquoise-green': '#A7D7C5',
                'mint-cream': '#F4F9F4'
            },
            spacing: {
                128: "32rem",
            },
        },
    },
    variants: {
        extend: {
            opacity: ["disabled"],
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("flowbite/plugin"),
        require('@tailwindcss/line-clamp'),
    ],
    rules: {
        'at-rule-no-unknown': [true, {
          ignoreAtRules: [
            'tailwind',
            'apply',
            'variants',
            'responsive',
            'screen'
          ]
        }],
        'declaration-block-trailing-semicolon': null,
        'no-descending-specificity': null
      }
};
