const DEV = process.env.NODE_ENV !== 'production';

const path = require('path');

const themeName = 'theme_name';
const fontsPath = path.join(__dirname, `wp-content/themes/${themeName}/skin/assets/fonts`);

const plugins = [
  require('autoprefixer'),
  require('postcss-font-magician')({
    hosted: [fontsPath],
    foundries: ['hosted']
  }),
  require('css-mqpacker')
];

// Use only for production build
if (!DEV) {
  plugins.push(require('cssnano'));
}

module.exports = {plugins};
