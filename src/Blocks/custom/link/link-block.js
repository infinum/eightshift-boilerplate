import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import { InspectorControls, BlockControls } from '@wordpress/block-editor';
import { LinkEditor } from './components/link-editor';
import { LinkToolbar } from './components/link-toolbar';
import { LinkOptions } from './components/link-options';

export const Link = (props) => {
	return (
		<Fragment>
			<InspectorControls>
				<LinkOptions {...props} />
			</InspectorControls>
			<BlockControls>
				<LinkToolbar {...props} />
			</BlockControls>
			<LinkEditor {...props} />
		</Fragment>
	);
};
