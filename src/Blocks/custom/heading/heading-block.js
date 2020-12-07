import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import { InspectorControls, BlockControls } from '@wordpress/block-editor';
import { HeadingEditor } from './components/heading-editor';
import { HeadingToolbar } from './components/heading-toolbar';
import { HeadingOptions } from './components/heading-options';

export const Heading = (props) => {
	return (
		<Fragment>
			<InspectorControls>
				<HeadingOptions {...props} />
			</InspectorControls>
			<BlockControls>
				<HeadingToolbar {...props} />
			</BlockControls>
			<HeadingEditor {...props} />
		</Fragment>
	);
};
