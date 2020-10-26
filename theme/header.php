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
	// Header Component.
	echo \wp_kses_post(
		Components::render(
			'head',
			[
				'icon' => \apply_filters(Manifest::MANIFEST_ITEM, 'favicon.png'),
			]
		)
	);
	echo \wp_kses_post(
		Components::render('tracking-head')
	);

	\wp_head();
	?>
</head>
<body <?php \body_class(); ?>>

<?php

// Header Component.
echo \wp_kses_post(
	Components::render(
		'header',
		[
			'leftComponent' => Components::render('hamburger'),
			'centerComponent' => Components::render(
				'logo',
				[
					'parentClass' => 'header',
				]
			),
			'rightComponent' => Components::render(
				'menu',
				[
					'variation' => 'horizontal',
					'parentClass' => 'header',
				]
			),
		]
	)
);

// Menu Drawer Style Component.
echo \wp_kses_post(
	Components::render(
		'drawer',
		[
			'trigger' => 'js-hamburger',
			'overlay' => 'js-page-overlay',
			'drawerPosition' => 'left',
			'menu' => Components::render(
				'menu',
				[
					'variation' => 'vertical',
					'parentClass' => 'drawer',
				]
			),
		]
	)
);

// Page Overlay Component.
echo \wp_kses_post(
	Components::render('page-overlay')
);
?>

<main class="main-content">

