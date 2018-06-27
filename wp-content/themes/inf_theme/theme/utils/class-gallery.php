<?php
/**
 * The Utils-Gallery specific functionality.
 *
 * @since   3.0.0 Removing constructor and global variables.
 * @since   2.0.0
 * @package Inf_Theme\Theme\Utils
 */

namespace Inf_Theme\Theme\Utils;

/**
 * Class Gallery
 */
class Gallery {

  /**
   * Wrapper for gallery shortcode
   *
   * @param   string $html The gallery output. Default empty.
   * @param   array  $attr Attributes of the gallery shortcode.
   * @param   int    $instance Unique numeric ID of this gallery shortcode instance.
   * @return  string           Modified gallery shortcode.
   *
   * @since 2.0.0
   */
  public function wrap_post_gallery( $html, $attr, $instance ) {
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
