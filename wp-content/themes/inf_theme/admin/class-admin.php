<?php
/**
 * The Admin specific functionality.
 * General stuff that is not specific to any class.
 *
 * @since   1.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

use Inf_Theme\Helpers\General_Helper;
use Inf_Theme\Includes\Config;

/**
 * Class Admin
 */
class Admin extends Config {

  /**
   * Register the Stylesheets for the admin area.
   *
   * @since 1.0.0
   */
  public function enqueue_styles() {

    $main_style = General_Helper::get_manifest_assets_data( 'applicationAdmin.css' );
    wp_register_style( static::THEME_NAME . '-style', $main_style, array(), static::THEME_VERSION );
    wp_enqueue_style( static::THEME_NAME . '-style' );

  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since 1.0.0
   */
  public function enqueue_scripts() {

    $main_script = General_Helper::get_manifest_assets_data( 'applicationAdmin.js' );
    wp_register_script( static::THEME_NAME . '-scripts', $main_script, array(), static::THEME_VERSION, true );
    wp_enqueue_script( static::THEME_NAME . '-scripts' );

  }

  /**
   * Method that changes admin colors based on environment variable
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

}
