const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },

    screens: {
      'tablet': { 'max': '950px' },
    },

    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.gray,
      'red': {
        light: '#fae3e1',
        DEFAULT: '#db4437',
        middle: '#f6d0cd',
        dark: '#f2beb9',
        ...colors.red,
      },
      'purple': {
        light: '#f0ebf8',
        DEFAULT: '#673ab7',
        middle: '#e1d8f1',
        dark: '#d1c4e9',
      },
      'indigo': {
        light: '#eceef8',
        DEFAULT: '#3f51b5',
        middle: '#d9dcf0',
        dark: '#c5cbe9',
      },
      'blue': {
        light: '#e3edfd',
        DEFAULT: '#4285f4',
        middle: '#d0e1fc',
        dark: '#bdd4fb',
      },
      'light-blue': {
        light: '#d9f2fd',
        DEFAULT: '#03a9f4',
        middle: '#c0eafc',
        dark: '#a7e1fb',
      },
      'cyan-blue': {
        light: '#d9f5f9',
        DEFAULT: '#00bcd4',
        middle: '#bfeef4',
        dark: '#a6e8f0',
      },
      'orange-red': {
        light: '#ffe6de',
        DEFAULT: '#ff5722',
        middle: '#ffd5c8',
        dark: '#ffc4b2',
      },
      'orange': {
        light: '#fff0d9',
        DEFAULT: '#ff9800',
        middle: '#ffe5bf',
        dark: '#ffdba6',
      },
      'blue-green': {
        light: '#d9efed',
        DEFAULT: '#009688',
        middle: '#bfe5e1',
        dark: '#a6dad5',
      },
      'green': {
        light: '#e4f3e5',
        DEFAULT: '#4caf50',
        middle: '#d2ebd3',
        dark: '#c0e3c2',
      },
      'blue-gray': {
        light: '#e7ecee',
        DEFAULT: '#607d8b',
        middle: '#d7dfe2',
        dark: '#c7d2d6',
      },
      'grey': {
        light: '#f0f0f0',
        DEFAULT: '#9e9e9e',
        middle: '#e7e7e7',
        dark: '#dddddd',
        gray: '#f6f6f6',
      },
    },
  },
  plugins: [require('@tailwindcss/forms')],

};
