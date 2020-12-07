/* eslint-disable no-unused-vars */

import React from 'react';
import { assign } from 'lodash';
import { createHigherOrderComponent } from '@wordpress/compose';
import globalManifest from '../manifest.json';

const { namespace } = globalManifest;

// Add options to the Gutenberg markup.
const parentComponentBlock = createHigherOrderComponent((BlockListBlock) => {
	return (innerProps) => {
		const {
			name,
		} = innerProps;

		let updatedProps = innerProps;

		if (name.split('/')[0] === namespace) {
			updatedProps = assign(
				{},
				innerProps,
				{
					className: globalManifest.globalVariables.customBlocksName,
				}
			);
		}

		return wp.element.createElement(
			BlockListBlock,
			updatedProps
		);
	};
}, 'parentComponentBlock');

export const hooks = () => {
	wp.hooks.addFilter('editor.BlockListBlock', namespace, parentComponentBlock);
};
