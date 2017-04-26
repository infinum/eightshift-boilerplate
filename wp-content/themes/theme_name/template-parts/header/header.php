<div class="header">

  <a class="header__logo-link" href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
    <img class="header__logo-img" src="<?php echo get_template_directory_uri(); ?>/skin/public/images/logo.svg" title="<?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo('description'); ?>" alt="<?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo('description'); ?>" />
  </a>

  <?php
    bem_menu(
      'header_main_nav',
      'main-navigation'
    );
  ?>

  <?php get_template_part( 'template-parts/header/search', 'form' ); ?>
</div>