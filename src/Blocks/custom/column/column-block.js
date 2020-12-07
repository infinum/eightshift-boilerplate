/* eslint-disable no-unused-vars, import/no-extraneous-dependencies */
import React from 'react';
import { Fragment } from '@wordpress/element';
import { useSelect } from '@wordpress/data';
import { overrideInnerBlockSimpleWrapperAttributes } from '@eightshift/frontend-libs/scripts/editor';
import { InspectorControls } from '@wordpress/block-editor';
import { ColumnEditor } from './components/column-editor';
import { ColumnOptions } from './components/column-options';

export const Column = (props) => {
	const {
		clientId,
	} = props;

	// Set this attributes to all inner blocks once inserted in DOM.
	useSelect((select) => {
		overrideInnerBlockSimpleWrapperAttributes(select, clientId);
	});

	return (
		<Fragment>
			<InspectorControls>
				<ColumnOptions {...props} />
			</InspectorControls>
			<ColumnEditor {...props} />
		</Fragment>
	);
};
