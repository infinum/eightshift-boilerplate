import React from 'react'; // eslint-disable-line no-unused-vars
import readme from './readme.md';
import manifest from './../manifest.json';
import { HamburgerEditor } from '../components/hamburger-editor';

export default {
	title: `Components|${manifest.title}`,
	parameters: {
		notes: readme,
	},
};

const open = () => document.body.classList.add('menu-is-open');
const close = () => document.body.classList.remove('menu-is-open');

export const editor = () => {
	close();

	return (
		<HamburgerEditor />
	);
};

export const isOpen = () => {
	open();

	return (
		<HamburgerEditor />
	);
};
