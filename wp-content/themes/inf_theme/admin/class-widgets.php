<?php
/**
 * The Widgets specific functionality.
 *
 * @since   2.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

/**
 * Class Widgets
 */
class Widgets {

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
   * Set up widget areas
   *
   * @since 2.0.0
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
