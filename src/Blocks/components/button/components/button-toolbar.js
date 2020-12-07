import React from 'react'; // eslint-disable-line no-unused-vars
import { AlignmentToolbar } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

const { options } = manifest;

export const ButtonToolbar = (attributes) => {
	const {
		setAttributes,
		buttonShowControls = true,

		buttonUse = checkAttr('buttonUse', attributes, manifest),
		buttonAlign = checkAttr('buttonAlign', attributes, manifest),

		showButtonAlign = true,
	} = attributes;

	if (!buttonShowControls) {
		return null;
	}

	return (
		<Fragment>
			{buttonUse &&
				<Fragment>
					{showButtonAlign &&
						<AlignmentToolbar
							value={buttonAlign}
							options={options.aligns}
							onChange={(value) => setAttributes({ buttonAlign: value })}
						/>
					}
				</Fragment>
			}
		</Fragment>
	);
};
