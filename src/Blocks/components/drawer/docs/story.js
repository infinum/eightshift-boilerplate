import React from 'react'; // eslint-disable-line no-unused-vars
import readme from './readme.md';
import manifest from './../manifest.json';
import { DrawerEditor } from '../components/drawer-editor';

export default {
	title: `Components|${manifest.title}`,
	parameters: {
		notes: readme,
	},
};

const props = manifest.example.attributes;

const open = () => document.body.classList.add('menu-is-open');

export const Left = () => {
	open();

	return (
		<DrawerEditor {...props} />
	);
};

export const Right = () => {
	open();

	return (
		<DrawerEditor
			{...props}
			drawerPosition={'right'}
			drawerMenu={'Menu Drawer Open From the Right'}
		/>
	);
};

export const Top = () => {
	open();

	return (
		<DrawerEditor
			{...props}
			drawerPosition={'top'}
			drawerMenu={'Menu Drawer Open From the Top'}
		/>
	);
};

export const Behind = () => {
	open();

	return (
		<DrawerEditor
			{...props}
			drawerPosition={'behind'}
			drawerMenu={'Menu Drawer Open From the Behind'}
		/>
	);
};
