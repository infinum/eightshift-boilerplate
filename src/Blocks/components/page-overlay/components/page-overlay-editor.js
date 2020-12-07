import React from 'react'; // eslint-disable-line no-unused-vars
import classnames from 'classnames';
import { Fragment } from '@wordpress/element';
import { selectorBlock, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const PageOverlayEditor = (attributes) => {
	const {
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,

		pageOverlayUse = checkAttr('pageOverlayUse', attributes, manifest),
	} = attributes;

	const overlayClass = classnames([
		componentClass,
		selectorBlock(blockClass, selectorClass),
	]);

	return (
		<Fragment>
			{pageOverlayUse &&
				<div className={overlayClass}></div>
			}
		</Fragment>
	);
};
