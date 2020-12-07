import React from 'react'; // eslint-disable-line no-unused-vars
import { __ } from '@wordpress/i18n';
import { PanelBody } from '@wordpress/components';
import { ParagraphOptions as ParagraphOptionsComponent } from '../../../components/paragraph/components/paragraph-options';

export const ParagraphOptions = ({ attributes, setAttributes }) => {
	return (
		<PanelBody title={__('Paragraph Details', 'EightshiftBoilerplate')}>

			<ParagraphOptionsComponent
				{...attributes}
				setAttributes={setAttributes}
			/>

		</PanelBody>
	);
};
