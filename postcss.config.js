/* eslint-disable import/no-extraneous-dependencies, global-require */

const path = require('path');

// // Other build files.
const merge = require('webpack-merge');
const projectConfig = require('./webpack-project.config');

// Generate webpack config for this project using options object.
const project = require('@eightshift/frontend-libs/webpack/postcss');

// You can append project specific config using this object.
const projectSpecific = {
  plugins: {
    'postcss-font-magician': {
      display: 'swap',
      hosted: path.join('/', projectConfig.config.projectPath, projectConfig.config.outputPath),
      foundries: ['hosted'],
    },
  },
};

module.exports = merge(project, projectSpecific);
