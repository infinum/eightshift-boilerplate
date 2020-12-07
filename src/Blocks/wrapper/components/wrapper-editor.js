import React from 'react'; // eslint-disable-line no-unused-vars
import classnames from 'classnames';
import { responsiveSelectors, selector, checkAttr } from '@eightshift/frontend-libs/scripts/helpers';
import manifest from './../manifest.json';

export const WrapperEditor = ({ attributes, children }) => {
	const {
		wrapperUse = checkAttr('wrapperUse', attributes, manifest),
		wrapperUseSimple = checkAttr('wrapperUseSimple', attributes, manifest),
		wrapperDisable = checkAttr('wrapperDisable', attributes, manifest),
		wrapperId = checkAttr('wrapperId', attributes, manifest),
	} = attributes;

	if (!wrapperUse || wrapperDisable) {
		return children;
	}

	const wrapperSpacingTop = {
		large: checkAttr('wrapperSpacingTopLarge', attributes, manifest),
		desktop: checkAttr('wrapperSpacingTopDesktop', attributes, manifest),
		tablet: checkAttr('wrapperSpacingTopTablet', attributes, manifest),
		mobile: checkAttr('wrapperSpacingTopMobile', attributes, manifest),
	};

	const wrapperSpacingBottom = {
		large: checkAttr('wrapperSpacingBottomLarge', attributes, manifest),
		desktop: checkAttr('wrapperSpacingBottomDesktop', attributes, manifest),
		tablet: checkAttr('wrapperSpacingBottomTablet', attributes, manifest),
		mobile: checkAttr('wrapperSpacingBottomMobile', attributes, manifest),
	};

	const wrapperSpacingTopIn = {
		large: checkAttr('wrapperSpacingTopInLarge', attributes, manifest),
		desktop: checkAttr('wrapperSpacingTopInDesktop', attributes, manifest),
		tablet: checkAttr('wrapperSpacingTopInTablet', attributes, manifest),
		mobile: checkAttr('wrapperSpacingTopInMobile', attributes, manifest),
	};

	const wrapperSpacingBottomIn = {
		large: checkAttr('wrapperSpacingBottomInLarge', attributes, manifest),
		desktop: checkAttr('wrapperSpacingBottomInDesktop', attributes, manifest),
		tablet: checkAttr('wrapperSpacingBottomInTablet', attributes, manifest),
		mobile: checkAttr('wrapperSpacingBottomInMobile', attributes, manifest),
	};

	const wrapperDividerTop = {
		large: checkAttr('wrapperDividerTopLarge', attributes, manifest),
		desktop: checkAttr('wrapperDividerTopDesktop', attributes, manifest),
		tablet: checkAttr('wrapperDividerTopTablet', attributes, manifest),
		mobile: checkAttr('wrapperDividerTopMobile', attributes, manifest),
	};

	const wrapperDividerBottom = {
		large: checkAttr('wrapperDividerBottomLarge', attributes, manifest),
		desktop: checkAttr('wrapperDividerBottomDesktop', attributes, manifest),
		tablet: checkAttr('wrapperDividerBottomTablet', attributes, manifest),
		mobile: checkAttr('wrapperDividerBottomMobile', attributes, manifest),
	};

	const wrapperContainerWidth = {
		large: checkAttr('wrapperContainerWidthLarge', attributes, manifest),
		desktop: checkAttr('wrapperContainerWidthDesktop', attributes, manifest),
		tablet: checkAttr('wrapperContainerWidthTablet', attributes, manifest),
		mobile: checkAttr('wrapperContainerWidthMobile', attributes, manifest),
	};

	const wrapperGutter = {
		large: checkAttr('wrapperGutterLarge', attributes, manifest),
		desktop: checkAttr('wrapperGutterDesktop', attributes, manifest),
		tablet: checkAttr('wrapperGutterTablet', attributes, manifest),
		mobile: checkAttr('wrapperGutterMobile', attributes, manifest),
	};

	const wrapperWidth = {
		large: checkAttr('wrapperWidthLarge', attributes, manifest),
		desktop: checkAttr('wrapperWidthDesktop', attributes, manifest),
		tablet: checkAttr('wrapperWidthTablet', attributes, manifest),
		mobile: checkAttr('wrapperWidthMobile', attributes, manifest),
	};

	const wrapperOffset = {
		large: checkAttr('wrapperOffsetLarge', attributes, manifest),
		desktop: checkAttr('wrapperOffsetDesktop', attributes, manifest),
		tablet: checkAttr('wrapperOffsetTablet', attributes, manifest),
		mobile: checkAttr('wrapperOffsetMobile', attributes, manifest),
	};

	const wrapperHide = {
		large: checkAttr('wrapperHideLarge', attributes, manifest),
		desktop: checkAttr('wrapperHideDesktop', attributes, manifest),
		tablet: checkAttr('wrapperHideTablet', attributes, manifest),
		mobile: checkAttr('wrapperHideMobile', attributes, manifest),
	};

	const wrapperMainClass = 'wrapper';

	const wrapperClass = classnames([
		wrapperMainClass,
		selector(wrapperMainClass, 'bg-color', 'wrapperBackgroundColor', attributes, manifest),
		responsiveSelectors(wrapperSpacingTop, 'spacing-top', wrapperMainClass),
		responsiveSelectors(wrapperSpacingBottom, 'spacing-bottom', wrapperMainClass),
		responsiveSelectors(wrapperSpacingTopIn, 'spacing-top-in', wrapperMainClass),
		responsiveSelectors(wrapperSpacingBottomIn, 'spacing-bottom-in', wrapperMainClass),
		responsiveSelectors(wrapperDividerTop, 'divider-top', wrapperMainClass, false),
		responsiveSelectors(wrapperDividerBottom, 'divider-bottom', wrapperMainClass, false),
		responsiveSelectors(wrapperHide, 'hide-editor', wrapperMainClass, false),
	]);

	const wrapperContainerClass = classnames([
		`${wrapperMainClass}__container`,
		responsiveSelectors(wrapperContainerWidth, 'container-width', wrapperMainClass),
		responsiveSelectors(wrapperGutter, 'gutter', wrapperMainClass),
	]);

	const wrapperInnerClass = classnames([
		`${wrapperMainClass}__inner`,
		responsiveSelectors(wrapperWidth, 'width', wrapperMainClass),
		responsiveSelectors(wrapperOffset, 'offset', wrapperMainClass),
	]);

	return (
		<div className={wrapperClass} id={wrapperId}>
			{wrapperUseSimple ?
				children :
				<div className={wrapperContainerClass}>
					<div className={wrapperInnerClass}>
						{children}
					</div>
				</div>
			}
		</div>
	);
};
