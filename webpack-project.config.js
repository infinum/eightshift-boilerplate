// All config and default setting overrides must be provided when using this object.

module.exports = {
  config: {
    projectDir: __dirname, // Current project directory absolute path.
    projectUrl: 'dev.boilerplate.com', // Used for providing browsersync functionality.
    projectPath: 'wp-content/themes/eightshift-boilerplate', // Project path relative to project root.
    assetsPath: 'src/blocks/assets', // Assets path after projectPath location.
    outputPath: 'public', // Public output path after projectPath location.
  },
};
