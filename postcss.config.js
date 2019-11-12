/* eslint-disable import/no-extraneous-dependencies, global-require */

// // Other build files.
const merge = require('webpack-merge');

// Generate webpack config for this project using options object.
const project = require('@eightshift/frontend-libs/webpack/postcss');

// You can append project specific config using this object.
const projectSpecific = {
  plugins: [],
};

module.exports = merge(project, projectSpecific);
