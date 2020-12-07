<?php

/**
 * Template for the Paragraph Component.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$paragraphUse = Components::checkAttr('paragraphUse', $attributes, $manifest);
if (!$paragraphUse) {
	return;
}

$componentClass = $attributes['componentClass'] ?? $manifest['componentClass'];
$selectorClass = $attributes['selectorClass'] ?? $componentClass;
$blockClass = $attributes['blockClass'] ?? '';

$paragraphContent = Components::checkAttr('paragraphContent', $attributes, $manifest);

$paragraphClass = Components::classnames([
	$componentClass,
	Components::selector($componentClass, 'color', 'paragraphColor', $attributes, $manifest),
	Components::selector($componentClass, 'size', 'paragraphSize', $attributes, $manifest),
	Components::selector($componentClass, 'align', 'paragraphAlign', $attributes, $manifest),
	Components::selectorBlock($blockClass, $selectorClass),
]);

?>

<p class="<?php echo \esc_attr($paragraphClass); ?>">
	<?php echo \wp_kses_post($paragraphContent); ?>
</p>
