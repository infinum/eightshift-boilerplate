/* global process __dirname */
const DEV = process.env.NODE_ENV !== 'production';

const path = require('path');

const fontsPath = path.join(__dirname, 'skin/assets/fonts');

const autoPrefixer = require('autoprefixer');
const cssMqpacker = require('css-mqpacker');
const postcssFontMagician = require('postcss-font-magician');
const cssNano = require('cssnano');

const plugins = [
  autoPrefixer,
  postcssFontMagician({
    hosted: [fontsPath],
    foundries: ['hosted'],
  }),
  cssMqpacker,
];

// Use only for production build
if (!DEV) {
  plugins.push(cssNano);
}

module.exports = {plugins};
