import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import readme from './readme.md';
import manifest from './../manifest.json';
import { LinkEditor } from '../components/link-editor';
import { LinkOptions } from '../components/link-options';
import { LinkToolbar } from '../components/link-toolbar';

export default {
	title: `Components|${manifest.title}`,
	parameters: {
		notes: readme,
	},
};

const props = manifest.example.attributes;

export const editor = () => (
	<LinkEditor {...props} />
);

export const options = () => (
	<LinkOptions {...props} />
);

export const toolbar = () => (
	<LinkToolbar {...props} />
);

export const size = () => (
	<Fragment>
		{manifest.options.sizes.map((values, index) => (
			<Fragment key={index}>
				<LinkEditor
					{...props}
					linkContent={values.label}
					linkSize={values.value}
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
				<LinkEditor
					{...props}
					linkContent={values}
					linkAlign={values}
				/>
				<br />
			</Fragment>
		))}
	</Fragment>
);

export const colors = () => (
	<Fragment>
		{manifest.options.colors.map((values, index) => (
			<Fragment key={index}>
				<LinkEditor
					{...props}
					linkContent={values}
					linkColor={values}
				/>
				<br />
			</Fragment>
		))}
	</Fragment>
);
