import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import { selector, selectorBlock, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const HeadingEditor = (attributes) => {
	const {
		setAttributes,
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,
		placeholder = __('Add Content', 'EightshiftBoilerplate'),

		headingUse = checkAttr('headingUse', attributes, manifest),

		headingContent = checkAttr('headingContent', attributes, manifest),
	} = attributes;

	const headingClass = classnames([
		componentClass,
		selector(componentClass, 'color', 'headingColor', attributes, manifest),
		selector(componentClass, 'size', 'headingSize', attributes, manifest),
		selector(componentClass, 'align', 'headingAlign', attributes, manifest),
		selectorBlock(blockClass, selectorClass),
	]);

	return (
		<Fragment>
			{headingUse &&
				<RichText
					className={headingClass}
					placeholder={placeholder}
					value={headingContent}
					onChange={(value) => setAttributes({ headingContent: value })}
					formattingControls={[]}
				/>
			}
		</Fragment>
	);
};
