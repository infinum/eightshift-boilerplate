<?php

/**
 * Template for the Wrapping Advance block.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

// Used to add or remove wrapper.
$wrapperUse = Components::checkAttr('wrapperUse', $attributes, $manifest);
$wrapperUseSimple = Components::checkAttr('wrapperUseSimple', $attributes, $manifest);
$wrapperDisable = Components::checkAttr('wrapperDisable', $attributes, $manifest);

if (! $wrapperUse || $wrapperDisable) {
	$this->renderWrapperView(
		$templatePath,
		$attributes,
		$innerBlockContent
	);

	return;
}

$wrapperId = Components::checkAttr('wrapperId', $attributes, $manifest);
$wrapperAnchorId = Components::checkAttr('wrapperAnchorId', $attributes, $manifest);

$wrapperHide = [
	'large' => Components::checkAttr('wrapperHideLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('wrapperHideDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('wrapperHideTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('wrapperHideMobile', $attributes, $manifest),
];

$wrapperSpacingTop = [
	'large' => Components::checkAttr('wrapperSpacingTopLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('wrapperSpacingTopDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('wrapperSpacingTopTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('wrapperSpacingTopMobile', $attributes, $manifest),
];

$wrapperSpacingBottom = [
	'large' => Components::checkAttr('wrapperSpacingBottomLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('wrapperSpacingBottomDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('wrapperSpacingBottomTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('wrapperSpacingBottomMobile', $attributes, $manifest),
];

$wrapperSpacingTopIn = [
	'large' => Components::checkAttr('wrapperSpacingTopInLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('wrapperSpacingTopInDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('wrapperSpacingTopInTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('wrapperSpacingTopInMobile', $attributes, $manifest),
];

$wrapperSpacingBottomIn = [
	'large' => Components::checkAttr('wrapperSpacingBottomInLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('wrapperSpacingBottomInDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('wrapperSpacingBottomInTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('wrapperSpacingBottomInMobile', $attributes, $manifest),
];

$wrapperDividerTop = [
	'large' => Components::checkAttr('wrapperDividerTopLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('wrapperDividerTopDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('wrapperDividerTopTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('wrapperDividerTopMobile', $attributes, $manifest),
];

$wrapperDividerBottom = [
	'large' => Components::checkAttr('wrapperDividerBottomLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('wrapperDividerBottomDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('wrapperDividerBottomTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('wrapperDividerBottomMobile', $attributes, $manifest),
];

$wrapperContainerWidth = [
	'large' => Components::checkAttr('wrapperContainerWidthLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('wrapperContainerWidthDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('wrapperContainerWidthTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('wrapperContainerWidthMobile', $attributes, $manifest),
];

$wrapperGutter = [
	'large' => Components::checkAttr('wrapperGutterLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('wrapperGutterDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('wrapperGutterTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('wrapperGutterMobile', $attributes, $manifest),
];

$wrapperWidth = [
	'large' => Components::checkAttr('wrapperWidthLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('wrapperWidthDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('wrapperWidthTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('wrapperWidthMobile', $attributes, $manifest),
];

$wrapperOffset = [
	'large' => Components::checkAttr('wrapperOffsetLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('wrapperOffsetDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('wrapperOffsetTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('wrapperOffsetMobile', $attributes, $manifest),
];

$wrapperMainClass = 'wrapper';

$wrapperClass = Components::classnames([
	$wrapperMainClass,
	Components::selector($wrapperMainClass, 'bg-color', 'wrapperBackgroundColor', $attributes, $manifest),
	Components::responsiveSelectors($wrapperSpacingTop, 'spacing-top', $wrapperMainClass),
	Components::responsiveSelectors($wrapperSpacingBottom, 'spacing-bottom', $wrapperMainClass),
	Components::responsiveSelectors($wrapperSpacingTopIn, 'spacing-top-in', $wrapperMainClass),
	Components::responsiveSelectors($wrapperSpacingBottomIn, 'spacing-bottom-in', $wrapperMainClass),
	Components::responsiveSelectors($wrapperDividerTop, 'divider-top', $wrapperMainClass, false),
	Components::responsiveSelectors($wrapperDividerBottom, 'divider-bottom', $wrapperMainClass, false),
	Components::responsiveSelectors($wrapperHide, 'hide', $wrapperMainClass, false),
]);

$wrapperContainerClass = Components::classnames([
	"{$wrapperMainClass}__container",
	Components::responsiveSelectors($wrapperContainerWidth, 'container-width', $wrapperMainClass),
	Components::responsiveSelectors($wrapperGutter, 'gutter', $wrapperMainClass),
]);

$wrapperInnerClass = Components::classnames([
	"{$wrapperMainClass}__inner",
	Components::responsiveSelectors($wrapperWidth, 'width', $wrapperMainClass),
	Components::responsiveSelectors($wrapperOffset, 'offset', $wrapperMainClass),
]);

?>
<div class="<?php echo \esc_attr($wrapperClass); ?>" <?php echo \esc_attr(($wrapperId) ? 'id=" ' . $wrapperId . '"' : ''); ?>>

	<?php if ($wrapperAnchorId) { ?>
		<div class="<?php echo \esc_attr("{$wrapperMainClass}__anchor"); ?>" id="<?php echo \esc_attr($wrapperAnchorId); ?>"></div>
	<?php } ?>

	<?php if ($wrapperUseSimple) { ?>
		<?php
		$this->renderWrapperView(
			$templatePath,
			$attributes,
			$innerBlockContent
		);
		?>
	<?php } else { ?>
		<div class="<?php echo \esc_attr($wrapperContainerClass); ?>">
			<div class="<?php echo \esc_attr($wrapperInnerClass); ?>">
				<?php
				$this->renderWrapperView(
					$templatePath,
					$attributes,
					$innerBlockContent
				);
				?>
			</div>
		</div>
	<?php } ?>
</div>
