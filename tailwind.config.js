/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontSize: {
                xs: ".75rem",
            },
            colors: {
                primary: "#005BF0",
                blue: {
                    50: "#CCDEFC",
                    100: "#AAC8FA",
                    200: "#80ADF7",
                    300: "#5592F5",
                    400: "#2B76F2",
                    600: "#004CC8",
                    700: "#003DA0",
                    800: "#002E78",
                    900: "#001E50",
                },
                grayScale: {
                    100: "#F2F2F2",
                    200: "#D9D9D9",
                    300: "#BFBFBF",
                    400: "#A6A6A6",
                    500: "#8C8C8C",
                    600: "#737373",
                    700: "#595959",
                    800: "#1C1C1C",
                    900: "#262626",
                },
                info: {
                    50: "#E9F4FB",
                    100: "#D8EBF8",
                    200: "#ADD5F0",
                    300: "#86C2EA",
                    400: "#5AACE2",
                    500: "#3498DB",
                    600: "#207AB6",
                    700: "#195D8B",
                    800: "#103D5B",
                    900: "#082030",
                },
                gray: "#D9D9D9",
                gray2: "#F5F5F5",
                blackMain: "#1C1C1C",
                navInfoGray: "#737373",
                "primary-darker": "#DAA515",
            },
            fontFamily: {
                montserrat: ["Montserrat", "sans-serif"],
                poppins: ["Poppins", "sans-serif"],
            },
            screens: {
                "2xs": "321px",
                xs: "426px",
            },
        },
    },
    plugins: [],
};
