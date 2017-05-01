<!DOCTYPE html>
<html>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0" name="viewport">
	<meta name="keywords" content="" />
	<?php get_template_part( 'template-parts/header/favicons' ); ?>
	<title>
	<?php wp_title( '' ); ?>
	</title>
	<?php wp_head();?>
</head>
<body <?php body_class(); ?>>

<?php get_template_part( 'template-parts/header/header' ); ?>

<main class="main-content">
