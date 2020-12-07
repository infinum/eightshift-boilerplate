import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import readme from './readme.md';
import manifest from './../manifest.json';
import { ImageEditor } from '../components/image-editor';
import { ImageOptions } from '../components/image-options';
import { ImageToolbar } from '../components/image-toolbar';

export default {
	title: `Components|${manifest.title}`,
	parameters: {
		notes: readme,
	},
};

const props = manifest.example.attributes;

export const editor = () => (
	<ImageEditor {...props} />
);

export const editorWithUpload = () => (
	<ImageEditor
		{...props}
		imageUrl={''}
	/>
);

export const editorWithPlaceholder = () => (
	<ImageEditor
		{...props}
		imageUrl={''}
		imageUsePlaceholder={true}
	/>
);

export const editorBackgroundImage = () => (
	<ImageEditor
		{...props}
		imageBg={true}
	/>
);

export const options = () => (
	<ImageOptions {...props} />
);

export const optionsWithUpload = () => (
	<ImageOptions
		{...props}
		imageUrl={''}
		imageUsePlaceholder={true}
	/>
);

export const toolbar = () => (
	<ImageToolbar {...props} />
);

export const align = () => (
	<Fragment>
		{manifest.options.aligns.map((values, index) => (
			<Fragment key={index}>
				<ImageEditor
					{...props}
					imageAlign={values}
				/>
				<br />
			</Fragment>
		))}
	</Fragment>
);
