import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import { BlockControls, InspectorControls } from '@wordpress/block-editor';
import { ImageEditor } from './components/image-editor';
import { ImageOptions } from './components/image-options';
import { ImageToolbar } from './components/image-toolbar';

export const Image = (props) => {
	return (
		<Fragment>
			<InspectorControls>
				<ImageOptions {...props} />
			</InspectorControls>
			<BlockControls>
				<ImageToolbar {...props} />
			</BlockControls>
			<ImageEditor {...props} />
		</Fragment>
	);
};
