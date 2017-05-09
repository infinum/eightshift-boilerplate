<?php
/**
 * HTML Wrapper - Support for a custom class attribute in the native gallery shortcode
 */
add_filter( 'post_gallery', 'post_gallery_wrapper', 10 ,3 );

if ( ! function_exists( 'post_gallery_wrapper' ) ) {
  /**
   * Wrapper for gallery shortcode
   *
   * @param   string $html The gallery output. Default empty.
   * @param   arraz  $attr Attributes of the gallery shortcode.
   * @param   int    $instance Unique numeric ID of this gallery shortcode instance.
   * @return  $html Modified gallery shortcode.
   */
  function post_gallery_wrapper( $html, $attr, $instance ) {
    if ( isset( $attr['class'] ) && $class == $attr['class'] ) {
      // Unset attribute to avoid infinite recursive loops.
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
