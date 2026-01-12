/**
 * This is the main entry point for Block Editor blocks scripts used for the `WordPress admin editor`.
 * This file registers blocks dynamically using `registerBlocks` helper method.
 * File names must follow the naming convention to be able to run dynamically.
 *
 * `src/blocks/custom/block_name/manifest.json`.
 * `src/blocks/custom/block_name/block_name.js`.
 *
 * Usage: `WordPress block editor`.
 */

import domReady from '@wordpress/dom-ready';
import { setDefaultBlockName } from '@wordpress/blocks';
import { select } from '@wordpress/data';
import { registerBlocks, registerVariations, STORE_NAME } from '@eightshift/frontend-libs-tailwind/scripts/editor';
import { Wrapper } from '../../wrapper/wrapper';
import WrapperManifest from '../../wrapper/manifest.json';
import globalSettingsRaw from '../../manifest.json';
import { dynamicImport } from '@eightshift/frontend-libs-tailwind/scripts';
import { upperFirst } from '@eightshift/ui-components/utilities';
import Color from 'colorjs.io';

let styles = getComputedStyle(document.documentElement);

const colors = Object.entries({
	white: styles.getPropertyValue('--color-white'),
	black: styles.getPropertyValue('--color-black'),
}).reduce((acc, [key, value]) => {
	return [
		...acc,
		{
			name: upperFirst(key).replaceAll('-', ' '),
			slug: key,
			color: new Color(value).toGamut({ space: 'srgb' }).to('srgb').toString({ format: 'hex' }),
		},
	];
}, []);

const globalSettings = {
	...globalSettingsRaw,
	globalVariables: {
		...globalSettingsRaw.globalVariables,
		colors: colors,
	},
};

registerBlocks(
	globalSettings,
	Wrapper,
	WrapperManifest,
	require.context('./../../components', true, /manifest\.json$/),
	require.context('./../../custom', true, /manifest\.json$/),
	require.context('./../../custom', true, /-block.js$/),
	require.context('./../../custom', true, /-hooks.js$/),
	require.context('./../../custom', true, /-transforms.js$/),
	require.context('./../../custom', true, /-deprecations.js$/),
	require.context('./../../custom', true, /-overrides.js$/),
);

// registerVariations(
// 	globalSettings,
// 	require.context('./../../variations', true, /manifest.json$/),
// 	require.context('./../../custom', true, /manifest.json$/),
// 	require.context('./../../variations', true, /overrides.json$/),
// );

// Import styles.
dynamicImport(require.context('./../../components', true, /styles-editor.css$/));
dynamicImport(require.context('./../../custom', true, /styles-editor.css$/));
dynamicImport(require.context('./../../wrapper', true, /styles-editor.css$/));

// Change the default block to the custom paragraph.
// If changing this block update the blocks filter method in Blocks.php.
domReady(() => {
	const namespace = select(STORE_NAME).getSettingsNamespace();
	setDefaultBlockName(`${namespace}/paragraph`);
});
