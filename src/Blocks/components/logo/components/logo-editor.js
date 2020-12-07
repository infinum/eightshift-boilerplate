import React from 'react'; // eslint-disable-line no-unused-vars
import classnames from 'classnames';
import { Fragment } from '@wordpress/element';
import { selectorBlock, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const LogoEditor = (attributes) => {
	const {
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,

		logoUse = checkAttr('logoUse', attributes, manifest),

		logoSrc = checkAttr('logoSrc', attributes, manifest),
		logoAlt = checkAttr('logoAlt', attributes, manifest),
		logoTitle = checkAttr('logoTitle', attributes, manifest),
		logoHref = checkAttr('logoHref', attributes, manifest),
	} = attributes;

	const logoClass = classnames([
		componentClass,
		selectorBlock(blockClass, selectorClass),
	]);

	const imgClass = classnames([
		selectorBlock(componentClass, 'img'),
	]);

	return (
		<Fragment>
			{logoUse &&
				<a className={logoClass} href={logoHref}>
					<img
						src={logoSrc}
						alt={logoAlt}
						title={logoTitle}
						className={imgClass}
					/>
				</a>
			}
		</Fragment>
	);
};
