/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily: {
      'mon': ['Manrope'],
    },
    extend: {
      colors: {
        black1: '#212121',
        gray1: '#5B5B5B',
        gray2: '#B6B6B6',
        blue1: '#1967D2',
        blue2: '#7ab4cc',
        back: '#E8E8E8',
        header: '#EFF6FF'
      },
    },
  },
  plugins: [],
}

