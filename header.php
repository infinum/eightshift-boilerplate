<?php
/**
 * Main header file
 *
 * @package Eightshift_Boilerplate\Layout\Header
 *
 * @since 1.0.0
 */

use Eightshift_Libs\Helpers\Components;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <?php
    get_template_part( 'src/blocks/components/header/components/head/head' );
    wp_head();
  ?>
</head>
<body <?php body_class(); ?>>

<?php
// Header Component.
echo wp_kses_post( Components::render( 'header', [
  'leftComponent' => Components::render( 'hamburger' ),
  'centerComponent' => Components::render( 'logo', [
    'parentClass' => 'header',
  ] ),
  'rightComponent' => Components::render( 'menu', [
    'variation'   => 'horizontal',
    'parentClass' => 'header',
  ] ),
] ) );

// Menu Drawer Style Component.
echo wp_kses_post( Components::render( 'drawer', [
  'trigger' => 'js-hamburger',
  'overlay' => 'js-page-overlay',
  'drawerPosition' => 'left',
  'menu' => Components::render( 'menu', [
    'variation' => 'vertical',
    'parentClass' => 'drawer',
  ] ),
] ) );

// Page Overlay Component.
echo wp_kses_post( Components::render( 'page-overlay' ) );
?>

<?php  ?>

<main class="main-content">

