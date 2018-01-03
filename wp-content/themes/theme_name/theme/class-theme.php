<?php

/**
 * The theme-specific functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package theme_name
 */

/**
 * The theme-specific functionality of the plugin.
 *
 * Defines the theme name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    theme_name
 */
namespace Inf_Theme\Theme;

class Theme {

  protected $theme_name;

  protected $theme_version;

  protected $assets_version;

  /**
   * Init call
   */
  public function __construct( $theme_info ) {
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
    wp_register_script( $this->theme_name . '-jquery', get_template_directory_uri() . '/skin/public/scripts/vendors/jquery.3.1.1.min.js', array(), '3.1.1' );
    wp_enqueue_script( $this->theme_name . '-jquery' );

    // JS.
    if ( ! is_page_template( 'page-templates/page-old-browser.php' ) ) {
      wp_register_script( $this->theme_name . '-webfont', get_template_directory_uri() . '/skin/public/scripts/vendors/webfont.1.6.26.min.js', array( $this->theme_name . '-jquery' ), '1.6.26' );
      wp_enqueue_script( $this->theme_name . '-webfont' ); // Fonts loaded via JS fonts.js.

      wp_register_script( $this->theme_name . '-scripts', get_template_directory_uri() . '/skin/public/scripts/application.js', array( $this->theme_name . '-jquery' ), $this->assets_version );
      wp_enqueue_script( $this->theme_name . '-scripts' );

      // Glbal variables for ajax and translations.
      wp_localize_script(
        $this->theme_name . '-scripts', 'themeLocalization', array(
          'ajaxurl' => admin_url( 'admin-ajax.php' )
        )
      );
    }
  }

}
