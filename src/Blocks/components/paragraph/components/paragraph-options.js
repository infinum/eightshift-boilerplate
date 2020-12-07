import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';
import { ColorPaletteCustom } from '@eightshift/frontend-libs/scripts/components';
import { SelectControl, Icon, ToggleControl } from '@wordpress/components';
import { checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import { icons } from '@eightshift/frontend-libs/scripts/editor';

import manifest from './../manifest.json';

const { options, title } = manifest;

export const ParagraphOptions = (attributes) => {
	const {
		setAttributes,
		label = title,
		paragraphShowControls = true,

		paragraphUse = checkAttr('paragraphUse', attributes, manifest),

		paragraphColor = checkAttr('paragraphColor', attributes, manifest),
		paragraphSize = checkAttr('paragraphSize', attributes, manifest),

		showParagraphColor = true,
		showParagraphSize = true,
	} = attributes;

	if (!paragraphShowControls) {
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
				checked={paragraphUse}
				onChange={(value) => setAttributes({ paragraphUse: value })}
			/>

			{paragraphUse &&
				<Fragment>
					{showParagraphColor &&
						<ColorPaletteCustom
							label={
								<Fragment>
									<Icon icon={icons.color} />
									{__('Color', 'EightshiftBoilerplate')}
								</Fragment>
							}
							value={paragraphColor}
							onChange={(value) => setAttributes({ paragraphColor: value })}
						/>
					}

					{showParagraphSize &&
						<SelectControl
							label={__('Size', 'EightshiftBoilerplate')}
							value={paragraphSize}
							options={options.sizes}
							onChange={(value) => setAttributes({ paragraphSize: value })}
						/>
					}
				</Fragment>
			}

		</Fragment>
	);
};
