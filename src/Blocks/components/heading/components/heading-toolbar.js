import React from 'react'; // eslint-disable-line no-unused-vars
import { AlignmentToolbar } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { HeadingLevel } from '@eightshift/frontend-libs/scripts/components';
import { checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

const { options } = manifest;

export const HeadingToolbar = (attributes) => {
	const {
		setAttributes,
		headingShowControls = true,

		headingUse = checkAttr('headingUse', attributes, manifest),

		headingAlign = checkAttr('headingAlign', attributes, manifest),
		headingLevel = checkAttr('headingLevel', attributes, manifest),

		showHeadingAlign = true,
		showHeadingLevel = true,
	} = attributes;

	if (!headingShowControls) {
		return null;
	}

	return (
		<Fragment>
			{headingUse &&
				<Fragment>
					{showHeadingLevel &&
						<HeadingLevel
							selectedLevel={headingLevel}
							onChange={(value) => setAttributes({ headingLevel: value })}
						/>
					}

					{showHeadingAlign &&
						<AlignmentToolbar
							value={headingAlign}
							options={options.aligns}
							onChange={(value) => setAttributes({ headingAlign: value })}
						/>
					}
				</Fragment>
			}
		</Fragment>
	);
};
