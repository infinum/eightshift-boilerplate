const path = require('path');

// Create Theme/Plugin config variable.
// Define path to the project from the WordPress root. This is used to output the correct path to the manifest.json.
const configData = getConfig('wp-content/themes/wp-boilerplate'); // eslint-disable-line no-use-before-define

// Export config to use in other Webpack files.
module.exports = {
  theme: {
    publicPath: configData.publicPath,
    assetsPath: configData.assetsPath,
    assetsEntry: configData.assetsEntry,
    assetsAdminEntry: configData.assetsAdminEntry,
    blocksEntry: configData.blocksEntry,
    blocksEditorEntry: configData.blocksEditorEntry,
    output: configData.output,
    nodeModules: configData.nodeModules,
    appPath: configData.appPath,
  },
};

// Generate all paths required for Webpack build to work.
function getConfig(assetsPath) {
  const dataPath = assetsPath.replace(/^\/|\/$/g, '');
  const appPath = `${path.resolve(`/${__dirname}`, '..')}`;

  const containerPath = `${dataPath}/skin`;
  const containerFullPath = `${appPath}/skin`;

  const blocksContainerPath = `${dataPath}/src/blocks/assets`;
  const blocksFullPath = `${appPath}${blocksContainerPath}`;

  return {
    containerPath,
    containerFullPath,
    publicPath: `${containerPath}/public/`,

    assetsPath: `${containerPath}/assets/`,
    assetsEntry: `${containerFullPath}/assets/application.js`,
    assetsAdminEntry: `${containerFullPath}/assets/application-admin.js`,
    blocksEntry: `${blocksFullPath}/application-blocks.js`,
    blocksEditorEntry: `${blocksFullPath}/application-blocks-editor.js`,
    output: `${containerFullPath}/public`,
    nodeModules: `${appPath}/node_modules`,
    appPath,
  };
}
