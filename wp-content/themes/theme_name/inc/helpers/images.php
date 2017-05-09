<?php
if ( ! function_exists( 'get_post_image' ) ) {
  /**
   * Get post image
   *
   * If found return if not return no image placeholder.
   *
   * @param  string|array $size Image size. Accepts any valid image size, or an array
   *                of width and height values in pixels.
   * @param  integer      $post_id   Post ID.
   * @return array        Array with image settings.
   */
  function get_post_image( $size, $post_id = null ) {
    global $post;

    if ( ! $post_id ) {
      $post_id = $post->ID;
    }

    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

    if ( has_post_thumbnail( $post_id ) ) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
      $image_src = $image[0];
      $image_width = $image[1];
      $image_height = $image[2];
    } else {
      $image = get_template_directory_uri() . '/skin/public/images/no-image-' . $size . '.jpg';
      $image_src = $image;
      $image_width = 1440;
      $image_height = 700;
    }

    return [
      'image'  => esc_url( $image_src ),
      'width'  => intval( $image_width ),
      'height' => intval( $image_height ),
    ];
  }
}// End if().
