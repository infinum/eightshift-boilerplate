import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import { selector, selectorBlock, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const ListsEditor = (attributes) => {
	const {
		setAttributes,
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,
		placeholder = __('Add Content', 'EightshiftBoilerplate'),

		listsUse = checkAttr('listsUse', attributes, manifest),

		listsContent = checkAttr('listsContent', attributes, manifest),
		listsOrdered = checkAttr('listsOrdered', attributes, manifest),
	} = attributes;

	const listsClass = classnames([
		componentClass,
		selector(componentClass, 'color', 'listsColor', attributes, manifest),
		selector(componentClass, 'size', 'listsSize', attributes, manifest),
		selector(componentClass, 'align', 'listsAlign', attributes, manifest),
		selectorBlock(blockClass, selectorClass),
	]);

	return (
		<Fragment>
			{listsUse &&
				<RichText
					tagName={listsOrdered}
					multiline="li"
					className={listsClass}
					placeholder={placeholder}
					value={listsContent}
					onChange={(value) => setAttributes({ listsContent: value })}
					onTagNameChange={(value) => setAttributes({ listsOrdered: value })}
					formattingControls={[]}
				/>
			}
		</Fragment>
	);
};
