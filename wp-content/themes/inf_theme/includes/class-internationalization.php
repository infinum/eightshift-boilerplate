<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since   3.0.0 Removing constructor and global variables.
 * @since   2.0.0
 * @package Inf_Theme\Includes
 */

namespace Inf_Theme\Includes;

/**
 * Class Internationalization
 */
class Internationalization {

  /**
   * Load the plugin text domain for translation.
   *
   * @since 2.0.0
   */
  public function load_theme_textdomain() {
    load_theme_textdomain( $this->theme_name, get_template_directory() . '/languages' );
  }
}
