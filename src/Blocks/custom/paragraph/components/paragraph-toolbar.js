import React from 'react'; // eslint-disable-line no-unused-vars
import { ParagraphToolbar as ParagraphToolbarComponent } from '../../../components/paragraph/components/paragraph-toolbar';

export const ParagraphToolbar = ({ attributes, setAttributes }) => {
	return (
		<ParagraphToolbarComponent
			{...attributes}
			setAttributes={setAttributes}
		/>
	);
};
