<?php

/**
 * Template for the Card Component.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$componentClass = $attributes['componentClass'] ?? $manifest['componentClass'];
$selectorClass = $attributes['selectorClass'] ?? $componentClass;
$blockClass = $attributes['blockClass'] ?? '';

$cardClass = Components::classnames([
	$componentClass,
	Components::selectorBlock($blockClass, "{$selectorClass}"),
]);
?>

<div class="<?php echo \esc_attr($cardClass); ?>">
	<?php
	echo \wp_kses_post(Components::render('image', $attributes));
	echo \wp_kses_post(Components::render('heading', $attributes));
	echo \wp_kses_post(Components::render('paragraph', $attributes));
	echo \wp_kses_post(Components::render('button', $attributes));
	?>
</div>
