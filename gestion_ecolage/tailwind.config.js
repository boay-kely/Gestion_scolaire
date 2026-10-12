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
        indigo: {
          50: '#f0f4ff',
          100: '#e6ebff',
          600: '#4f46e5',
          700: '#4338ca',
          900: '#312e81',
        },
        emerald: {
          50: '#f0fdf4',
          100: '#dcfce7',
          600: '#10b981',
          700: '#059669',
        },
        rose: {
          50: '#fff5f7',
          100: '#ffe4e6',
          600: '#f43f5e',
          700: '#e11d48',
        },
      },
    },
  },
  plugins: [],
}
