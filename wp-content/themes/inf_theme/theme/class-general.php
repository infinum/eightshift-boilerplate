<?php
/**
 * The General specific functionality.
 *
 * @since   3.0.0 Removing constructor and global variables.
 * @since   2.0.0
 * @package Inf_Theme\Theme
 */

namespace Inf_Theme\Theme;

/**
 * Class General
 */
class General {

  /**
   * Enable theme support
   *
   * @since 2.0.0
   */
  public function add_theme_support() {
    add_theme_support( 'title-tag', 'html5' );
  }

}
