/* eslint-disable no-unused-vars, import/no-extraneous-dependencies */

import React from 'react';
import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import { PanelBody, Icon, RangeControl, ToggleControl } from '@wordpress/components';
import { icons, ucfirst } from '@eightshift/frontend-libs/scripts/editor';
import { Responsive, HelpModal } from '@eightshift/frontend-libs/scripts/components';
import manifest from './../manifest.json';

const { attributes: reset, options } = manifest;

export const ColumnOptions = ({ attributes, setAttributes }) => {
	const width = [
		attributes.widthLarge,
		attributes.widthDesktop,
		attributes.widthTablet,
		attributes.widthMobile,
	];

	const offset = [
		attributes.offsetLarge,
		attributes.offsetDesktop,
		attributes.offsetTablet,
		attributes.offsetMobile,
	];

	const order = [
		attributes.orderLarge,
		attributes.orderDesktop,
		attributes.orderTablet,
		attributes.orderMobile,
	];

	const hide = [
		attributes.hideLarge,
		attributes.hideDesktop,
		attributes.hideTablet,
		attributes.hideMobile,
	];

	return (
		<PanelBody title={__('Column Details', 'EightshiftBoilerplate')}>

			<HelpModal type="column" />

			<br /><br />

			<Responsive
				label={
					<Fragment>
						<Icon icon={icons.width} />
						{__('Width', 'EightshiftBoilerplate')}
					</Fragment>
				}
			>
				{width.map((item, index) => {

					const point = ucfirst(options.breakpoints[index]);
					const attr = `width${point}`;

					return (
						<Fragment key={index}>
							<RangeControl
								label={point}
								allowReset={true}
								value={attributes[attr]}
								onChange={(value) => setAttributes({ [attr]: value })}
								min={options.widths.min}
								max={options.widths.max}
								step={options.widths.step}
								resetFallbackValue={reset[attr].default}
							/>
						</Fragment>
					);
				})}
			</Responsive>

			<Responsive
				label={
					<Fragment>
						<Icon icon={icons.offset} />
						{__('Offset', 'EightshiftBoilerplate')}
					</Fragment>
				}
			>
				{offset.map((item, index) => {

					const point = ucfirst(options.breakpoints[index]);
					const attr = `offset${point}`;

					return (
						<Fragment key={index}>
							<RangeControl
								label={point}
								allowReset={true}
								value={attributes[attr]}
								onChange={(value) => setAttributes({ [attr]: value })}
								min={options.widths.min}
								max={options.widths.max}
								step={options.widths.step}
								resetFallbackValue={reset[attr].default}
							/>
						</Fragment>
					);
				})}
			</Responsive>

			<Responsive
				label={
					<Fragment>
						<Icon icon={icons.width} />
						{__('Order', 'EightshiftBoilerplate')}
					</Fragment>
				}
			>
				{order.map((item, index) => {

					const point = ucfirst(options.breakpoints[index]);
					const attr = `order${point}`;

					return (
						<Fragment key={index}>
							<RangeControl
								label={point}
								allowReset={true}
								value={attributes[attr]}
								onChange={(value) => setAttributes({ [attr]: value })}
								min={options.orders.min}
								max={options.orders.max}
								step={options.orders.step}
								resetFallbackValue={reset[attr].default}
							/>
						</Fragment>
					);
				})}
			</Responsive>

			<Responsive
				label={
					<Fragment>
						<Icon icon={icons.width} />
						{__('Hide', 'EightshiftBoilerplate')}
					</Fragment>
				}
			>
				{hide.map((item, index) => {

					const point = ucfirst(options.breakpoints[index]);
					const attr = `hide${point}`;

					return (
						<Fragment key={index}>
							<ToggleControl
								label={point}
								checked={attributes[attr]}
								onChange={(value) => setAttributes({ [attr]: value })}
							/>
						</Fragment>
					);
				})}
			</Responsive>
		</PanelBody>
	);
};
