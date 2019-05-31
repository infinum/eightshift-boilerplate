<?php
/**
 * The Admin specific functionality.
 *
 * @since   4.0.0 Major refactor, Manifest as DI.
 * @since   1.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

use Eightshift_Libs\Core\Service;
use Eightshift_Libs\Assets\Manifest_Data;

/**
 * Class Admin
 *
 * This class handles enqueue scripts and styles and some
 * admin facing functionality.
 */
class Admin implements Service {

  /**
   * Instance variable of manifest data.
   *
   * @var object
   *
   * @since 4.0.0 Init.
   */
  protected $manifest;

  /**
   * Create a new admin instance that injects manifest data for use in assets registration.
   *
   * @param Manifest_Data $manifest Inject manifest which holds data about assets from manifest.json.
   *
   * @since 4.0.0 Init.
   */
  public function __construct( Manifest_Data $manifest ) {
      $this->manifest = $manifest;
  }

  /**
   * Register all the hooks
   *
   * @return void
   *
   * @since 4.0.0 Adding Register hooks.
   * @since 1.0.0
   */
  public function register() : void {
    add_action( 'login_enqueue_scripts', [ $this, 'enqueue_styles' ] );
    add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ], 50 );
    add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    add_filter( 'get_user_option_admin_color', [ $this, 'set_admin_color_based_on_env' ] );
  }

  /**
   * Register the Stylesheets for the admin area.
   *
   * @return void
   *
   * @since 4.0.0 Chaning handler variable.
   * @since 1.0.0
   */
  public function enqueue_styles() : void {

    // Main style file.
    \wp_register_style( THEME_NAME . '-style', $this->manifest->get_assets_manifest_item( 'applicationAdmin.css' ), [], THEME_VERSION );
    \wp_enqueue_style( THEME_NAME . '-style' );

  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @return void
   *
   * @since 4.0.0 Chaning handler variable.
   * @since 1.0.0
   */
  public function enqueue_scripts() : void {

    // Main JavaScript file.
    \wp_register_script( THEME_NAME . '-scripts', $this->manifest->get_assets_manifest_item( 'applicationAdmin.js' ), [], THEME_VERSION, true );
    \wp_enqueue_script( THEME_NAME . '-scripts' );

  }

  /**
   * Method that changes admin colors based on environment variable. Must have INF_ENV global variable set.
   *
   * @param string $color_scheme Color scheme string.
   * @return string              Modified color scheme.
   *
   * @since 1.0.0
   *
   * // TODO: Handle better.
   */
  public function set_admin_color_based_on_env( $color_scheme ) {
    if ( ! \defined( 'INF_ENV' ) ) {
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
