<?php
/**
 * The Admin specific functionality.
 *
 * @since   1.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

use Eightshift_Libs\Core\Service;

use Inf_Theme\Helpers\General_Helper;

/**
 * Class Admin
 *
 * This class handles enqueue scripts and styles and some
 * admin facing functionality.
 */
class Admin implements Service {

  /**
   * Register all the hooks
   *
   * @since 1.0.0
   */
  public function register() : void {
    add_action( 'login_enqueue_scripts', [ $this, 'enqueue_styles' ] );
    add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ], 50 );
    add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    add_filter( 'get_user_option_admin_color', [ $this, 'set_admin_color_based_on_env' ] );
    add_action( 'after_setup_theme', [ $this, 'load_theme_textdomain' ] );
  }

  /**
   * Register the Stylesheets for the admin area.
   *
   * @since 1.0.0
   */
  public function enqueue_styles() {
    wp_register_style( static::THEME_NAME . '-style', General_Helper::get_manifest_assets_data( 'applicationAdmin.css' ), array(), static::THEME_VERSION );
    wp_enqueue_style( static::THEME_NAME . '-style' );
  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since 1.0.0
   */
  public function enqueue_scripts() {

    wp_register_script( static::THEME_NAME . '-scripts', General_Helper::get_manifest_assets_data( 'applicationAdmin.js' ), array(), static::THEME_VERSION, true );
    wp_enqueue_script( static::THEME_NAME . '-scripts' );

  }

  /**
   * Method that changes admin colors based on environment variable. Must have INF_ENV global variable set.
   *
   * @param string $color_scheme Color scheme string.
   * @return string              Modified color scheme.
   *
   * @since 1.0.0
   */
  public function set_admin_color_based_on_env( $color_scheme ) {
    if ( ! defined( 'INF_ENV' ) ) {
      return false;
    }

    if ( INF_ENV === 'production' ) {
      $color_scheme = 'sunrise';
    } elseif ( INF_ENV === 'staging' ) {
      $color_scheme = 'blue';
    } else {
      $color_scheme = 'fresh';
    }

    return $color_scheme;
  }

  /**
   * Load the plugin text domain for translation.
   *
   * @since 1.0.0
   */
  public function load_theme_textdomain() {
    load_theme_textdomain( static::THEME_NAME, get_template_directory() . '/languages' );
  }

}
