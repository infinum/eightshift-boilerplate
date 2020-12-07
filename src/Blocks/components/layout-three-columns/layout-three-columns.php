<?php

/**
 * Layout component - Three Columns grid.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$layoutUse = Components::checkAttr('layoutUse', $attributes, $manifest);
if (!$layoutUse) {
	return;
}

$componentClass = $attributes['componentClass'] ?? $manifest['componentClass'];
$selectorClass = $attributes['selectorClass'] ?? $componentClass;
$blockClass = $attributes['blockClass'] ?? '';

$layoutLeft = Components::checkAttr('layoutLeft', $attributes, $manifest);
$layoutCenter = Components::checkAttr('layoutCenter', $attributes, $manifest);
$layoutRight = Components::checkAttr('layoutRight', $attributes, $manifest);
$tag = Components::checkAttr('tag', $attributes, $manifest);

$layoutClass = Components::classnames([
	$componentClass,
	Components::selectorBlock($selectorClass),
	Components::selectorBlock($blockClass, $selectorClass),
]);

$wrapClass = Components::classnames([
	Components::selectorBlock($componentClass, 'wrap'),
	Components::selectorBlock($selectorClass, 'wrap'),
]);

$columnLeftClass = Components::classnames([
	Components::selectorBlock($componentClass, 'column'),
	Components::selectorBlock($selectorClass, 'column'),
	Components::selectorBlock($selectorClass, 'column', 'left'),
]);

$columnCenterClass = Components::classnames([
	Components::selectorBlock($componentClass, 'column'),
	Components::selectorBlock($selectorClass, 'column'),
	Components::selectorBlock($selectorClass, 'column', 'center'),
]);

$columnRightClass = Components::classnames([
	Components::selectorBlock($componentClass, 'column'),
	Components::selectorBlock($selectorClass, 'column'),
	Components::selectorBlock($selectorClass, 'column', 'right'),
]);

?>

<<?php echo esc_attr($tag); ?> class="<?php echo \esc_attr($layoutClass); ?>">
	<div class="<?php echo \esc_attr($wrapClass); ?>">

		<?php if ($layoutLeft) { ?>
			<div class="<?php echo \esc_attr($columnLeftClass); ?>">
				<?php echo wp_kses_post(Components::ensureString($layoutLeft)); ?>
			</div>
		<?php } ?>

		<?php if ($layoutCenter) { ?>
			<div class="<?php echo \esc_attr($columnCenterClass); ?>">
				<?php echo wp_kses_post(Components::ensureString($layoutCenter)); ?>
			</div>
		<?php } ?>

		<?php if ($layoutRight) { ?>
			<div class="<?php echo \esc_attr($columnRightClass); ?>">
				<?php echo wp_kses_post(Components::ensureString($layoutRight)); ?>
			</div>
		<?php } ?>

	</div>
</<?php echo esc_attr($tag); ?>>
