import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';
import { ToggleControl } from '@wordpress/components';
import { MediaPlaceholder, URLInput } from '@wordpress/block-editor';
import { checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

const { title } = manifest;

export const ImageOptions = (attributes) => {
	const {
		setAttributes,
		label = title,
		imageShowControls = true,

		imageUse = checkAttr('imageUse', attributes, manifest),

		imageUrl = checkAttr('imageUrl', attributes, manifest),
		imageLink = checkAttr('imageLink', attributes, manifest),
		imageAccept = checkAttr('imageAccept', attributes, manifest),
		imageAllowedTypes = checkAttr('imageAllowedTypes', attributes, manifest),
		imageBg = checkAttr('imageBg', attributes, manifest),
		imageUsePlaceholder = checkAttr('imageUsePlaceholder', attributes, manifest),

		showImageUrl = true,
		showImageLink = true,
		showImageBg = true,
	} = attributes;

	if (!imageShowControls) {
		return null;
	}

	return (
		<Fragment>

			{label &&
				<h3 className={'options-label'}>
					{label}
				</h3>
			}

			<ToggleControl
				label={sprintf(__('Use %s', 'EightshiftBoilerplate'), label)}
				checked={imageUse}
				onChange={(value) => setAttributes({ imageUse: value })}
			/>

			{imageUse &&
				<Fragment>
					{(showImageUrl && imageUsePlaceholder && imageUrl === '') &&
						<MediaPlaceholder
							icon="format-image"
							onSelect={(value) => {
								setAttributes({ imageUrl: value.url });
							}}
							accept={imageAccept}
							allowedTypes={imageAllowedTypes}
						/>
					}

					<br />

					{showImageBg &&
						<ToggleControl
							label={__('Use as Background Image', 'EightshiftBoilerplate')}
							checked={imageBg}
							onChange={(value) => setAttributes({ imageBg: value })}
						/>
					}

					{showImageLink &&
						<URLInput
							label={__('Url', 'EightshiftBoilerplate')}
							value={imageLink}
							autoFocus={false}
							onChange={(value) => setAttributes({ imageLink: value })}
						/>
					}

				</Fragment>
			}

		</Fragment>
	);
};
