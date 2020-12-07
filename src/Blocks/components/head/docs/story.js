import React from 'react'; // eslint-disable-line no-unused-vars
import readme from './readme.md';
import manifest from '../manifest.json';

export default {
	title: `Components|${manifest.title}`,
	parameters: {
		notes: readme,
	},
};

export const editor = () => (
	<div>{`Component - ${manifest.title} - Please check readme`}</div>
);
