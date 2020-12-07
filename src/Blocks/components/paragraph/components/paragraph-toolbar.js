import React from 'react'; // eslint-disable-line no-unused-vars
import { AlignmentToolbar } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

const { options } = manifest;

export const ParagraphToolbar = (attributes) => {
	const {
		setAttributes,
		paragraphShowControls = true,

		paragraphUse = checkAttr('paragraphUse', attributes, manifest),

		paragraphAlign = checkAttr('paragraphAlign', attributes, manifest),

		showParagraphAlign = true,
	} = attributes;

	if (!paragraphShowControls) {
		return null;
	}

	return (
		<Fragment>
			{paragraphUse &&
				<Fragment>
					{showParagraphAlign &&
						<AlignmentToolbar
							value={paragraphAlign}
							options={options.aligns}
							onChange={(value) => setAttributes({ paragraphAlign: value })}
						/>
					}
				</Fragment>
			}
		</Fragment>
	);
};
