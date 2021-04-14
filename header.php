<?php

/**
 * Main header file
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;
use EightshiftBoilerplate\Manifest\Manifest;

?>
<!DOCTYPE html>
<html <?php \language_attributes(); ?>>
<head>
	<?php
	// Head Component.
	echo Components::render( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		'head',
		[
			'icon' => \apply_filters(Manifest::MANIFEST_ITEM, 'logo.svg'),
		]
	);

	\wp_head();
	?>
</head>
<body <?php \body_class(); ?>>

<?php
// Header Component.
echo Components::render( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'layout-three-columns',
	[
		'selectorClass' => 'header',
		'layoutLeft' => Components::render(
			'logo',
			[
				'parentClass' => 'header',
				'logoSrc' => \apply_filters(Manifest::MANIFEST_ITEM, 'logo.svg'),
				'logoAlt' => \get_bloginfo('name'),
				'logoTitle' => \get_bloginfo('name'),
				'logoHref' => \get_bloginfo('url'),
			]
		),
		'layoutCenter' => Components::render(
			'menu',
			[
				'variation' => 'horizontal',
				'parentClass' => 'header',
			]
		),
		'layoutRight' => Components::render('hamburger'),
	]
);

// Menu Drawer Style Component.
echo Components::render( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	'drawer',
	[
		'drawerTrigger' => 'js-hamburger',
		'drawerOverlay' => 'js-page-overlay',
		'drawerPosition' => 'left',
		'drawerMenu' => Components::render(
			'menu',
			[
				'variation' => 'vertical',
				'parentClass' => 'drawer',
			]
		),
	]
);

// Page Overlay Component.
echo Components::render('page-overlay'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
?>

<main class="main-content">
