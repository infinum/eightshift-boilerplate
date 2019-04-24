// Webpack specific imports.
const merge = require('webpack-merge');
const webpack = require('webpack');

// Other build files.
const config = require('./config');
const react = require('./react');

// Plugins.
const CleanWebpackPlugin = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');

// All Plugins used in production and development build.
const plugins = [

  // Provide global variables to window object.
  new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
  }),

  // Create manifest.json file.
  new ManifestPlugin({
    seed: {},
  }),
];

// All Optimizations used in production and development build.
const optimization = {
  runtimeChunk: false,
};

// All Loaders used in production and development build.
const loaders = {
  rules: [
    {
      test: /\.(js|jsx)$/,
      exclude: /node_modules/,
      use: 'babel-loader',
    },
    {
      test: /\.(png|svg|jpg|jpeg|gif|ico)$/,
      exclude: [/fonts/, /node_modules/],
      use: 'file-loader?name=[name].[ext]',
    },
    {
      test: /\.(eot|otf|ttf|woff|woff2|svg)$/,
      exclude: [/images/, /node_modules/],
      use: 'file-loader?name=[name].[ext]',
    },
    {
      test: /\.scss$/,
      exclude: /node_modules/,
      use: [
        MiniCssExtractPlugin.loader,
        {
          loader: 'css-loader',
          options: {
            sourceMap: true,
            url: false,
          },
        },
        {
          loader: 'postcss-loader',
          options: {
            sourceMap: true,
          },
        },
        {
          loader: 'sass-loader',
          options: {
            sourceMap: true,
          },
        },
      ],
    },
  ],
};

// Main Webpack build setup.
const base = {
  optimization,
  plugins,
  module: loaders,
};

// Combine base with react specific config.
// If Gutenberg is not used, react config can be removed.
module.exports = merge(base, react);
