import React from 'react'; // eslint-disable-line no-unused-vars
import { CardEditor as CardEditorComponent } from '../../../components/card/components/card-editor';

export const CardEditor = ({ attributes, setAttributes }) => {
	return (
		<CardEditorComponent
			{...attributes}
			setAttributes={setAttributes}
		/>
	);
};
