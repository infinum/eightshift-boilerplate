<?php
/**
 * The theme-specific functionality of the plugin.
 *
 * @since   1.0.0
 * @package theme_name
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
   */
  protected $theme_name;

  /**
   * Global theme version
   *
   * @var string
   */
  protected $theme_version;

  /**
   * Global assets version
   *
   * @var string
   */
  protected $assets_version;

  /**
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Register the stylesheets for the theme area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {

    wp_register_style( $this->theme_name . '-style', get_template_directory_uri() . '/skin/public/styles/application.css', array(), $this->assets_version );
    wp_enqueue_style( $this->theme_name . '-style' );

  }

  /**
   * Register the JavaScript for the theme area.
   *
   * @since    1.0.0
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

      // Glbal variables for ajax and translations.
      wp_localize_script(
        $this->theme_name . '-scripts', 'themeLocalization', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        )
      );
    }
  }

}
