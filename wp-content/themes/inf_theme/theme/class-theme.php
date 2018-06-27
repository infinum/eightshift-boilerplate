<?php
/**
 * The Theme specific functionality.
 *
 * @since   2.0.0
 * @package Inf_Theme\Theme
 */

namespace Inf_Theme\Theme;

use Inf_Theme\Helpers as General_Helpers;

/**
 * Class Theme
 */
class Theme {

  /**
   * Global theme name
   *
   * @var string
   *
   * @since 2.0.0
   */
  protected $theme_name;

  /**
   * Global theme version
   *
   * @var string
   *
   * @since 2.0.0
   */
  protected $theme_version;

  /**
   * General Helper class
   *
   * @var object General_Helper
   *
   * @since 2.0.1
   */
  public $general_helper;

  /**
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   *
   * @since 2.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name    = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];

    $this->general_helper = new General_Helpers\General_Helper();
  }

  /**
   * Register the Stylesheets for the theme area.
   *
   * @since 2.0.0
   */
  public function enqueue_styles() {

    $main_style_vendors = '/skin/public/styles/vendors.css';
    wp_register_style( $this->theme_name . '-style-vendors', get_template_directory_uri() . $main_style_vendors, array(), $this->general_helper->get_assets_version( $main_style_vendors ) );
    wp_enqueue_style( $this->theme_name . '-style-vendors' );

    $main_style = '/skin/public/styles/application.css';
    wp_register_style( $this->theme_name . '-style', get_template_directory_uri() . $main_style, array(), $this->general_helper->get_assets_version( $main_style ) );
    wp_enqueue_style( $this->theme_name . '-style' );

  }

  /**
   * Register the JavaScript for the theme area.
   *
   * First jQuery that is loaded by default by WordPress will be deregistered and then
   * 'enqueued' with empty string. This is done to avoid multiple jQuery loading, since
   * one is bundled with webpack and exposed to the global window.
   *
   * @since 2.0.0
   */
  public function enqueue_scripts() {
    // jQuery.
    wp_deregister_script( 'jquery-migrate' );
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/skin/public/scripts/vendors/jquery.3.3.1.min.js', array(), '3.3.1' );
    wp_enqueue_script( 'jquery' );

    // JS.
    if ( ! is_page_template( 'page-templates/page-old-browser.php' ) ) {
      wp_register_script( $this->theme_name . '-webfont', get_template_directory_uri() . '/skin/public/scripts/vendors/webfont.1.6.26.min.js', array(), '1.6.26' );
      wp_enqueue_script( $this->theme_name . '-webfont' ); // Fonts loaded via JS fonts.js.

      $main_script_vandors = '/skin/public/scripts/vendors.js';
      wp_register_script( $this->theme_name . '-scripts-vendors', get_template_directory_uri() . $main_script_vandors, array(), $this->general_helper->get_assets_version( $main_script_vandors ) );
      wp_enqueue_script( $this->theme_name . '-scripts-vendors' );

      $main_script = '/skin/public/scripts/application.js';
      wp_register_script( $this->theme_name . '-scripts', get_template_directory_uri() . $main_script, array(), $this->general_helper->get_assets_version( $main_script ) );
      wp_enqueue_script( $this->theme_name . '-scripts' );

      // If using WPML.
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
