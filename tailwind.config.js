/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                // AZULES
                "tesla-50": "#B7C0EE",
                "tesla-100": "#88A2F7",
                "tesla-200": "#4D85F5",
                "tesla-300": "#266DF3",
                "tesla-400": "#1C59DA",
                "tesla-500": "#185ADB",
                "tesla-600": "#1350C3",
                "tesla-700": "#0F469B",
                "tesla-800": "#0B3274",
                "tesla-900": "#06204C",
                "tesla-950": "#031426",
                "tesla-950": "#031426",

                // NARANJAS
                "orange-50": "#F9F9F9",
                // "orange-100": "#F7A288",
                "orange-200": "#E5E3E2",
                "orange-300": "#F36D26",
                "orange-400": "#DA591C",
                "orange-500": "#FF5B19",
                "orange-600": "#C35013",
                "orange-700": "#9B460F",
                "orange-800": "#74320B",
                "orange-900": "#4C2006",
                "orange-950": "#161616",

                "gray-100": "#E5E3E2",
                // BLANCOS
                "walter-50": "#FFFFFF",
                "walter-100": "#F9F9F9",
                "walter-200": "#F3F3F3",
                "walter-300": "#EDEDED",
                "walter-400": "#E7E7E7",
                "walter-500": "#E1E1E1",
                "walter-600": "#DBDBDB",
                "walter-700": "#D5D5D5",
                "walter-800": "#CFCFCF",
                "walter-900": "#C9C9C9",
                "walter-950": "#C3C3C3",
            },
        },
    },
    plugins: [require("tw-elements/plugin.cjs")],
    darkMode: "class",
};
