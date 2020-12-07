import React from 'react'; // eslint-disable-line no-unused-vars
import { createBlock } from '@wordpress/blocks';
import manifest from '../../manifest.json';
import manifestLink from '../link/manifest.json';

export const transforms = {
	to: [
		{
			type: 'block',
			blocks: [`${manifest.namespace}/${manifestLink.blockName}`],
			transform: (attributes) => (
				createBlock(
					`${manifest.namespace}/${manifestLink.blockName}`,
					{
						linkContent: attributes.buttonContent,
						linkUrl: attributes.buttonUrl,
						linkId: attributes.buttonId,
						linkSize: attributes.buttonSize,
						linkColor: attributes.buttonColor,
						linkAlign: attributes.buttonAlign,
						linkIsAnchor: attributes.buttonIsAnchor,
						linkIsNewTab: attributes.buttonIsNewTab,
						linkAttrs: attributes.buttonAttrs,
						linkAriaLabel: attributes.buttonAriaLabel,
						linkUse: attributes.buttonUse,
					}
				)
			),
		},
	],
};
