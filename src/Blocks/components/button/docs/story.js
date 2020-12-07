import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import readme from './readme.md';
import manifest from './../manifest.json';
import { ButtonEditor } from '../components/button-editor';
import { ButtonOptions } from '../components/button-options';
import { ButtonToolbar } from '../components/button-toolbar';

export default {
	title: `Components|${manifest.title}`,
	parameters: {
		notes: readme,
	},
};

const props = manifest.example.attributes;

export const editor = () => (
	<ButtonEditor {...props} />
);

export const options = () => (
	<ButtonOptions {...props} />
);

export const toolbar = () => (
	<ButtonToolbar {...props} />
);

export const size = () => (
	<Fragment>
		{manifest.options.sizes.map((values, index) => (
			<Fragment key={index}>
				<ButtonEditor
					{...props}
					buttonContent={values.label}
					buttonSize={values.value}
				/>
				<br />
			</Fragment>
		))}
	</Fragment>
);

export const width = () => (
	<Fragment>
		{manifest.options.widths.map((values, index) => (
			<Fragment key={index}>
				<ButtonEditor
					{...props}
					buttonContent={values.label}
					buttonWidth={values.value}
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
				<ButtonEditor
					{...props}
					buttonContent={values}
					buttonAlign={values}
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
				<ButtonEditor
					{...props}
					buttonContent={values}
					buttonColor={values}
				/>
				<br />
			</Fragment>
		))}
	</Fragment>
);
