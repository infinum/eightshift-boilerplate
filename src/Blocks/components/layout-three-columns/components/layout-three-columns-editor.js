import React from 'react'; // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element';
import classnames from 'classnames';
import { selectorBlock, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from '../manifest.json';

export const LayoutThreeColumnsEditor = (attributes) => {
	const {
		componentClass = manifest.componentClass,
		selectorClass = componentClass,
		blockClass,

		layoutUse = checkAttr('layoutUse', attributes, manifest),

		layoutLeft = checkAttr('layoutLeft', attributes, manifest),
		layoutCenter = checkAttr('layoutCenter', attributes, manifest),
		layoutRight = checkAttr('layoutRight', attributes, manifest),
	} = attributes;

	const layoutClass = classnames([
		componentClass,
		selectorBlock(blockClass, selectorClass),
	]);

	const wrapClass = classnames([
		selectorBlock(componentClass, 'wrap'),
		selectorBlock(selectorClass, 'wrap'),
	]);

	const columnLeftClass = classnames([
		selectorBlock(componentClass, 'column'),
		selectorBlock(componentClass, 'column'),
		selectorBlock(selectorClass, 'column', 'left'),
		selectorBlock(selectorClass, 'column', 'left'),
	]);

	const columnCenterClass = classnames([
		selectorBlock(componentClass, 'column'),
		selectorBlock(componentClass, 'column'),
		selectorBlock(selectorClass, 'column', 'center'),
		selectorBlock(selectorClass, 'column', 'center'),
	]);

	const columnRightClass = classnames([
		selectorBlock(componentClass, 'column'),
		selectorBlock(componentClass, 'column'),
		selectorBlock(selectorClass, 'column', 'right'),
		selectorBlock(selectorClass, 'column', 'right'),
	]);

	return (
		<Fragment>
			{layoutUse &&
				<div className={layoutClass}>
					<div className={wrapClass}>
						{layoutLeft &&
							<div className={columnLeftClass}>
								{layoutLeft}
							</div>
						}

						{layoutCenter &&
							<div className={columnCenterClass}>
								{layoutCenter}
							</div>
						}

						{layoutRight &&
							<div className={columnRightClass}>
								{layoutRight}
							</div>
						}
					</div>
				</div>
			}
		</Fragment>
	);
};
