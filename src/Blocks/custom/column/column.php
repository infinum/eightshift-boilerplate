<?php

/**
 * Template for the Column Block.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$blockClass = $attributes['blockClass'] ?? '';

$width = [
	'large' => Components::checkAttr('widthLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('widthDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('widthTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('widthMobile', $attributes, $manifest),
];

$offset = [
	'large' => Components::checkAttr('offsetLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('offsetDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('offsetTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('offsetMobile', $attributes, $manifest),
];

$hide = [
	'large' => Components::checkAttr('hideLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('hideDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('hideTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('hideMobile', $attributes, $manifest),
];

$order = [
	'large' => Components::checkAttr('orderLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('orderDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('orderTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('orderMobile', $attributes, $manifest),
];

$componentClass = Components::classnames([
	$blockClass,
	Components::responsiveSelectors($width, 'width', $blockClass),
	Components::responsiveSelectors($offset, 'offset', $blockClass),
	Components::responsiveSelectors($hide, 'hide', $blockClass, false),
	Components::responsiveSelectors($order, 'order', $blockClass, false),
]);
?>

<div class="<?php echo \esc_attr($componentClass); ?>">
	<?php echo \wp_kses_post($innerBlockContent); ?>
</div>
