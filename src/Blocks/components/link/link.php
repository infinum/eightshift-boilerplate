<?php

/**
 * Template for the link Component.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$manifest = Components::getManifest(__DIR__);

$linkUse = Components::checkAttr('linkUse', $attributes, $manifest);
if (!$linkUse) {
	return;
}

$componentClass = $attributes['componentClass'] ?? $manifest['componentClass'];
$selectorClass = $attributes['selectorClass'] ?? $componentClass;
$blockClass = $attributes['blockClass'] ?? '';

$linkUrl = Components::checkAttr('linkUrl', $attributes, $manifest);
$linkContent = Components::checkAttr('linkContent', $attributes, $manifest);
$linkIsAnchor = Components::checkAttr('linkIsAnchor', $attributes, $manifest);
$linkId = Components::checkAttr('linkId', $attributes, $manifest);
$linkIsNewTab = Components::checkAttr('linkIsNewTab', $attributes, $manifest);
$linkAriaLabel = Components::checkAttr('linkAriaLabel', $attributes, $manifest);
$linkAttrs = Components::checkAttr('linkAttrs', $attributes, $manifest);

if ($linkIsNewTab) {
	$linkAttrs = array_merge(
		[
			'target' => '_blank',
			'rel' => '"noopener noreferrer"',
		],
		$linkAttrs
	);
};

$linkWrapClass = Components::classnames([
	Components::selectorBlock($componentClass, 'wrap'),
	Components::selector($componentClass, 'align', 'linkAlign', $attributes, $manifest),
	Components::selectorBlock($blockClass, "{$selectorClass}-wrap"),
]);


$linkClass = Components::classnames([
	$componentClass,
	Components::selector($componentClass, 'color', 'linkColor', $attributes, $manifest),
	Components::selector($componentClass, 'size', 'linkSize', $attributes, $manifest),
	Components::selectorBlock($linkIsAnchor, 'js-scroll-to-anchor'),
	Components::selectorBlock($blockClass, $selectorClass),
]);

?>

<div class="<?php echo \esc_attr($linkWrapClass); ?>">
	<?php if (! $linkUrl) { ?>
		<link
			class="<?php echo \esc_attr($linkClass); ?>"
			id="<?php echo \esc_attr($linkId); ?>"
			title="<?php echo \esc_attr($linkContent); ?>"
			aria-label="<?php echo \esc_attr($linkAriaLabel); ?>"
			<?php
			foreach ($linkAttrs as $key => $value) {
				echo \wp_kses_post("{$key}=" . $value . " ");
			}
			?>
		>
			<?php echo \esc_html($linkContent); ?>
		</link>

	<?php } else { ?>
		<a
			href="<?php echo \esc_url($linkUrl); ?>"
			class="<?php echo \esc_attr($linkClass); ?>"
			id="<?php echo \esc_attr($linkId); ?>"
			title="<?php echo \esc_attr($linkContent); ?>"
			aria-label="<?php echo \esc_attr($linkAriaLabel); ?>"
			<?php
			foreach ($linkAttrs as $key => $value) {
				echo \wp_kses_post("{$key}=" . $value . " ");
			}
			?>
		>
			<?php echo \esc_html($linkContent); ?>
		</a>
	<?php } ?>
</div>
