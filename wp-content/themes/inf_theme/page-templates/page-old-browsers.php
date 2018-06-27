<?php
/**
 * Template Name: Old Browser
 * Display page when you have old browser
 *
 * @package Inf_Theme\Page_Templates
 */

?>
<!DOCTYPE html>
<html>
<head>
<?php
  get_template_part( 'template-parts/header/head' );
  get_template_part( 'template-parts/header/favicons' );
  get_template_part( 'template-parts/tracking/head' );
  wp_head();
?>
</head>
<body <?php body_class(); ?>>

  <div class="old-browser__content">
    <div class="old-browser__heading">
      <h1 class="old-browser__title">
        <?php the_title(); ?>
      </h1>
    </div>
    <div class="old-browser__browsers">
      <div class="old-browser__browsers-item">
        <a href="https://www.google.com/chrome/" class="old-browser__browsers-link" target="_blank" rel="nofollow">
          <img class="old-browser__browsers-img" src="<?php echo esc_url( IMAGE_URL ) . 'browsers/chrome.png'; ?>" alt="<?php esc_html_e( 'Google Chrome', 'inf_theme' ); ?>" title="<?php esc_html_e( 'Google Chrome', 'inf_theme' ); ?>" />
          <?php esc_html_e( 'Google Chrome', 'inf_theme' ); ?>
        </a>
      </div>
      <div class="old-browser__browsers-item">
        <a href="https://www.mozilla.org" class="old-browser__browsers-link" target="_blank" rel="nofollow">
          <img class="old-browser__browsers-img" src="<?php echo esc_url( IMAGE_URL ) . 'browsers/firefox.png'; ?>" alt="<?php esc_html_e( 'Mozilla Firefox', 'inf_theme' ); ?>" title="<?php esc_html_e( 'Mozilla Firefox', 'inf_theme' ); ?>" />
          <?php esc_html_e( 'Mozilla Firefox', 'inf_theme' ); ?>
        </a>
      </div>
      <div class="old-browser__browsers-item">
        <a href="http://www.opera.com/" class="old-browser__browsers-link" target="_blank" rel="nofollow">
          <img class="old-browser__browsers-img" src="<?php echo esc_url( IMAGE_URL ) . 'browsers/opera.png'; ?>" alt="<?php esc_html_e( 'Opera', 'inf_theme' ); ?>" title="<?php esc_html_e( 'Opera', 'inf_theme' ); ?>" />
          <?php esc_html_e( 'Opera', 'inf_theme' ); ?>
        </a>
      </div>
      <div class="old-browser__browsers-item">
        <a href="https://support.apple.com/downloads/safari" class="old-browser__browsers-link" target="_blank" rel="nofollow">
          <img class="old-browser__browsers-img" src="<?php echo esc_url( IMAGE_URL ) . 'browsers/safari.png'; ?>" alt="<?php esc_html_e( 'Apple Safari', 'inf_theme' ); ?>" title="<?php esc_html_e( 'Apple Safari', 'inf_theme' ); ?>" />
          <?php esc_html_e( 'Apple Safari', 'inf_theme' ); ?>
        </a>
      </div>
      <div class="old-browser__browsers-item">
        <a href="https://www.microsoft.com/en-us/windows/microsoft-edge" class="old-browser__browsers-link" target="_blank" rel="nofollow">
          <img class="old-browser__browsers-img" src="<?php echo esc_url( IMAGE_URL ) . 'browsers/edge.png'; ?>" alt="<?php esc_html_e( 'Microsoft Edge', 'inf_theme' ); ?>" title="<?php esc_html_e( 'Microsoft Edge', 'inf_theme' ); ?>" />
          <?php esc_html_e( 'Microsoft Edge', 'inf_theme' ); ?>
        </a>
      </div>
      <div class="clear"></div>
    </div>
    <div class="old-browser__footer content-style">
      <?php the_content(); ?>
    </div>
  </div>
  <?php wp_footer(); ?>
  <?php get_template_part( 'template-parts/tracking/before-body-end' ); ?>
</body>
</html>
