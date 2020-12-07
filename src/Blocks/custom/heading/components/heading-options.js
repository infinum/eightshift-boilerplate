import React from 'react'; // eslint-disable-line no-unused-vars
import { __ } from '@wordpress/i18n';
import { PanelBody } from '@wordpress/components';
import { HeadingOptions as HeadingOptionsComponent } from '../../../components/heading/components/heading-options';

export const HeadingOptions = ({ attributes, setAttributes }) => {
	return (
		<PanelBody title={__('Heading Details', 'EightshiftBoilerplate')}>

			<HeadingOptionsComponent
				{...attributes}
				setAttributes={setAttributes}
			/>

		</PanelBody>
	);
};
