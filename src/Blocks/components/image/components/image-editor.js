import React from 'react'; // eslint-disable-line no-unused-vars
import { __ } from '@wordpress/i18n';
import classnames from 'classnames';
import { Fragment } from '@wordpress/element';
import { Placeholder } from '@wordpress/components';
import { image } from '@wordpress/icons';
import { MediaPlaceholder } from '@wordpress/block-editor';
import { selector, selectorBlock, selectorCustom, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const ImageEditor = (attributes) => {
	const {
		setAttributes,
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,

		imageUse = checkAttr('imageUse', attributes, manifest),

		imageUrl = checkAttr('imageUrl', attributes, manifest),
		imageAccept = checkAttr('imageAccept', attributes, manifest),
		imageAllowedTypes = checkAttr('imageAllowedTypes', attributes, manifest),
		imageBg = checkAttr('imageBg', attributes, manifest),
		imageUsePlaceholder = checkAttr('imageBg', attributes, manifest),
	} = attributes;

	const imageWrapClass = classnames([
		selectorBlock(componentClass, 'wrap'),
		selector(componentClass, 'align', 'imageAlign', attributes, manifest),
		selectorBlock(blockClass, `${selectorClass}-wrap`),
	]);

	const imageClass = classnames([
		componentClass,
		selectorCustom(imageBg, componentClass, '', 'bg'),
		selectorBlock(blockClass, selectorClass),
	]);

	return (
		<Fragment>
			{imageUse &&
				<Fragment>
					<div className={imageWrapClass}>
						{(imageUrl !== '') &&
							<Fragment>
								{imageBg ?
									<div className={imageClass} style={{ backgroundImage: `url(${imageUrl})` }} /> :
									<img className={imageClass} src={imageUrl} alt="" />
								}
							</Fragment>
						}

						{(imageUrl === '') &&
							<Fragment>
								{(!imageUsePlaceholder) ?
									<MediaPlaceholder
										icon="format-image"
										onSelect={(value) => setAttributes({ imageUrl: value.url })}
										accept={imageAccept}
										allowedTypes={imageAllowedTypes}
									/> :
									<Placeholder icon={image} label={__('Please add image using sidebar options!', 'EightshiftBoilerplate')} />
								}
							</Fragment>
						}
					</div>
				</Fragment>
			}
		</Fragment>
	);
};

