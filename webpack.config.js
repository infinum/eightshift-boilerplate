/* global process __dirname */
const DEV = process.env.NODE_ENV !== 'production';

const path = require('path');
const webpack = require('webpack');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');

const appPath = `${path.resolve(__dirname)}`;

// Dev Server
const proxyUrl = 'dev.boilerplate.com'; // local dev url example: dev.wordpress.com

// Theme
const themeName = 'inf_theme';
const themePath = `wp-content/themes/${themeName}/skin`;
const themeFullPath = `${appPath}/${themePath}`;
const themePublicPath = `${themePath}/public/`;
const themeEntry = `${themeFullPath}/assets/application.js`;
const themeAdminEntry = `${themeFullPath}/assets/application-admin.js`;
const themeOutput = `${themeFullPath}/public`;

// Outputs
const outputType = `${DEV ? '[name]' : '[name]-[hash]'}`;
const outputJs = `scripts/${outputType}.js`;
const outputCss = `styles/${outputType}.css`;
const outputFile = `${outputType}.[ext]`;
const outputImages = `images/${outputFile}`;
const outputFonts = `fonts/${outputFile}`;


// All loaders to use on assets.
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
      use: [
        MiniCssExtractPlugin.loader,
        'css-loader', 'postcss-loader', 'sass-loader',
      ],
    },
  ],
};

// All plugins to use.
const allPlugins = [

  // Convert JS to CSS.
  new MiniCssExtractPlugin({
    filename: outputCss,
  }),

  // Gives you jQuery with in the webpack so no need for impoting it.
  new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
  }),

  // Use BrowserSync.
  new BrowserSyncPlugin(
    {
      host: 'localhost',
      port: 3000,
      proxy: proxyUrl,
      files: [
        {
          match: [
            'wp-content/themes/**/*.php',
            'wp-content/plugins/**/*.php',
            `${themePublicPath}styles/*.css`,
          ],
        },
      ],
      notify: true,
    },
    {
      reload: false,
    },
  ),

  // Copy from one target to new destination.
  new CopyWebpackPlugin([

    // Find jQuery in node_modules and copy it to public folder
    {
      from: `${appPath}/node_modules/jquery/dist/jquery.min.js`,
      to: `${themeOutput}/scripts/vendors`,
    },

    // If using images in css to reference directly put them in this folder. That will override the cache-busting.
    {
      from: `${themePath}/assets/static`,
      to: `${themeOutput}/static`,
    },
  ]),

  // Create manifest.json file.
  new ManifestPlugin(),
];

// General optimisations.
const allOptimizations = {
  runtimeChunk: false,
  splitChunks: {
    cacheGroups: {
      commons: {
        test: /[\\/]node_modules[\\/]/,
        name: 'vendors',
        chunks: 'all',
      },
    },
  },
};

// Use only for production build
if (!DEV) {
  allOptimizations.minimizer = [

    // Optimise for production.
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
  ];

  // Delete public folder.
  allPlugins.push(new CleanWebpackPlugin([themeOutput]));
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

    // Don't bundle jQuery but expect it from a different source.
    externals: {
      jquery: 'jQuery',
    },

    optimization: allOptimizations,

    module: allModules,

    plugins: allPlugins,

    devtool: DEV ? '' : 'source-map',
  },
];
