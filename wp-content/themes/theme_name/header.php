<!DOCTYPE html>
<html>
<head>
  <?php 
    wp_head();
    get_template_part( 'template-parts/header/head');
    get_template_part( 'template-parts/header/favicons');
  ?>
</head>
<body <?php body_class(); ?>>

<?php get_template_part( 'template-parts/header/header' ); ?>

<main class="main-content">
