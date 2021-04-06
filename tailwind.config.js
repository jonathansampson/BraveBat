const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        'brand-orange': '#fb542b',
        'brand-dark': '#343546',
        'brand-gray': '#A0A1B2',
        'brand-light': '#f0f0f0',
        'brand-purple': '#a3278f',
        'brand-blue': '#4f30ab',
        orange: colors.orange
      },
      fontSize: {
        xxs: '.5rem'
      }
    }
  },
  variants: {
    extend: {}
  },
  plugins: [require('@tailwindcss/forms')]
}
