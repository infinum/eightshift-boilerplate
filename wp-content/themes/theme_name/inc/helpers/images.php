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

    if(!$post_id) {
      $post_id = $post->ID;
    }

    if ( has_post_thumbnail($post_id) ) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $size );
      $image_src = $image[0];
      $image_width = $image[1];
      $image_height = $image[2];
    } else {
      $image = get_template_directory_uri().'/skin/public/images/no-image-'.$size.'.jpg';
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
}


if ( ! function_exists( 'get_image_from_array' ) ) {
  /**
   * Get image from image array
   * If found return if not return no image placeholder
   *
   * @param integer $size
   * @param array $image_array
   * @return array
   */
  function get_image_from_array($size, $image_array) {
    if (!empty($image_array)) {
      $img = $image_array['sizes'];
      $src = $img[$size];
      $width = $img[$size . '-width'];
      $height = $img[$size . '-height'];
    } else {
      $src = get_template_directory_uri().'/skin/public/images/no-image-'.$size.'.jpg';
      $width = 1440;
      $height = 700;
    }

    return [
      'image'  => esc_url( $src ),
      'width'  => intval( $width ),
      'height' => intval( $height ),
    ];

    return [
      'image' => $src,
      'width' => $width,
      'height' => $height
    ];
  }
}