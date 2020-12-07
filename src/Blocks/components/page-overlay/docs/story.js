import React from 'react'; // eslint-disable-line no-unused-vars
import readme from './readme.md';
import manifest from './../manifest.json';
import { PageOverlayEditor } from '../components/page-overlay-editor';

export default {
	title: `Components|${manifest.title}`,
	parameters: {
		notes: readme,
	},
};

const props = manifest.example.attributes;

const open = () => document.body.classList.add('page-overlay-shown');

export const editor = () => {
	open();

	return (
		<PageOverlayEditor {...props} />
	);
};
