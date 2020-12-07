import React from 'react'; // eslint-disable-line no-unused-vars
import { createBlock } from '@wordpress/blocks';
import manifest from '../../manifest.json';
import manifestButton from '../link/manifest.json';

export const transforms = {
	to: [
		{
			type: 'block',
			blocks: [`${manifest.namespace}/${manifestButton.blockName}`],
			transform: (attributes) => (
				createBlock(
					`${manifest.namespace}/${manifestButton.blockName}`,
					{
						buttonContent: attributes.linkContent,
						buttonUrl: attributes.linkUrl,
						buttonId: attributes.linkId,
						buttonSize: attributes.linkSize,
						buttonColor: attributes.linkColor,
						buttonAlign: attributes.linkAlign,
						buttonIsAnchor: attributes.linkIsAnchor,
						buttonIsNewTab: attributes.linkIsNewTab,
						buttonAttrs: attributes.linkAttrs,
						buttonAriaLabel: attributes.linkAriaLabel,
						buttonUse: attributes.linkUse,
					}
				)
			),
		},
	],
};
