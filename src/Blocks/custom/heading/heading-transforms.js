import React from 'react'; // eslint-disable-line no-unused-vars
import { createBlock } from '@wordpress/blocks';
import manifest from '../../manifest.json';
import manifestHeading from './manifest.json';
import manifestParagraph from '../paragraph/manifest.json';

export const transforms = {
	from: [
		{
			type: 'block',
			blocks: [`${manifest.namespace}/${manifestParagraph.blockName}`],
			transform: ({ paragraph }) => (
				createBlock(`${manifest.namespace}/${manifestHeading.blockName}`, { heading: paragraph })
			),
		},
	],
};
