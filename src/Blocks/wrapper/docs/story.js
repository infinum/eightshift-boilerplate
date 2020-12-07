import React from 'react'; // eslint-disable-line no-unused-vars
import manifest from './../manifest.json';
import readme from './readme.md';
import { WrapperEditor } from '../components/wrapper-editor';
import { WrapperOptions } from '../components/wrapper-options';

export default {
	title: `Wrapper|${manifest.title}`,
	parameters: {
		notes: readme,
	},
};

const props = {
	attributes: manifest.example.attributes,
};

export const editor = () => (
	<WrapperEditor
		{...props}
		children={'This is wrapper children content.'}
	/>
);

export const options = () => (
	<WrapperOptions
		{...props}
	/>
);
