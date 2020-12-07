import React from 'react'; // eslint-disable-line no-unused-vars
import { __ } from '@wordpress/i18n';
import { PanelBody } from '@wordpress/components';
import { ListsOptions as ListsOptionsComponent } from '../../../components/lists/components/lists-options';

export const ListsOptions = ({ attributes, setAttributes }) => {
	return (
		<PanelBody title={__('Lists Details', 'EightshiftBoilerplate')}>
			<ListsOptionsComponent
				{...attributes}
				setAttributes={setAttributes}
			/>
		</PanelBody>
	);
};
