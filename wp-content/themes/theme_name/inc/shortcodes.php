<?php
/**
 * Functions for shortcodes
 *
 * @package theme_name
 */

if ( ! function_exists( 'inf_do_shortcode' ) ) {
    /**
     *
     * Call a shortcode function by tag name.
     *
     * @package theme_name
     *
     * @author J.D. Grimes
     * @link https://codesymphony.co/dont-do_shortcode/
     *
     * @param string $tag     The shortcode whose function to call.
     * @param array  $atts    The attributes to pass to the shortcode function. Optional.
     * @param array  $content The shortcode's content. Default is null (none).
     *
     * @return string|bool False on failure, the result of the shortcode on success.
     */
  function inf_do_shortcode( $tag, array $atts = array(), $content = null ) {

    global $shortcode_tags;

    if ( ! isset( $shortcode_tags[ $tag ] ) ) {
      return false;
    }

    return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
  }
}
