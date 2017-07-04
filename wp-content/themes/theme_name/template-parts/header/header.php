<?php
/**
 * Main header bar
 *
 * @package theme_name
 */

?>

<?php
  $blog_name = get_bloginfo( 'name' );
  $blog_description = get_bloginfo( 'description' );
?>
<div class="header">
  <a class="header__logo-link" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $blog_name ); ?>">
  <img class="header__logo-img" src="<?php echo esc_url( IMAGE_URL . 'logo.svg' ); ?>" title="<?php echo esc_attr( $blog_name ); ?> - <?php echo esc_attr( $blog_description ); ?>" alt="<?php echo esc_attr( $blog_name ); ?> - <?php echo esc_attr( $blog_description ); ?>" />
  </a>
	<?php
	bem_menu(
		'header_main_nav',
		'main-navigation'
	);
	get_template_part( 'template-parts/header/search', 'form' ); ?>
</div>
