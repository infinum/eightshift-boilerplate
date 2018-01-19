/* global process __dirname */

const DEV = process.env.NODE_ENV !== 'production';

const path = require('path');
const webpack = require('webpack');

const jQuery = require.resolve('jquery');

const CleanWebpackPlugin = require('clean-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');

const appPath = `${path.resolve(__dirname)}`;

// Dev Server
const proxyUrl = 'dev.boilerplate.com'; // local dev url example: dev.wordpress.com

// Theme
const themeName = 'init_theme_name';
const themePath = `/wp-content/themes/${themeName}/skin`;
const themeFullPath = `${appPath}${themePath}`;
const themePublicPath = `${themePath}/public/`;
const themeEntry = `${themeFullPath}/assets/application.js`;
const themeAdminEntry = `${themeFullPath}/assets/application-admin.js`;
const themeOutput = `${themeFullPath}/public`;

// Outputs
const outputJs = 'scripts/[name].js';
const outputCss = 'styles/[name].css';
const outputFile = '[name].[ext]';
const outputImages = `images/${outputFile}`;
const outputFonts = `fonts/${outputFile}`;

const allModules = {
  rules: [
    {
      test: /\.(js|jsx)$/,
      use: 'babel-loader',
      exclude: /node_modules/,
    },
    {
      test: /\.json$/,
      exclude: /node_modules/,
      use: 'file-loader',
    },
    {
      test: /\.(png|svg|jpg|jpeg|gif|ico)$/,
      exclude: [/fonts/, /node_modules/],
      use: `file-loader?name=${outputImages}`,
    },
    {
      test: /\.(eot|otf|ttf|woff|woff2|svg)$/,
      exclude: [/images/, /node_modules/],
      use: `file-loader?name=${outputFonts}`,
    },
    {
      test: /\.scss$/,
      exclude: /node_modules/,
      use: ExtractTextPlugin.extract({
        fallback: 'style-loader',
        use: ['css-loader', 'postcss-loader', 'sass-loader'],
      }),
    },
    {

      // Exposes jQuery for use outside Webpack build.
      test: jQuery,
      use: [{
        loader: 'expose-loader',
        options: 'jQuery',
      },
      {
        loader: 'expose-loader',
        options: '$',
      }],
    },
  ],
};

const allPlugins = [
  new ExtractTextPlugin(outputCss),

  new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
  }),

  // Use BrowserSync For assets
  new BrowserSyncPlugin({
    host: 'localhost',
    port: 3000,
    proxy: proxyUrl,
    files: [
      {
        match: ['wp-content/themes/**/*.php', 'wp-content/plugins/**/*.php'],
      },
    ],
  }),

  new webpack.DefinePlugin({
    'process.env': {
      NODE_ENV: JSON.stringify(process.env.NODE_ENV || 'development'),
    },
  }),

  new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),

  // Is using vendor files, but prefered to use npm
  new CopyWebpackPlugin([{
    from: `${themeFullPath}/assets/scripts/vendors`,
    to: `${themeOutput}/scripts/vendors`,
  }]),
];

// Use only for production build
if (!DEV) {
  allPlugins.push(
    new CleanWebpackPlugin([themeOutput]),
    new webpack.optimize.UglifyJsPlugin({
      output: {
        comments: false,
      },
      compress: {
        warnings: false,
        drop_console: true, // eslint-disable-line camelcase
      },
      sourceMap: true,
    })
  );
}

module.exports = [

  // Theme Skin
  {
    context: path.join(__dirname),
    entry: {
      application: [themeEntry],
      applicationAdmin: [themeAdminEntry],
    },
    output: {
      path: themeOutput,
      publicPath: themePublicPath,
      filename: outputJs,
    },

    module: allModules,

    plugins: allPlugins,

    devtool: DEV ? '#inline-source-map' : '',
  },
];
