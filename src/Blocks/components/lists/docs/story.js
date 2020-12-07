import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import readme from './readme.md';
import manifest from './../manifest.json';
import { ListsEditor } from '../components/lists-editor';
import { ListsOptions } from '../components/lists-options';
import { ListsToolbar } from '../components/lists-toolbar';

export default {
	title: `Components|${manifest.title}`,
	parameters: {
		notes: readme,
	},
};

const props = manifest.example.attributes;

export const editor = () => (
	<ListsEditor {...props} />
);

export const options = () => (
	<ListsOptions {...props} />
);

export const toolbar = () => (
	<ListsToolbar {...props} />
);

export const size = () => (
	<Fragment>
		{manifest.options.sizes.map((values, index) => (
			<Fragment key={index}>
				<ListsEditor
					{...props}
					listsContent={`<li>List Item ${values.label} 1</li><li>List Item ${values.label} 2</li>`}
					listsSize={values.value}
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
				<ListsEditor
					{...props}
					listsContent={`<li>List Item ${values} 1</li><li>List Item ${values} 2</li>`}
					listsAlign={values}
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
				<ListsEditor
					{...props}
					listsContent={`<li>List Item ${values} 1</li><li>List Item ${values} 2</li>`}
					listsColor={values}
				/>
				<br />
			</Fragment>
		))}
	</Fragment>
);
