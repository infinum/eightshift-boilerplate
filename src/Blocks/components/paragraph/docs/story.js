import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import readme from './readme.md';
import manifest from './../manifest.json';
import { ParagraphEditor } from '../components/paragraph-editor';
import { ParagraphOptions } from '../components/paragraph-options';
import { ParagraphToolbar } from '../components/paragraph-toolbar';

export default {
	title: `Components|${manifest.title}`,
	parameters: {
		notes: readme,
	},
};

const props = manifest.example.attributes;

export const editor = () => (
	<ParagraphEditor {...props} />
);

export const options = () => (
	<ParagraphOptions {...props} />
);

export const toolbar = () => (
	<ParagraphToolbar {...props} />
);

export const size = () => (
	<Fragment>
		{manifest.options.sizes.map((values, index) => (
			<Fragment key={index}>
				<ParagraphEditor
					{...props}
					paragraphContent={values.label}
					paragraphSize={values.value}
				/>
				<br />
			</Fragment>
		))}
	</Fragment>
);

export const align = () => (
	<Fragment>
		{manifest.options.aligns.map((values, index) => (
			<Fragment key={index}>
				<ParagraphEditor
					{...props}
					paragraphContent={values}
					paragraphAlign={values}
				/>
				<br />
			</Fragment>
		))}
	</Fragment>
);

export const color = () => (
	<Fragment>
		{manifest.options.colors.map((values, index) => (
			<Fragment key={index}>
				<ParagraphEditor
					{...props}
					paragraphContent={values}
					paragraphColor={values}
				/>
				<br />
			</Fragment>
		))}
	</Fragment>
);
