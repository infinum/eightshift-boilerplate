/* eslint-disable import/no-dynamic-require, global-require */

/**
 * This is a main entrypoint for Webpack config.
 * All the settings are pulled from node_modules/@eightshift/frontend-libs/webpack.
 * We are loading mostly used configuration but you can always override or turn off the default setup and provide your own.
 * Please refere to Eigthshift-libs wiki for details.
 *
 * @since 4.0.0 Moved to eightshift-libs.
 * @since 1.0.0
 */
const merge = require('webpack-merge');
const projectConfig = require('./webpack-project.config');

module.exports = (env, argv) => {

  // Generate webpack config for this project using options object.
  const project = require('./node_modules/@eightshift/frontend-libs/webpack/index.js')(argv.mode, projectConfig);

  // You can append project specific config using this object.
  const projectSpecific = {};

  // Output webpack.
  return merge(project, projectSpecific);
};
