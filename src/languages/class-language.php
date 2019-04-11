<?php
/**
 * The Language specific functionality.
 *
 * @since   4.0.0 Init class.
 * @package Inf_Theme\Language
 */

namespace Inf_Theme\Language;

use Eightshift_Libs\Core\Service;

/**
 * Class Language
 *
 * This class handles theme or admin languages.
 */
class Language implements Service {

  /**
   * Register all the hooks
   *
   * @return void
   *
   * @since 4.0.0 Init.
   */
  public function register() : void {
    add_action( 'after_setup_theme', [ $this, 'load_theme_textdomain' ] );
  }

  /**
   * Load the plugin text domain for translation.
   *
   * @return void
   *
   * @since 4.0.0 Init.
   */
  public function load_theme_textdomain() : void {
    load_theme_textdomain( THEME_NAME, get_template_directory() . '/languages' );
  }

}
