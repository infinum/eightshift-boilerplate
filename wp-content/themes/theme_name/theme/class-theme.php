<?php
/**
 * The Theme specific functionality.
 *
 * @since   1.0.0
 * @package init_theme_name
 */

namespace Inf_Theme\Theme;

/**
 * Class Theme
 */
class Theme {

  /**
   * Global theme name
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $theme_name;

  /**
   * Global theme version
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $theme_version;

  /**
   * Global assets version
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $assets_version;

  /**
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   *
   * @since 1.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name     = $theme_info['theme_name'];
    $this->theme_version  = $theme_info['theme_version'];
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Register the Stylesheets for the theme area.
   *
   * @since 1.0.0
   */
  public function enqueue_styles() {

    wp_register_style( $this->theme_name . '-style', get_template_directory_uri() . '/skin/public/styles/application.css', array(), $this->assets_version );
    wp_enqueue_style( $this->theme_name . '-style' );

  }

  /**
   * Register the JavaScript for the theme area.
   *
   * First jQuery that is loaded by default by WordPress will be deregistered and then
   * 'enqueued' with empty string. This is done to avoid multiple jQuery loading, since
   * one is bundled with webpack and exposed to the global window.
   *
   * @since 1.0.0
   */
  public function enqueue_scripts() {
    wp_deregister_script( 'jquery-migrate' );
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '' );

    // JS.
    if ( ! is_page_template( 'page-templates/page-old-browser.php' ) ) {
      wp_register_script( $this->theme_name . '-webfont', get_template_directory_uri() . '/skin/public/scripts/vendors/webfont.1.6.26.min.js', array(), '1.6.26' );
      wp_enqueue_script( $this->theme_name . '-webfont' ); // Fonts loaded via JS fonts.js.

      wp_register_script( $this->theme_name . '-scripts', get_template_directory_uri() . '/skin/public/scripts/application.js', array(), $this->assets_version );
      wp_enqueue_script( $this->theme_name . '-scripts' );

      $ajax_url = '';
      if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
        $ajax_url .= admin_url( 'admin-ajax.php?lang=' . ICL_LANGUAGE_CODE );
      } else {
        $ajax_url .= admin_url( 'admin-ajax.php' );
      }

      // Glbal variables for ajax and translations.
      wp_localize_script(
        $this->theme_name . '-scripts', 'themeLocalization', array(
            'ajaxurl' => $ajax_url,
        )
      );
    }
  }

}
