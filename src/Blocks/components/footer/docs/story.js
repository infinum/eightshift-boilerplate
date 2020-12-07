import React from 'react'; // eslint-disable-line no-unused-vars
import readme from './readme.md';
import manifest from '../manifest.json';
import { LayoutThreeColumnsEditor } from '../../layout-three-columns/components/layout-three-columns-editor';
import { editor as CopyrightEditor } from '../../copyright/docs/story';

export default {
	title: `Components|${manifest.title}`,
	parameters: {
		notes: readme,
	},
};

export const editor = () => (
	<LayoutThreeColumnsEditor
		selectorClass={manifest.componentClass}
		layoutLeft={[
			<CopyrightEditor key={'copyright'} />,
		]}
		layoutCenter={[
		]}
		layoutRight={[
		]}
	/>
);
