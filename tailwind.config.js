const colors = require('tailwindcss/colors');
const plugin = require('tailwindcss/plugin');

const config = {
  content: [
    './src/sass/*.scss',
    './src/sass/**/*.scss',
    './src/js/*.js',
    './src/js/**/*.js',
    './app/**/*.php',
    './archives/*.php',
    './archives/**/*.php',
    './resources/**/*.php',
    './singles/**/*.php',
    './resources/*.php',
    './*.php',
  ],
  plugins: [
    plugin(function ({ addBase, theme }) {
      addBase({
        h1: { fontSize: theme('fontSize.2xl') },
        h2: { fontSize: theme('fontSize.xl') },
        h3: { fontSize: theme('fontSize.lg') },
      });
    }),
  ],
  theme: {
    screens: {
      xsm: '480px',
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1200px',
      '2xl': '1440px',
    },
    container: {
      center: true,
      screens: {
        lg: '1024px',
        xl: '1200px',
        '2xl': '1440px',
        // '2xl': '1230px'
      },
      padding: {
        DEFAULT: '1rem',
      },
    },
    colors: {
      // Primary
      'primary-yellow': '#ffc145',
      'primary-blue': '#1b79b8',
      'primary-black': '#171717',

      // yellow
      'y-50': '#fff9ec',
      'y-100': '#ffecc5',
      'y-200': '#ffe2a9',
      'y-300': '#ffd582',
      'y-400': '#ffcd6a',
      'y-600': '#e8b03f',
      'y-700': '#b58931',
      'y-800': '#8c6a26',
      'y-900': '#6b511d',

      // Blue
      'b-50': '#F5FBFF',
      'b-100': '#b8d5e9',
      'b-200': '#96c1de',
      'b-300': '#66a5cf',
      'b-400': '#4994c6',
      'b-600': '#196ea7',
      'b-700': '#135683',
      'b-800': '#0f4365',
      'b-900': '#011422',

      // Neutral
      'n-50': '#f8f8f8',
      'n-100': '#b7b7b7',
      'n-200': '#949494',
      'n-300': '#646464',
      'n-400': '#454545',
      'n-500': '#171717',
      'n-600': '#151515',
      'n-700': '#101010',
      'n-800': '#0d0d0d',
      'n-900': '#0a0a0a',
      'text-grey': '#E8E8E8',
      'dark-grey': '#323232',
      subtext: '#2C2C2C',
      grey93: '#EDEDED',
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.gray,
      red: colors.red,
    },
    extend: {
      fontSize: {
        'display-d1': '70px',
        'display-d2': '44px',
        'heading-1': '56px',
        'heading-2': '44px',
        'heading-3': '40px',
        'small-heading': '32px',
        'small-heading-2': '24px',
        'heading-4': '24px',
        'heading-5': '18px',
      },

      backgroundImage: {
        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
      },
      fontFamily: {
        // 👇 Add CSS variables
        // noto: ['var(--font-noto_sans)'],
        bigShouldersDisplay: ['Big Shoulders Display'],
        inter: ['Inter', 'sans-serif'],
        'dm-sans': ['DM Sans', 'sans-serif'],
      },
    },
  },
  plugins: [],
};
export default config;
