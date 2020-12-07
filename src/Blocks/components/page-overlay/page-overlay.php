<?php

/**
 * Template for the Page Overlay Component.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$pageOverlayUse = Components::checkAttr('pageOverlayUse', $attributes, $manifest);
if (!$pageOverlayUse) {
	return;
}

$componentClass = $attributes['componentClass'] ?? $manifest['componentClass'];
$selectorClass = $attributes['selectorClass'] ?? $componentClass;
$blockClass = $attributes['blockClass'] ?? '';

$overlayClass = Components::classnames([
	$componentClass,
	Components::selectorCustom($blockClass, "js-{$blockClass}"),
	$blockClass ? "{$blockClass}__{$componentClass}" : '',
]);

?>

<div class="<?php echo esc_attr($overlayClass); ?>"></div>
