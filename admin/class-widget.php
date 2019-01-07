<?php
/**
 * The Widget specific functionality.
 *
 * @since   3.0.1 Changed the name from Widgets to Widget.
 * @since   1.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

/**
 * Class Widget
 */
class Widget {

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
