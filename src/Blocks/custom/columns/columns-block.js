/* eslint-disable no-unused-vars, import/no-extraneous-dependencies */

import React from 'react';
import { Fragment } from '@wordpress/element';
import { InspectorControls } from '@wordpress/block-editor';
import { ColumnsOptions } from './components/columns-options';
import { ColumnsEditor } from './components/columns-editor';

export const Columns = (props) => {
	return (
		<Fragment>
			<InspectorControls>
				<ColumnsOptions {...props} />
			</InspectorControls>
			<ColumnsEditor {...props} />
		</Fragment>
	);
};
