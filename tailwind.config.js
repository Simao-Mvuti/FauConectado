/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./core/templates/**/*.html", "./core/static/**/*.js"],
  theme: {
    extend: {
      colors: {
        ink: "#19251f",
        forest: "#1e4d3a",
        mint: "#dff2e7",
        coral: "#ef765f",
        paper: "#f7f8f3",
      },
      fontFamily: {
        display: ["DM Serif Display", "serif"],
        sans: ["Plus Jakarta Sans", "sans-serif"],
      },
      boxShadow: {
        soft: "0 20px 50px rgba(25, 37, 31, .08)",
      },
    },
  },
  plugins: [],
};
