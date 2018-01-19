<?php
/**
 * The Admin specific functionality.
 * General stuff that is not specific to any class.
 *
 * @since   1.0.0
 * @package init_theme_name
 */

namespace Inf_Theme\Admin;

/**
 * Class Admin
 */
class Admin {

  /**
   * Global theme name
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $theme_name;

  /**
   * Global theme version
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $theme_version;

  /**
   * Global assets version
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $assets_version;

  /**
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   *
   * @since 1.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name     = $theme_info['theme_name'];
    $this->theme_version  = $theme_info['theme_version'];
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Register the Stylesheets for the admin area.
   *
   * @since 1.0.0
   */
  public function enqueue_styles() {

    wp_register_style( $this->theme_name . '-style', get_template_directory_uri() . '/skin/public/styles/applicationAdmin.css', array(), $this->assets_version );
    wp_enqueue_style( $this->theme_name . '-style' );

  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since 1.0.0
   */
  public function enqueue_scripts() {

    wp_register_script( $this->theme_name . '-scripts', get_template_directory_uri() . '/skin/public/scripts/applicationAdmin.js', array(), $this->assets_version );
    wp_enqueue_script( $this->theme_name . '-scripts' );

  }

  /**
   * Add admin bar class for different environment
   *
   * You can style admin bar of each environment differently for better
   * differentiation, and smaller chance of error.
   *
   * @param  string $classes Get preset body classes.
   * @return string $classes Body classes with env class.
   *
   * @since 1.0.0
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
