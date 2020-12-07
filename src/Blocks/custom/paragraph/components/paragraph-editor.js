import React from 'react'; // eslint-disable-line no-unused-vars
import { ParagraphEditor as ParagraphEditorComponent } from '../../../components/paragraph/components/paragraph-editor';

export const ParagraphEditor = ({ attributes, setAttributes }) => {
	return (
		<ParagraphEditorComponent
			{...attributes}
			setAttributes={setAttributes}
		/>
	);
};
