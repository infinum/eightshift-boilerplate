import React from 'react'; // eslint-disable-line no-unused-vars
import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import { ToolbarGroup } from '@wordpress/components';
import { AlignmentToolbar } from '@wordpress/block-editor';
import { trash } from '@wordpress/icons';
import { checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

const { options } = manifest;

export const ImageToolbar = (attributes) => {
	const {
		setAttributes,
		imageShowControls = true,

		imageUse = checkAttr('imageUse', attributes, manifest),

		imageUrl = checkAttr('imageUrl', attributes, manifest),
		imageAlign = checkAttr('imageAlign', attributes, manifest),

		showImageAlign = true,
	} = attributes;

	if (!imageShowControls) {
		return null;
	}

	const removeMedia = () => {
		setAttributes({ imageUrl: '' });
	};

	return (
		<Fragment>
			{imageUse &&
				<Fragment>
					{(imageUrl !== '') &&
						<ToolbarGroup
							controls={[
								{
									icon: trash,
									title: __('Remove image', 'EightshiftBoilerplate'),
									isActive: false,
									onClick: removeMedia,
								},
							]}
						/>
					}

					{showImageAlign &&
						<AlignmentToolbar
							value={imageAlign}
							options={options.aligns}
							onChange={(value) => setAttributes({ imageAlign: value })}
						/>
					}
				</Fragment>
			}
		</Fragment>
	);
};
