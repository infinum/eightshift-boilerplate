const DEV = process.env.NODE_ENV !== 'production';

const themeName = 'theme_name';
const appPath = `/wp-content/themes/${themeName}/skin`;
const fontsPath = `${appPath}/public/fonts`;

const plugins = [
  require('autoprefixer'),
  require('postcss-font-magician')({
    // custom: {
    //   rasco: {
    //     variants: {
    //       normal: {
    //         400: {
    //           url: {
    //             woff: `${fontsPath}/rasco.woff`,
    //             eot: `${fontsPath}/rasco.eot`,
    //             ttf: `${fontsPath}/rasco.ttf`
    //           }
    //         }
    //       }
    //     }
    //   }
    // },
    variants: {
      'Open Sans': {
        400: [],
        600: [],
        700: [],
        800: []
      }
    },
    foundries: ['google', 'custom']
  }),
  require('css-mqpacker')
];

if (!DEV) {
  plugins.push(require('cssnano'));
}

module.exports = {plugins};
