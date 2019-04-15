<?php
/**
 * The Widgets specific functionality.
 *
 * TODO: Refactor as a service.
 *
 * @since   1.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

use Eightshift_Libs\Core\Service;

/**
 * Class Widgets
 *
 * This class handles all Widget registrations and options.
 */
class Widgets implements Service {

  /**
   * Register all the hooks
   *
   * @return void
   *
   * @since 1.0.0
   */
  public function register() : void {
    add_action( 'widgets_init', [ $this, 'register_widget_position' ] );
  }

  /**
   * Set up widget areas
   *
   * @return void
   *
   * @since 1.0.0
   */
  public function register_widget_position() : void {
    \register_sidebar(
      [
        'name'          => esc_html__( 'Blog', 'inf_theme' ),
        'id'            => 'blog',
        'description'   => esc_html__( 'Description', 'inf_theme' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
      ]
    );
  }

}
