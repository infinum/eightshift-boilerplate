<?php

/**
 * Template for the Lists Component.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$listsUse = Components::checkAttr('listsUse', $attributes, $manifest);
if (!$listsUse) {
	return;
}

$componentClass = $attributes['componentClass'] ?? $manifest['componentClass'];
$selectorClass = $attributes['selectorClass'] ?? $componentClass;
$blockClass = $attributes['blockClass'] ?? '';

$listsContent = Components::checkAttr('listsContent', $attributes, $manifest);
$listsOrdered = Components::checkAttr('listsOrdered', $attributes, $manifest);

$listsClass = Components::classnames([
	$componentClass,
	Components::selector($componentClass, 'color', 'listsColor', $attributes, $manifest),
	Components::selector($componentClass, 'size', 'listsSize', $attributes, $manifest),
	Components::selector($componentClass, 'align', 'listsAlign', $attributes, $manifest),
	Components::selectorBlock($blockClass, $selectorClass),
]);

?>

<<?php echo esc_attr($listsOrdered); ?> class="<?php echo esc_attr($listsClass); ?>">
	<?php echo wp_kses_post($listsContent); ?>
</<?php echo esc_attr($listsOrdered); ?>>
