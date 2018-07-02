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

use Inf_Theme\Includes\Config;

/**
 * Class Internationalization
 */
class Internationalization extends Config {

  /**
   * Load the plugin text domain for translation.
   *
   * @since 3.0.0 Loading theme name from config class.
   * @since 2.0.0
   */
  public function load_theme_textdomain() {
    load_theme_textdomain( static::THEME_NAME, get_template_directory() . '/languages' );
  }
}
