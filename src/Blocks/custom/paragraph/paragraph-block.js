import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import { InspectorControls, BlockControls } from '@wordpress/block-editor';
import { ParagraphEditor } from './components/paragraph-editor';
import { ParagraphToolbar } from './components/paragraph-toolbar';
import { ParagraphOptions } from './components/paragraph-options';

export const Paragraph = (props) => {
	return (
		<Fragment>
			<InspectorControls>
				<ParagraphOptions {...props} />
			</InspectorControls>
			<BlockControls>
				<ParagraphToolbar {...props} />
			</BlockControls>
			<ParagraphEditor {...props} />
		</Fragment>
	);
};
