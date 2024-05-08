/**
 * This is a main entrypoint for Webpack config.
 * All the settings are pulled from node_modules/@eightshift/frontend-libs/webpack.
 * We are loading mostly used configuration but you can always override or turn off the default setup and provide your own.
 * Please referer to Eightshift-libs wiki for details.
 */
module.exports = (env, argv) => {

	const projectConfig = {
		config: {
			projectDir: __dirname, // Current project directory absolute path.
			projectUrl: 'dev.boilerplate.com', // Used for providing browsersync functionality.
			projectPath: 'wp-content/themes/eightshift-boilerplate', // Project path relative to project root.
		},
	};

	// Generate webpack config for this project using options object.
	return require('./node_modules/@eightshift/frontend-libs/webpack')(argv.mode, projectConfig);
};
