<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       asf
 * @since      1.0.0
 *
 * @package    Aaa
 * @subpackage Aaa/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aaa
 * @subpackage Aaa/admin
 * @author     asf <asf>
 */
namespace Inf_Theme\Admin;

class Admin {

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
   * Init call
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {

    wp_register_style( $this->theme_name . '-style', get_template_directory_uri() . '/skin/public/styles/applicationAdmin.css', array(), $this->assets_version );
    wp_enqueue_style( $this->theme_name . '-style' );

  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts() {

    wp_enqueue_script( $this->theme_name, plugin_dir_url( __FILE__ ) . 'js/aaa-admin.js', array( 'jquery' ), $this->theme_version, false );

  }

  /**
   * Add admin bar class for different env
   *
   * @param [type] $classes
   * @return void
   */
  function set_enviroment_body_class( $classes ) {
    $this->env = '';

    if ( defined( 'INF_ENV' ) ) {
      $this->env = INF_ENV;
    }

    $classes .= ' env--' . $this->env;

    return $classes;
  }

}
