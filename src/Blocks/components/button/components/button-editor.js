import React from 'react'; // eslint-disable-line no-unused-vars
import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import classnames from 'classnames';
import { RichText } from '@wordpress/block-editor';
import { selector, selectorBlock, selectorCustom, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const ButtonEditor = (attributes) => {
	const {
		setAttributes,
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,
		placeholder = __('Add Content', 'EightshiftBoilerplate'),

		buttonUse = checkAttr('buttonUse', attributes, manifest),

		buttonContent = checkAttr('buttonContent', attributes, manifest),
		buttonUrl = checkAttr('buttonUrl', attributes, manifest),
	} = attributes;

	const buttonWrapClass = classnames([
		selectorBlock(componentClass, 'wrap'),
		selector(componentClass, 'align', 'buttonAlign', attributes, manifest),
		selectorBlock(blockClass, `${selectorClass}-wrap`),
	]);

	const buttonClass = classnames([
		componentClass,
		selector(componentClass, 'size', 'buttonSize', attributes, manifest),
		selector(componentClass, 'color', 'buttonColor', attributes, manifest),
		selector(componentClass, 'size-width', 'buttonWidth', attributes, manifest),
		selectorCustom(!(buttonContent && buttonUrl), `${componentClass}-placeholder`),
		selectorBlock(blockClass, selectorClass),
	]);

	return (
		<Fragment>
			{buttonUse &&
				<div className={buttonWrapClass}>
					<RichText
						placeholder={placeholder}
						value={buttonContent}
						onChange={(value) => setAttributes({ buttonContent: value })}
						className={buttonClass}
						keepPlaceholderOnFocus
						formattingControls={[]}
					/>
				</div>
			}
		</Fragment>
	);
};
