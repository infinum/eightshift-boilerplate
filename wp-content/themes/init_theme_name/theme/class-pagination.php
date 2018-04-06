<?php
/**
 * The Pagination specific functionality.
 *
 * @since   2.0.0
 * @package Inf_Theme\Theme
 */

namespace Inf_Theme\Theme;

/**
 * Class Pagination
 */
class Pagination {

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
   * Posts next attibutes
   *
   * @return string Return class for link
   *
   * @since 2.0.0
   */
  public function pagination_link_next_class() {
    return 'class="page-numbers next"';
  }

  /**
   * Posts prev attibutes
   *
   * @return string Return class for link
   *
   * @since 2.0.0
   */
  public function pagination_link_prev_class() {
    return 'class="page-numbers prev"';
  }
}
