<?php
/**
 * The Admin specific functionality.
 * General stuff that is not specific to any class.
 *
 * @since   3.0.0 Removing global variables.
 * @since   2.0.0
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
   * @since 3.0.0 Removing theme name and version.
   * @since 2.0.0
   */
  public function __construct() {
    $this->general_helper = new General_Helper();
  }

  /**
   * Register the Stylesheets for the admin area.
   *
   * @since 2.0.0
   */
  public function enqueue_styles() {

    $main_style = '/skin/public/styles/applicationAdmin.css';
    wp_register_style( static::THEME_NAME . '-style', get_template_directory_uri() . $main_style, array(), $this->general_helper->get_assets_version( $main_style ) );
    wp_enqueue_style( static::THEME_NAME . '-style' );

  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since 2.0.0
   */
  public function enqueue_scripts() {

    $main_script = '/skin/public/scripts/applicationAdmin.js';
    wp_register_script( static::THEME_NAME . '-scripts', get_template_directory_uri() . $main_script, array(), $this->general_helper->get_assets_version( $main_script ) );
    wp_enqueue_script( static::THEME_NAME . '-scripts' );

  }

  /**
   * Method that changes admin colors based on environment variable
   *
   * @param string $color_scheme Color scheme string.
   * @return string              Modified color scheme.
   *
   * @since 2.1.0
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
