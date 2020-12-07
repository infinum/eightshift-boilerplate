import React from 'react'; // eslint-disable-line no-unused-vars
import { createBlock } from '@wordpress/blocks';
import manifest from '../../manifest.json';
import manifestParagraph from './manifest.json';
import manifestHeading from '../heading/manifest.json';

export const transforms = {
	from: [
		{
			type: 'block',
			blocks: [`${manifest.namespace}/${manifestHeading.blockName}`],
			transform: ({ heading }) => (
				createBlock(`${manifest.namespace}/${manifestParagraph.blockName}`, { paragraph: heading })
			),
		},
	],
};
