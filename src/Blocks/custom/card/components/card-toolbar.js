import React from 'react'; // eslint-disable-line no-unused-vars
import { CardToolbar as CardToolbarCompnent } from '../../../components/card/components/card-toolbar';

export const CardToolbar = ({ attributes, setAttributes }) => {
	return (
		<CardToolbarCompnent
			{...attributes}
			setAttributes={setAttributes}
		/>
	);
};
