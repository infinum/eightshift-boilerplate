<?php

/**
 * Template for the Heading Component.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$headingUse = Components::checkAttr('headingUse', $attributes, $manifest);
if (!$headingUse) {
	return;
}

$componentClass = $attributes['componentClass'] ?? $manifest['componentClass'];
$selectorClass = $attributes['selectorClass'] ?? $componentClass;
$blockClass = $attributes['blockClass'] ?? '';

$headingContent = Components::checkAttr('headingContent', $attributes, $manifest);
$headingLevel = Components::checkAttr('headingLevel', $attributes, $manifest);

$headingClass = Components::classnames([
	$componentClass,
	Components::selector($componentClass, 'color', 'headingColor', $attributes, $manifest),
	Components::selector($componentClass, 'size', 'headingSize', $attributes, $manifest),
	Components::selector($componentClass, 'align', 'headingAlign', $attributes, $manifest),
	Components::selectorBlock($blockClass, $selectorClass),
]);

$headingLevel = $headingLevel ? "h{$headingLevel}" : 'h2';

?>

<<?php echo esc_attr($headingLevel); ?> class="<?php echo esc_attr($headingClass); ?>">
	<?php echo wp_kses_post($headingContent); ?>
</<?php echo esc_attr($headingLevel); ?>>
