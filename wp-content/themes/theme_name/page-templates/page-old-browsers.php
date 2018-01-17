<?php
/**
 * Template Name: Old Browser
 * Display page when you have old browser
 *
 * @package theme_name
 */

?>
<!DOCTYPE html>
<html>
<head>
<?php
  /**
   * Main header file
   *
   * @package theme_name
   */

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
          <img class="old-browser__browsers-img" src="<?php echo esc_url( IMAGE_URL ) . 'chrome.png'; ?>" alt="<?php esc_html_e( 'Google Chrome', 'theme_name' ); ?>" title="<?php esc_html_e( 'Google Chrome', 'theme_name' ); ?>" />
          <?php esc_html_e( 'Google Chrome', 'theme_name' ); ?>
        </a>
      </div>
      <div class="old-browser__browsers-item">
        <a href="https://www.mozilla.org" class="old-browser__browsers-link" target="_blank" rel="nofollow">
          <img class="old-browser__browsers-img" src="<?php echo esc_url( IMAGE_URL ) . 'firefox.png'; ?>" alt="<?php esc_html_e( 'Mozilla Firefox', 'theme_name' ); ?>" title="<?php esc_html_e( 'Mozilla Firefox', 'theme_name' ); ?>" />
          <?php esc_html_e( 'Mozilla Firefox', 'theme_name' ); ?>
        </a>
      </div>
      <div class="old-browser__browsers-item">
        <a href="http://www.opera.com/" class="old-browser__browsers-link" target="_blank" rel="nofollow">
          <img class="old-browser__browsers-img" src="<?php echo esc_url( IMAGE_URL ) . 'opera.png'; ?>" alt="<?php esc_html_e( 'Opera', 'theme_name' ); ?>" title="<?php esc_html_e( 'Opera', 'theme_name' ); ?>" />
          <?php esc_html_e( 'Opera', 'theme_name' ); ?>
        </a>
      </div>
      <div class="old-browser__browsers-item">
        <a href="https://support.apple.com/downloads/safari" class="old-browser__browsers-link" target="_blank" rel="nofollow">
          <img class="old-browser__browsers-img" src="<?php echo esc_url( IMAGE_URL ) . 'safari.png'; ?>" alt="<?php esc_html_e( 'Apple Safari', 'theme_name' ); ?>" title="<?php esc_html_e( 'Apple Safari', 'theme_name' ); ?>" />
          <?php esc_html_e( 'Apple Safari', 'theme_name' ); ?>
        </a>
      </div>
      <div class="old-browser__browsers-item">
        <a href="https://www.microsoft.com/en-us/windows/microsoft-edge" class="old-browser__browsers-link" target="_blank" rel="nofollow">
          <img class="old-browser__browsers-img" src="<?php echo esc_url( IMAGE_URL ) . 'edge.png'; ?>" alt="<?php esc_html_e( 'Microsoft Edge', 'theme_name' ); ?>" title="<?php esc_html_e( 'Microsoft Edge', 'theme_name' ); ?>" />
          <?php esc_html_e( 'Microsoft Edge', 'theme_name' ); ?>
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
