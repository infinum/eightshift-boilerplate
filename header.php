<?php
/**
 * Main header file
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <?php
    get_template_part( 'src/Blocks/Components/header/components/head/head' );
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

<main class="main-content">

