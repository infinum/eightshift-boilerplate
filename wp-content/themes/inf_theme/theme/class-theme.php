<?php
/**
 * The Theme specific functionality.
 *
 * @since   1.0.0
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
   * Register the Stylesheets for the theme area.
   *
   * @since 1.0.0
   */
  public function enqueue_styles() {

    $main_style = General_Helper::get_manifest_assets_data( 'application.css' );
    wp_register_style( static::THEME_NAME . '-style', $main_style, array(), static::THEME_VERSION );
    wp_enqueue_style( static::THEME_NAME . '-style' );

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
    // jQuery.
    wp_deregister_script( 'jquery-migrate' );
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/skin/public/scripts/vendors/jquery.min.js', array(), '3.3.1' ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NotInFooter
    wp_enqueue_script( 'jquery' );

    // JS.
    $main_script_vandors = General_Helper::get_manifest_assets_data( 'vendors.js' );
    wp_register_script( static::THEME_NAME . '-scripts-vendors', $main_script_vandors, array(), static::THEME_VERSION ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NotInFooter
    wp_enqueue_script( static::THEME_NAME . '-scripts-vendors' );

    $main_script = General_Helper::get_manifest_assets_data( 'application.js' );
    wp_register_script( static::THEME_NAME . '-scripts', $main_script, array(), static::THEME_VERSION ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NotInFooter
    wp_enqueue_script( static::THEME_NAME . '-scripts' );

    // Glbal variables for ajax and translations.
    wp_localize_script(
      static::THEME_NAME . '-scripts', 'themeLocalization', array(
          'ajaxurl' => admin_url( 'admin-ajax.php' ),
      )
    );
  }

}
