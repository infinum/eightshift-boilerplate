<?php
/**
 * The Widgets specific functionality.
 *
 * @since   1.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

use Inf_Theme\Includes\Service;

/**
 * Class Widgets
 */
class Widgets implements Service {

  /**
   * Register all the hooks
   *
   * @since 1.0.0
   */
  public function register() {
    add_action( 'widgets_init', [ $this, 'register_widget_position' ] );
  }

  /**
   * Set up widget areas
   *
   * @since 1.0.0
   */
  public function register_widget_position() {
    register_sidebar(
      array(
        'name'          => esc_html__( 'Blog', 'inf_theme' ),
        'id'            => 'blog',
        'description'   => esc_html__( 'Description', 'inf_theme' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
      )
    );
  }

}
