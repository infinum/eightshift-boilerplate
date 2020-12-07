<?php

/**
 * Template for the Image Component.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$imageUse = Components::checkAttr('imageUse', $attributes, $manifest);
if (!$imageUse) {
	return;
}

$componentClass = $attributes['componentClass'] ?? $manifest['componentClass'];
$selectorClass = $attributes['selectorClass'] ?? $componentClass;
$blockClass = $attributes['blockClass'] ?? '';

$imageUrl = Components::checkAttr('imageUrl', $attributes, $manifest);
$imageLink = Components::checkAttr('imageLink', $attributes, $manifest);
$imageBg = Components::checkAttr('imageBg', $attributes, $manifest);

$imageWrapClass = Components::classnames([
	Components::selectorBlock($componentClass, 'wrap'),
	Components::selector($componentClass, 'align', 'imageAlign', $attributes, $manifest),
	Components::selectorBlock($blockClass, "{$selectorClass}-wrap"),
	Components::selectorBlock($imageLink, $componentClass, 'is-link'),
]);

$imageClass = Components::classnames([
	$componentClass,
	Components::selectorCustom($imageBg, $componentClass, '', 'bg'),
	Components::selectorBlock($blockClass, $selectorClass),
]);

?>

<?php if ($imageLink) { ?>
	<a href="<?php echo esc_url($imageLink); ?>" class="<?php echo \esc_attr($imageWrapClass); ?>">
<?php } else { ?>
	<div class="<?php echo \esc_attr($imageWrapClass); ?>">
<?php } ?>

	<?php if ($imageBg) { ?>
		<div style="background-image:url(<?php echo \esc_url($imageUrl); ?>)" class="<?php echo \esc_attr($imageClass); ?>" ></div>
	<?php } else { ?>
			<img src="<?php echo \esc_url($imageUrl); ?>" class="<?php echo \esc_attr($imageClass); ?>" />
	<?php } ?>

<?php if ($imageLink) { ?>
	</a>
<?php } else { ?>
	</div>
<?php } ?>
