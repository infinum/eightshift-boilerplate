import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import { InspectorControls, BlockControls } from '@wordpress/block-editor';
import { CardEditor } from './components/card-editor';
import { CardToolbar } from './components/card-toolbar';
import { CardOptions } from './components/card-options';

export const Card = (props) => {
	return (
		<Fragment>
			<InspectorControls>
				<CardOptions {...props} />
			</InspectorControls>
			<BlockControls>
				<CardToolbar {...props} />
			</BlockControls>
			<CardEditor {...props} />
		</Fragment>
	);
};
