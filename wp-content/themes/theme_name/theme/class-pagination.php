<?php
/**
 * The Pagination specific functionality.
 *
 * @since   1.0.0
 * @package theme_name
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
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Posts next attibutes
   *
   * @return string Return class for link
   */
  function pagination_link_next_class() {
    return 'class="page-numbers next"';
  }

  /**
   * Posts prev attibutes
   *
   * @return string Return class for link
   */
  function pagination_link_prev_class() {
    return 'class="page-numbers prev"';
  }
}
