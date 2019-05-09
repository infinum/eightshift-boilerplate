// Other build files.
const config = require('./config');

// Plugins.
const CopyWebpackPlugin = require('copy-webpack-plugin');

// Main Webpack build setup - Project specific.
const project = {
  context: config.theme.appPath,
  entry: {
    application: [config.theme.assetsEntry],
    applicationAdmin: [config.theme.assetsAdminEntry],
  },
  output: {
    path: config.theme.output,
    publicPath: config.theme.publicPath,
  },

  plugins: [

    // Copy files to new destination.
    new CopyWebpackPlugin([

      // Find jQuery in node_modules and copy it to public folder
      {
        from: `${config.theme.nodeModules}/jquery/dist/jquery.min.js`,
        to: config.theme.output,
      },
    ]),
  ],
};

// Export project specific configs.
// IF you have multiple builds a flag can be added to the package.json config and use switch case to determin the build config.
module.exports = project;
