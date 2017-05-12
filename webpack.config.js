const path = require('path');

const CleanWebpackPlugin = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

const appPath = `${path.resolve(__dirname)}`;
const themeName = 'theme_name';
const pluginName = 'plugin_name';

// Theme
const themePath = `/wp-content/themes/${themeName}/skin`;
const pathTheme = `${appPath}${themePath}`;
const publicPathTheme = `${themePath}/public/`;
const entryTheme = `${pathTheme}/assets/application.js`;
const outputTheme = `${pathTheme}/public`;

// Plugin
const pluginPath = `/wp-content/plugins/${pluginName}/skin`;
const pathPlugin = `${appPath}${pluginPath}`;
const publicPathPlugin = `${pluginPath}/public/`;

// Plugin Admin section
const entryPluginAdmin = `${pathPlugin}/assets/admin.js`;
const outputPluginAdmin = `${pathPlugin}/public/admin`;

// Plugin Public section
const entryPluginPublic = `${pathPlugin}/assets/public.js`;
const outputPluginPublic = `${pathPlugin}/public/public`;

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
      loader: 'babel-loader',
      exclude: /node_modules/
    },
    {
      test: /\.json$/,
      loader: 'json-loader'
    },
    {
      test: /\.(png|svg|jpg|jpeg|gif|ico)$/,
      loader: `file-loader?name=${outputImages}`
    },
    {
      test: /\.(eot|otf|ttf|woff|woff2)$/,
      loader: `file-loader?name=${outputFonts}`
    },
    {
      test: /\.scss$/,
      use: ExtractTextPlugin.extract({
        fallback: 'style-loader',
        use: [
          {
            loader: 'css-loader'
          },
          {
            loader: 'postcss-loader'
          },
          {
            loader: 'sass-loader'
          }
        ]
      })
    }
  ]
};

const pluginsTheme = [
  new CleanWebpackPlugin([outputTheme]),
  new ExtractTextPlugin(outputCss)
];

const pluginsPluginAdmin = [
  new CleanWebpackPlugin([outputPluginAdmin]),
  new ExtractTextPlugin(outputCss)
];

const pluginsPluginPublic = [
  new CleanWebpackPlugin([outputPluginPublic]),
  new ExtractTextPlugin(outputCss)
];

module.exports = [

  // Theme Skin
  {
    entry: {
      application: [entryTheme]
    },
    output: {
      path: outputTheme,
      publicPath: publicPathTheme,
      filename: outputJs
    },

    module: allModules,

    plugins: pluginsTheme
  },

  // Plugin Admin section
  {
    entry: {
      admin: [entryPluginAdmin]
    },
    output: {
      path: outputPluginAdmin,
      publicPath: publicPathPlugin,
      filename: outputJs
    },

    module: allModules,

    plugins: pluginsPluginAdmin
  },

  // Plugin Public Section
  {
    entry: {
      public: [entryPluginPublic]
    },
    output: {
      path: outputPluginPublic,
      publicPath: publicPathPlugin,
      filename: outputJs
    },

    module: allModules,

    plugins: pluginsPluginPublic
  }
];
