import React from 'react'; // eslint-disable-line no-unused-vars
import { InnerBlocks } from '@wordpress/block-editor';

export const GroupEditor = ({ attributes }) => {
	const {
		blockClass,
	} = attributes;

	return (
		<div className={blockClass}>
			<InnerBlocks />
		</div>
	);
};
