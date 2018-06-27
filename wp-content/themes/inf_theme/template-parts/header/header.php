<?php
/**
 * Main header bar
 *
 * @package Inf_Theme\Template_Parts\Header
 */

use Inf_Theme\Admin\Menu as Menu;
$menu             = new Menu\Menu();
$blog_name        = get_bloginfo( 'name' );
$blog_description = get_bloginfo( 'description' );
$header_logo_info = $blog_name . ' - ' . $blog_description;
?>
<div class="header">
  <a class="header__logo-link" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $blog_name ); ?>">
    <img class="header__logo-img" src="<?php echo esc_url( INF_IMAGE_URL . 'logo.svg' ); ?>" title="<?php echo esc_attr( $header_logo_info ); ?>" alt="<?php echo esc_attr( $header_logo_info ); ?>" />
  </a>
  <?php
    echo esc_html( $menu->bem_menu( 'header_main_nav', 'main-navigation' ) );

    get_template_part( 'template-parts/header/search', 'form' );
  ?>
</div>
