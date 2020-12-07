import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import { ImageOptions } from '../../../components/image/components/image-options';
import { HeadingOptions } from '../../../components/heading/components/heading-options';
import { ParagraphOptions } from '../../../components/paragraph/components/paragraph-options';
import { ButtonOptions } from '../../../components/button/components/button-options';

export const CardOptions = (attributes) => {
	const {
		setAttributes,
	} = attributes;

	return (
		<Fragment>

			<ImageOptions
				{...attributes}
				setAttributes={setAttributes}
			/>

			<hr />

			<HeadingOptions
				{...attributes}
				setAttributes={setAttributes}
			/>

			<hr />

			<ParagraphOptions
				{...attributes}
				setAttributes={setAttributes}
			/>

			<hr />

			<ButtonOptions
				{...attributes}
				setAttributes={setAttributes}
			/>

		</Fragment>
	);
};
