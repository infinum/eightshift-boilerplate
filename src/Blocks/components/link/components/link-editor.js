import React from 'react'; // eslint-disable-line no-unused-vars
import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import classnames from 'classnames';
import { RichText } from '@wordpress/block-editor';
import { selector, selectorBlock, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const LinkEditor = (attributes) => {
	const {
		setAttributes,
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,
		placeholder = __('Add Content', 'EightshiftBoilerplate'),

		linkUse = checkAttr('linkUse', attributes, manifest),

		linkContent = checkAttr('linkContent', attributes, manifest),
		linkUrl = checkAttr('linkUrl', attributes, manifest),
	} = attributes;

	const linkWrapClass = classnames([
		selectorBlock(componentClass, 'wrap'),
		selector(componentClass, 'align', 'linkAlign', attributes, manifest),
		selectorBlock(blockClass, `${selectorClass}-wrap`),
	]);

	const linkClass = classnames([
		componentClass,
		selector(componentClass, 'size', 'linkSize', attributes, manifest),
		selector(componentClass, 'color', 'linkColor', attributes, manifest),
		!(linkContent && linkUrl) && `${componentClass}-placeholder`,
		selectorBlock(blockClass, selectorClass),
	]);

	return (
		<Fragment>
			{linkUse &&
				<div className={linkWrapClass}>
					<RichText
						placeholder={placeholder}
						value={linkContent}
						onChange={(value) => setAttributes({ linkContent: value })}
						className={linkClass}
						keepPlaceholderOnFocus
						formattingControls={[]}
					/>
				</div>
			}
		</Fragment>
	);
};
