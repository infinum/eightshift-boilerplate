/* eslint-disable no-unused-vars */

import React from 'react';
import { Fragment } from '@wordpress/element';
import { InspectorControls } from '@wordpress/block-editor';
import { WrapperEditor } from './components/wrapper-editor';
import { WrapperOptions } from './components/wrapper-options';

export const Wrapper = (props) => {
	const {
		props: {
			setAttributes,
			attributes,
		},
		children,
	} = props;

	return (
		<Fragment>
			<InspectorControls>
				<WrapperOptions
					attributes={attributes}
					setAttributes={setAttributes}
				/>
			</InspectorControls>

			<WrapperEditor
				attributes={attributes}
				children={children}
			/>
		</Fragment>
	);
};
