<?php
/**
 * The Theme specific functionality.
 *
 * @since   3.0.0 Removing global variables.
 * @since   2.0.0
 * @package Inf_Theme\Theme
 */

namespace Inf_Theme\Theme;

use Inf_Theme\Helpers\General_Helper;
use Inf_Theme\Includes\Config;

/**
 * Class Theme
 */
class Theme extends Config {

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
   * @since 3.0.0 Removing constructor and global variables.
   * @since 2.0.0
   */
  public function __construct() {

    $this->general_helper = new General_Helper();
  }

  /**
   * Register the Stylesheets for the theme area.
   *
   * @since 2.0.0
   */
  public function enqueue_styles() {

    $main_style = '/skin/public/styles/application.css';
    wp_register_style( static::THEME_NAME . '-style', get_template_directory_uri() . $main_style, array(), $this->general_helper->get_assets_version( $main_style ) );
    wp_enqueue_style( static::THEME_NAME . '-style' );

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
    $main_script_vandors = '/skin/public/scripts/vendors.js';
    wp_register_script( static::THEME_NAME . '-scripts-vendors', get_template_directory_uri() . $main_script_vandors, array(), $this->general_helper->get_assets_version( $main_script_vandors ) );
    wp_enqueue_script( static::THEME_NAME . '-scripts-vendors' );

    $main_script = '/skin/public/scripts/application.js';
    wp_register_script( static::THEME_NAME . '-scripts', get_template_directory_uri() . $main_script, array(), $this->general_helper->get_assets_version( $main_script ) );
    wp_enqueue_script( static::THEME_NAME . '-scripts' );

    // If using WPML.
    $ajax_url = '';
    if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
      $ajax_url .= admin_url( 'admin-ajax.php?lang=' . ICL_LANGUAGE_CODE );
    } else {
      $ajax_url .= admin_url( 'admin-ajax.php' );
    }

    // Glbal variables for ajax and translations.
    wp_localize_script(
      static::THEME_NAME . '-scripts', 'themeLocalization', array(
          'ajaxurl' => $ajax_url,
      )
    );
  }

}
