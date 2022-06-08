const autoprefixer = require('autoprefixer');
const globalManifest = require('./src/Blocks/manifest.json');
const transformRemsPlugin = require('@eightshift/frontend-libs/scripts/postcss/rem-transforms');

module.exports = ({ file }) => {
	let plugins = [autoprefixer];

	if (globalManifest?.config?.useRemBaseSize && file.endsWith('/application-blocks-editor.scss')) {
		plugins = [
			...plugins,
			transformRemsPlugin,
		];
	}

	return {
		plugins,
	};
};
