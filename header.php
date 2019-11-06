<?php
/**
 * Main header file
 *
 * @package Eightshift_Boilerplate\Layout\Header
 *
 * @since 1.0.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <?php
    get_template_part( 'src/blocks/layout/header/components/head/head' );
    wp_head();
  ?>
</head>
<body <?php body_class(); ?>>

<?php get_template_part( 'src/blocks/layout/header/header' ); ?>

<main class="main-content">
