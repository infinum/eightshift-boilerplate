<?php
/**
 * Image Simple for section creator
 *
 * @package theme_name
 */

if ( ! function_exists( 'inf_sc_get_image_simple' ) ) {

    /**
     * Section Image Simple
     *
     * @param string $key set section object.
     * @param object $array section object.
     * @param string $image_size set image size to return.
     * @param bool   $return_default set image size to return.
     * @return array $array
     */
  function inf_sc_get_image_simple( $key, $array, $image_size, $return_default = true ) {
    $image = '';
    $image_title = '';

    if ( $return_default !== false ) {
      $image = IMAGE_URL . 'no-image-' . $image_size . '.jpg';
    }

    if ( ! empty( inf_get_array_value( $key, $array ) ) ) {
      $image = inf_get_array_value( $key, $array );

      $image_title = $image['title'];
      $image = $image['sizes'][ $image_size ];
    }

    return array(
    'image' => esc_url( $image ),
    'title' => esc_html( $image_title ),
    );
  }
}// End if().
