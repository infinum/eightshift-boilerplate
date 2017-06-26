<!DOCTYPE html>
<html>
<head>
  <?php
	/**
	 * Main header file
	 *
	 * @package theme_name
	 */

	get_template_part( 'template-parts/header/head' );
	get_template_part( 'template-parts/header/favicons' );
	wp_head();
	?>
</head>
<body <?php body_class(); ?>>

<?php get_template_part( 'template-parts/header/header' ); ?>

<main class="main-content">
