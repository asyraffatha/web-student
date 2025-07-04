import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./index.html",
        "./src/**/*.{js,jsx}",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                poppins: ["Poppins", "sans-serif"],
                inter: ["Inter", "sans-serif"],
                nunito: ["Nunito", "sans-serif"],
                montserrat: ["Montserrat", "sans-serif"],
            },
        },
    },

    plugins: [require("daisyui")],
};
