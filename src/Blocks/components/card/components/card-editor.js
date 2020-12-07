import React from 'react'; // eslint-disable-line no-unused-vars
import classnames from 'classnames';
import { selectorBlock } from '@eightshift/frontend-libs/scripts/helpers';
import { ImageEditor } from '../../../components/image/components/image-editor';
import { HeadingEditor } from '../../../components/heading/components/heading-editor';
import { ParagraphEditor } from '../../../components/paragraph/components/paragraph-editor';
import { ButtonEditor } from '../../../components/button/components/button-editor';
import manifest from './../manifest.json';

export const CardEditor = (attributes) => {
	const {
		setAttributes,
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,
	} = attributes;

	const cardClass = classnames([
		componentClass,
		selectorBlock(blockClass, selectorClass),
	]);

	return (
		<div className={cardClass}>

			<ImageEditor
				{...attributes}
				setAttributes={setAttributes}
				blockClass={componentClass}
			/>

			<HeadingEditor
				{...attributes}
				setAttributes={setAttributes}
				blockClass={componentClass}
			/>

			<ParagraphEditor
				{...attributes}
				setAttributes={setAttributes}
				blockClass={componentClass}
			/>
			<ButtonEditor
				{...attributes}
				setAttributes={setAttributes}
				blockClass={componentClass}
			/>

		</div>
	);
};
