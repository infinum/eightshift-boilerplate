import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';
import { ColorPaletteCustom } from '@eightshift/frontend-libs/scripts/components';
import { SelectControl, Icon, ToggleControl } from '@wordpress/components';
import { icons } from '@eightshift/frontend-libs/scripts/editor';
import { checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from '../manifest.json';

const { options, title } = manifest;

export const ListsOptions = (attributes) => {
	const {
		setAttributes,
		label = title,
		listsShowControls = true,

		listsUse = checkAttr('listsUse', attributes, manifest),

		listsColor = checkAttr('listsColor', attributes, manifest),
		listsSize = checkAttr('listsSize', attributes, manifest),

		showListsColor = true,
		showListsSize = true,
	} = attributes;

	if (!listsShowControls) {
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
				checked={listsUse}
				onChange={(value) => setAttributes({ listsUse: value })}
			/>

			{listsUse &&
				<Fragment>
					{showListsColor &&
						<ColorPaletteCustom
							label={
								<Fragment>
									<Icon icon={icons.color} />
									{__('Color', 'EightshiftBoilerplate')}
								</Fragment>
							}
							value={listsColor}
							onChange={(value) => setAttributes({ listsColor: value })}
						/>
					}

					{showListsSize &&
						<SelectControl
							label={__('Size', 'EightshiftBoilerplate')}
							value={listsSize}
							options={options.sizes}
							onChange={(value) => setAttributes({ listsSize: value })}
						/>
					}
				</Fragment>
			}

		</Fragment>
	);
};
