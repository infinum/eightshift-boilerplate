<?php

/**
 * Menu component responsible for rendering and styling just the menu.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplate\Menu\Menu;
use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

$use = $attributes['use'] ?? true;

if (!$use) {
	return;
}

$componentClass = $attributes['componentClass'] ?? 'menu';

$name = $attributes['menu'] ?? 'header_main_nav';
$modifier = $attributes['modifier'] ?? '';
$variation = isset($attributes['variation']) ? "{$componentClass}-{$attributes['variation']}" : $componentClass;
$jsClass = $attributes['jsClass'] ?? '';

$parentClasses = Components::classnames([
	$jsClass ? "js-{$jsClass}" : '',
]);

$menu = Menu::bemMenu(
	$name,
	$variation,
	$parentClasses,
	$modifier ? "{$variation}--{$modifier}" : ''
);

if (!empty($menu) && !$menu) {
	echo \esc_html($menu);
}
