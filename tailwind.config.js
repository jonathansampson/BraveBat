module.exports = {
  theme: {
    extend: {
      colors: {
        'brand-orange': '#fb542b',
        'brand-dark': '#343546',
        'brand-gray': '#A0A1B2',
        'brand-light': '#f0f0f0',
        'brand-purple': '#a3278f',
        'brand-blue': '#4f30ab'
      }
    },
    spinner: (theme) => ({
      default: {
        color: '#fb542b',
        size: '1em',
        border: '2px',
        speed: '500ms',
      },
    }),
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms'),
    require('tailwindcss-spinner')()
  ]
}
