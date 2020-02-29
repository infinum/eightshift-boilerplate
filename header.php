<?php
/**
 * Main header file
 *
 * @package Eightshift_Boilerplate\Layout\Header
 *
 * @since 1.0.0
 */

use Eightshift_Libs\Blocks\Helpers\Components;
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
echo wp_kses_post( Components::render( 'header', [
  'leftComponent' => [
    Components::render( 'hamburger' ),
    Components::render( 'drawer', [
      'trigger' => 'js-hamburger',
      'overlay' => 'js-page-overlay',
      'drawerPosition' => 'left',
      'menu' => [ 'variation' => 'vertical' ],
      'parentClass' => 'header',
    ] ),
  ],
  'centerComponent' => Components::render( 'logo' ),
  'rightComponent' => Components::render( 'menu', [
    'variation' => 'horizontal',
    'parentClass' => 'header',
  ] ),
] ) );
?>

<?php echo wp_kses_post( Components::render( 'page-overlay' ) ); ?>

<main class="main-content">

