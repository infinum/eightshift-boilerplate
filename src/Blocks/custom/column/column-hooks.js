/* eslint-disable no-unused-vars */

import React from 'react';
import { assign } from 'lodash';
import classnames from 'classnames';
import { createHigherOrderComponent } from '@wordpress/compose';
import { responsiveSelectors, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './manifest.json';
import globalManifest from '../../manifest.json';

const blockName = `${globalManifest.namespace}/${manifest.blockName}`;

// Add options to the Gutenberg markup.
const parentComponentBlock = createHigherOrderComponent((BlockListBlock) => {
	return (innerProps) => {
		const {
			name,
			attributes,
			attributes: {
				blockClass,
			},
		} = innerProps;

		let updatedProps = innerProps;

		// Move selectors to the parent div in DOM.
		if (name === blockName) {
			const width = {
				large: checkAttr('widthLarge', attributes, manifest),
				desktop: checkAttr('widthDesktop', attributes, manifest),
				tablet: checkAttr('widthTablet', attributes, manifest),
				mobile: checkAttr('widthMobile', attributes, manifest),
			};

			const offset = {
				large: checkAttr('offsetLarge', attributes, manifest),
				desktop: checkAttr('offsetDesktop', attributes, manifest),
				tablet: checkAttr('offsetTablet', attributes, manifest),
				mobile: checkAttr('offsetMobile', attributes, manifest),
			};

			const hide = {
				large: checkAttr('hideLarge', attributes, manifest),
				desktop: checkAttr('hideDesktop', attributes, manifest),
				tablet: checkAttr('hideTablet', attributes, manifest),
				mobile: checkAttr('hideMobile', attributes, manifest),
			};

			const order = {
				large: checkAttr('orderLarge', attributes, manifest),
				desktop: checkAttr('orderDesktop', attributes, manifest),
				tablet: checkAttr('orderTablet', attributes, manifest),
				mobile: checkAttr('orderMobile', attributes, manifest),
			};

			const componentClass = classnames([
				blockClass,
				globalManifest.globalVariables.customBlocksName,
				responsiveSelectors(width, 'width', blockClass),
				responsiveSelectors(offset, 'offset', blockClass),
				responsiveSelectors(order, 'order', blockClass),
				responsiveSelectors(hide, 'hide-editor', blockClass),
			]);

			updatedProps = assign(
				{},
				innerProps,
				{
					className: componentClass,
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
	wp.hooks.addFilter('editor.BlockListBlock', blockName, parentComponentBlock);
};
