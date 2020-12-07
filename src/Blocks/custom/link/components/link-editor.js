import React from 'react'; // eslint-disable-line no-unused-vars
import { LinkEditor as LinkEditorComponent } from '../../../components/link/components/link-editor';

export const LinkEditor = ({ attributes, setAttributes }) => {
	return (
		<LinkEditorComponent
			{...attributes}
			setAttributes={setAttributes}
		/>
	);
};
