/* eslint-disable no-unused-vars, import/no-extraneous-dependencies */

import React from 'react';
import classnames from 'classnames';
import { InnerBlocks } from '@wordpress/block-editor';
import { responsiveSelectors, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';
import globalManifest from './../../../manifest.json';

export const ColumnsEditor = ({ attributes }) => {
	const {
		allowedBlocks,
		blockClass,
	} = attributes;

	const gutter = {
		large: checkAttr('gutterLarge', attributes, manifest),
		desktop: checkAttr('gutterDesktop', attributes, manifest),
		tablet: checkAttr('gutterTablet', attributes, manifest),
		mobile: checkAttr('gutterMobile', attributes, manifest),
	};

	const verticalSpacing = {
		large: checkAttr('verticalSpacingLarge', attributes, manifest),
		desktop: checkAttr('verticalSpacingDesktop', attributes, manifest),
		tablet: checkAttr('verticalSpacingTablet', attributes, manifest),
		mobile: checkAttr('verticalSpacingMobile', attributes, manifest),
	};

	const componentClass = classnames([
		blockClass,
		globalManifest.globalVariables.customBlocksName,
		responsiveSelectors(gutter, 'gutter', blockClass),
		responsiveSelectors(verticalSpacing, 'verticalSpacing', blockClass),
	]);

	return (
		<div className={componentClass}>
			<InnerBlocks
				allowedBlocks={(typeof allowedBlocks === 'undefined') || allowedBlocks}
			/>
		</div>
	);
};
