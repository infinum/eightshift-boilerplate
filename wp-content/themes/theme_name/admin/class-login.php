<?php

/**
 * The login-specific functionality.
 * 
 * @since      1.0.0
 *
 * @package    Aaa
 */

/**
 * The login-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aaa
 */
namespace Inf_Theme\Admin;

class Login {

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
   * Custom WordPress Login link
   *
   * @since    1.0.0
   */
  public function custom_login_url() {
    return home_url( '/' );
  }

}
