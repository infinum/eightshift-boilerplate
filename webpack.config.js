const DEV = process.env.NODE_ENV !== 'production';

const path = require('path');

const CleanWebpackPlugin = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');

const appPath = `${path.resolve(__dirname)}`;
const themeName = 'theme_name';

// Theme
const themePath = `/wp-content/themes/${themeName}/skin`;
const pathTheme = `${appPath}${themePath}`;
const publicPathTheme = `${themePath}/public/`;
const entryTheme = `${pathTheme}/assets/application.js`;
const outputTheme = `${pathTheme}/public`;

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
      exclude: /node_modules/
    },
    {
      test: /\.json$/,
      use: 'json-loader'
    },
    {
      test: /\.(png|svg|jpg|jpeg|gif|ico)$/,
      use: `file-loader?name=${outputImages}`
    },
    {
      test: /\.(eot|otf|ttf|woff|woff2)$/,
      use: `file-loader?name=${outputFonts}`
    },
    {
      test: /\.scss$/,
      use: ExtractTextPlugin.extract({
        fallback: 'style-loader',
        use: ['css-loader', 'postcss-loader', 'sass-loader']
      })
    }
  ]
};

const pluginsTheme = [
  new CleanWebpackPlugin([outputTheme]),
  new ExtractTextPlugin(outputCss)

  // Analyse assets
  // new BundleAnalyzerPlugin()
];

if (!DEV) {
  pluginsTheme.push(
    new UglifyJSPlugin({
      comments: false,
      sourceMap: true
    })
  );
}

module.exports = [

  // Theme Skin
  {
    context: path.join(__dirname),
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
  }
];
