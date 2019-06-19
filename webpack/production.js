// Webpack specific imports.
const merge = require('webpack-merge');

// Other build files.
const base = require('./base');
const project = require('./project');

// Plugins.
const TerserPlugin = require('terser-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');

// All Plugins used in production build.
const plugins = [

  // Clean public files before next build.
  new CleanWebpackPlugin(),
];

// All Optimizations used in production build.
const optimization = {
  minimizer: [
    new TerserPlugin({
      cache: true,
      parallel: true,
      sourceMap: true,
    }),
  ],
};

// Define productionConfig setup.
const productionConfig = {
  plugins,
  optimization,

  devtool: 'inline-cheap-module-source-map',
};

// Combine base with productionConfig specific config.
module.exports = merge(project, base, productionConfig);
