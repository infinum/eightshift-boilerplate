import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import classnames from 'classnames';
import { selectorBlock, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const CopyrightEditor = (attributes) => {
	const {
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,

		copyrightUse = checkAttr('copyrightUse', attributes, manifest),

		copyrightBy = checkAttr('copyrightBy', attributes, manifest),
		copyrightYear = checkAttr('copyrightYear', attributes, manifest),
		copyrightContent = checkAttr('copyrightContent', attributes, manifest),
	} = attributes;

	const copyrightClass = classnames([
		componentClass,
		selectorBlock(blockClass, selectorClass),
	]);

	return (
		<Fragment>
			{copyrightUse &&
				<div className={copyrightClass}>
					{'&copy'} {copyrightBy} {copyrightYear} - {copyrightContent}
				</div>
			}
		</Fragment>
	);
};
