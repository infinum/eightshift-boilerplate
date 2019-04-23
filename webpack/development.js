// Webpack specific imports.
const merge = require('webpack-merge');

// Other build files.
const base = require('./base');

// Plugins.
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

// Dev Server
const proxyUrl = 'dev.infinum.co'; // local dev url example: dev.wordpress.com

// All Plugins used in development build.
const plugins = [

  // Extracts scss files to css.
  new MiniCssExtractPlugin({
    filename: '[name].css',
  }),

  // Use BrowserSync to se live preview of all changes.
  new BrowserSyncPlugin(
    {
      host: 'localhost',
      port: 3000,
      proxy: proxyUrl,
      files: [
        {
          match: [
            '**/*.php',
            '**/*.css',
          ],
        },
      ],
      notify: true,
    },
    {
      reload: false,
    },
  ),
];

// Define developmentConfig setup.
const developmentConfig = {
  plugins,

  devtool: false,
};

// Combine base with developmentConfig specific config.
module.exports = merge(base, developmentConfig);
