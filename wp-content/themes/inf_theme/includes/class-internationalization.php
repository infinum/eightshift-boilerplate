<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since   2.0.0
 * @package Inf_Theme\Includes
 */

namespace Inf_Theme\Includes;

/**
 * Class Internationalization
 */
class Internationalization {

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
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   *
   * @since 2.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name    = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
  }

  /**
   * Load the plugin text domain for translation.
   *
   * @since 2.0.0
   */
  public function load_theme_textdomain() {
    load_theme_textdomain( $this->theme_name, get_template_directory() . '/languages' );
  }
}
