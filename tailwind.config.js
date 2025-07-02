/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: '#653C8B',
                secondary: '#8157b6',
                secondaryHover: '#7142a2',
            }
        },
    },
    plugins: [],
}
