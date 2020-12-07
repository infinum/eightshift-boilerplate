import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import classnames from 'classnames';
import { selectorBlock, checkAttr, selectorCustom } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const HamburgerEditor = (attributes) => {
	const {
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,

		hamburgerUse = checkAttr('hamburgerUse', attributes, manifest),
	} = attributes;

	const hamburgerClass = classnames([
		componentClass,
		selectorCustom(componentClass, `js-${componentClass}`),
		selectorBlock(blockClass, selectorClass),
	]);

	return (
		<Fragment>
			{hamburgerUse &&
				<button className={hamburgerClass}>
					<span className={`${componentClass}__wrap`}>
						<span className={`${componentClass}__line ${componentClass}__line--1`}></span>
						<span className={`${componentClass}__line ${componentClass}__line--2`}></span>
						<span className={`${componentClass}__line ${componentClass}__line--3`}></span>
					</span>
				</button>
			}
		</Fragment>
	);
};
