<?php

/**
 * Template for the Columns Block.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$blockClass = $attributes['blockClass'] ?? '';

$gutter = [
	'large' => Components::checkAttr('gutterLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('gutterDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('gutterTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('gutterMobile', $attributes, $manifest),
];

$verticalSpacing = [
	'large' => Components::checkAttr('verticalSpacingLarge', $attributes, $manifest),
	'desktop' => Components::checkAttr('verticalSpacingDesktop', $attributes, $manifest),
	'tablet' => Components::checkAttr('verticalSpacingTablet', $attributes, $manifest),
	'mobile' => Components::checkAttr('verticalSpacingMobile', $attributes, $manifest),
];

$componentClass = Components::classnames([
	$blockClass,
	Components::responsiveSelectors($gutter, 'gutter', $blockClass),
	Components::responsiveSelectors($verticalSpacing, 'verticalSpacing', $blockClass),
]);
?>

<div class="<?php echo \esc_attr($componentClass); ?>">
	<?php echo \wp_kses_post($innerBlockContent); ?>
</div>
