import React from 'react'; // eslint-disable-line no-unused-vars
import { PanelBody } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { ImageOptions as ImageOptionsComponent } from '../../../components/image/components/image-options';

export const ImageOptions = ({ attributes, setAttributes }) => {
	return (
		<PanelBody title={__('Image Details', 'EightshiftBoilerplate')}>
			<ImageOptionsComponent
				{...attributes}
				setAttributes={setAttributes}
			/>
		</PanelBody>
	);
};
