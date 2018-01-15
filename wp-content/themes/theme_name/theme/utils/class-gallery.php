<?php

/**
 * The login-specific functionality.
 * 
 * @since      1.0.0
 *
 * @package    Aaa
 */

/**
 * The login-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aaa
 */
namespace Inf_Theme\Theme\Utils;

/**
 * Class Gallery
 */
class Gallery {

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
   * Wrapper for gallery shortcode
   *
   * @param   string $html The gallery output. Default empty.
   * @param   arraz  $attr Attributes of the gallery shortcode.
   * @param   int    $instance Unique numeric ID of this gallery shortcode instance.
   * @return  $html Modified gallery shortcode.
   */
  function wrap_post_gallery( $html, $attr, $instance ) {
    if ( isset( $attr['class'] ) ) {
      // Unset attribute to avoid infinite recursive loops.
      $class = $attr['class'];
      unset( $attr['class'] );

      // Our custom HTML wrapper.
      $html = sprintf(
        '<div class="%s">%s</div>',
        esc_attr( $class ),
        gallery_shortcode( $attr )
      );
    }
    return $html;
  }
}
