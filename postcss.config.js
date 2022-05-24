const autoprefixer = require('autoprefixer');
const globalManifest = require('./src/Blocks/manifest.json');
const transformRemsPlugin = require('./postcss/es-transforms-rems');

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
