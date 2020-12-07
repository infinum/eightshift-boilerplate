import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import { selector, selectorBlock, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const ParagraphEditor = (attributes) => {
	const {
		setAttributes,
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,
		placeholder = __('Add Content', 'EightshiftBoilerplate'),

		paragraphUse = checkAttr('paragraphUse', attributes, manifest),

		paragraphContent = checkAttr('paragraphContent', attributes, manifest),
	} = attributes;

	const paragraphClass = classnames([
		componentClass,
		selector(componentClass, 'color', 'paragraphColor', attributes, manifest),
		selector(componentClass, 'size', 'paragraphSize', attributes, manifest),
		selector(componentClass, 'align', 'paragraphAlign', attributes, manifest),
		selectorBlock(blockClass, selectorClass),
	]);

	return (
		<Fragment>
			{paragraphUse &&
				<RichText
					className={paragraphClass}
					placeholder={placeholder}
					value={paragraphContent}
					onChange={(value) => setAttributes({ paragraphContent: value })}
					formattingControls={['bold', 'link']}
				/>
			}
		</Fragment>
	);
};
