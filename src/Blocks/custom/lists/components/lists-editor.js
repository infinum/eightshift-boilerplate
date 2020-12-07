import React from 'react'; // eslint-disable-line no-unused-vars
import { ListsEditor as ListsEditorComponent } from '../../../components/lists/components/lists-editor';

export const ListsEditor = ({ attributes, setAttributes }) => {
	return (
		<ListsEditorComponent
			{...attributes}
			setAttributes={setAttributes}
		/>
	);
};
