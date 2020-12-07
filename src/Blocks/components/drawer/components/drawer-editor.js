import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import classnames from 'classnames';
import { checkAttr, selector, selectorBlock, selectorCustom } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const DrawerEditor = (attributes) => {
	const {
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,

		drawerUse = checkAttr('drawerUse', attributes, manifest),

		drawerMenu = checkAttr('drawerMenu', attributes, manifest),
		drawerTrigger = checkAttr('drawerTrigger', attributes, manifest),
		drawerOverlay = checkAttr('drawerOverlay', attributes, manifest),
	} = attributes;

	const drawerClass = classnames([
		componentClass,
		selectorCustom(componentClass, `js-${componentClass}`),
		selector(componentClass, 'position', 'drawerPosition', attributes, manifest),
		selectorBlock(blockClass, selectorClass),
	]);

	return (
		<Fragment>
			{drawerUse &&
				<div
					className={drawerClass}
					data-trigger={drawerTrigger}
					data-overlay={drawerOverlay}
				>
					{drawerMenu}
				</div>
			}
		</Fragment>
	);
};
