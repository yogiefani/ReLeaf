import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                playfair: ['"Playfair Display"', "serif"],
                oxygen: ["Oxygen", "sans-serif"],
            },
            colors: {
                "brand-background": "#E5D3B3",
                "brand-primary": "#664229",
                "brand-primary-hover": "#5a4238",
                "text-primary": "#987554",
                "brand-beige": "#E9DDCF",
                "brand-dark": "#4A3F35",
            },
        },
    },

    plugins: [forms],
};
