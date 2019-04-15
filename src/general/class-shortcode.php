<?php
/**
 * The Shortcode specific functionality.
 * Used in admin or theme side.
 *
 * @since   4.0.0 Switched to a new file.
 * @since   1.0.0
 * @package Inf_Theme\General
 */

namespace Inf_Theme\General;

/**
 * Class Shortcode
 */
class Shortcode {

  /**
   * Call a shortcode function by tag name.
   *
   * @author J.D. Grimes
   * @link https://codesymphony.co/dont-do_shortcode/
   *
   * @param string $tag     The shortcode whose function to call.
   * @param array  $atts    The attributes to pass to the shortcode function. Optional.
   * @param array  $content The shortcode's content. Default is null (none).
   *
   * @return string|bool False on failure, the result of the shortcode on success.
   *
   * @since 1.0.0
   */
  public function inf_do_shortcode( $tag, array $atts = [], $content = null ) {

    global $shortcode_tags;

    if ( ! isset( $shortcode_tags[ $tag ] ) ) {
      return false;
    }

    return \call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
  }
}
