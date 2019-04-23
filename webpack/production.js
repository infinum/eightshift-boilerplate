// Webpack specific imports.
const merge = require('webpack-merge');

// Other build files.
const base = require('./base');

// Plugins.
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

// All Plugins used in production build.
const plugins = [
  new MiniCssExtractPlugin({
    filename: '[name]-[hash].css',
  }),
];

// All Optimizations used in production build.
const optimization = {
  minimizer: [
    new UglifyJsPlugin({
      cache: true,
      parallel: true,
      sourceMap: true,
      uglifyOptions: {
        output: {
          comments: false,
        },
        compress: {
          warnings: false,
          drop_console: true, // eslint-disable-line camelcase
        },
      },
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
module.exports = merge(base, productionConfig);
