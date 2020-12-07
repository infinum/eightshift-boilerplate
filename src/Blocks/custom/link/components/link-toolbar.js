import React from 'react'; // eslint-disable-line no-unused-vars
import { LinkToolbar as LinkToolbarComponent } from '../../../components/link/components/link-toolbar';

export const LinkToolbar = ({ attributes, setAttributes }) => {
	return (
		<LinkToolbarComponent
			{...attributes}
			setAttributes={setAttributes}
		/>
	);
};
