<?php

/**
 * Logo component
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$logoUse = Components::checkAttr('logoUse', $attributes, $manifest);
if (!$logoUse) {
	return;
}

$componentClass = $attributes['componentClass'] ?? $manifest['componentClass'];
$selectorClass = $attributes['selectorClass'] ?? $componentClass;
$blockClass = $attributes['blockClass'] ?? '';

$logoSrc = Components::checkAttr('logoSrc', $attributes, $manifest);
$logoAlt = Components::checkAttr('logoAlt', $attributes, $manifest);
$logoTitle = Components::checkAttr('logoTitle', $attributes, $manifest);
$logoHref = Components::checkAttr('logoHref', $attributes, $manifest);

$logoClass = Components::classnames([
	$componentClass,
	Components::selectorBlock($blockClass, $selectorClass),
]);

$imgClass = Components::classnames([
	Components::selectorBlock($componentClass, 'img'),
]);

?>
<a
	class="<?php echo \esc_attr($logoClass); ?>"
	href="<?php echo \esc_url($logoHref); ?>"
>
	<img
	src="<?php echo \esc_url($logoSrc); ?>"
	alt="<?php echo \esc_attr($logoAlt); ?>"
	title="<?php echo \esc_attr($logoTitle); ?>"
	class="<?php echo \esc_attr($imgClass); ?>"
	/>
</a>
