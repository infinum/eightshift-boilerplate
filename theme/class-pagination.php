<?php
/**
 * The Pagination specific functionality.
 *
 * @since   1.0.0
 * @package Inf_Theme\Theme
 */

namespace Inf_Theme\Theme;

use Eightshift_Libs\Core\Service;

/**
 * Class Pagination
 */
class Pagination implements Service {

  /**
   * Register all the hooks
   *
   * @since 1.0.0
   */
  public function register() : void {
    add_filter( 'next_posts_link_attributes', [ $this, 'pagination_link_next_class' ] );
    add_filter( 'previous_posts_link_attributes', [ $this, 'pagination_link_prev_class' ] );
  }

  /**
   * Posts next attibutes
   *
   * @return string Return class for link
   *
   * @since 1.0.0
   */
  public function pagination_link_next_class() {
    return 'class="page-numbers next"';
  }

  /**
   * Posts prev attibutes
   *
   * @return string Return class for link
   *
   * @since 1.0.0
   */
  public function pagination_link_prev_class() {
    return 'class="page-numbers prev"';
  }
}
