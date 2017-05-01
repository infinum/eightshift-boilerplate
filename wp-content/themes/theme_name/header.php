<?php
/**
 * Header
 *
 * @package {*theme_name*}
 * @version {*version*}
 * @author {*author*}
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://github.com/infinum/wp-boilerplate
 * @since  1.0.0
 */

?><!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0" name="viewport">
	<meta name="keywords" content="" />
	<?php
	get_template_part( 'template-parts/header/favicons' );
	wp_head();
	?>
</head>
<body <?php body_class(); ?>>

<?php get_template_part( 'template-parts/header/header' ); ?>

<main class="main-content">
