import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                eng: ['Figtree', 'ui-sans-serif', 'system-ui'],
                thai: ['"Noto Sans Thai"', 'ui-sans-serif', 'system-ui'],
            },
        },
    },

    plugins: [forms],
};
