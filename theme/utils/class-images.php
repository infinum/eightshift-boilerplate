<?php
/**
 * The Utils-Images specific functionality.
 *
 * @since   1.0.0
 * @package Inf_Theme\Theme\Utils
 */

namespace Inf_Theme\Theme\Utils;

use Inf_Theme\Helpers\General_Helper;

/**
 * Class Images
 */
class Images {

  /**
   * Ger featured image for specific post/page ID.
   *
   * If found return it, if not return no image placeholder.
   *
   * @param  string  $size     Image size. Accepts any valid image size.
   * @param  integer $post_id  Post ID.
   * @param  integer $no_image Link to no image thumbnail.
   * @return array             Array with image settings.
   *
   * @since 1.0.0
   */
  public static function get_post_image( $size, $post_id = null, $no_image = null ) {
    global $post;

    if ( ! $post_id ) {
      $post_id = $post->ID;
    }

    if ( has_post_thumbnail( $post_id ) ) {
      $attachemnt_id = get_post_thumbnail_id( $post_id );
      $image         = wp_get_attachment_image_src( $attachemnt_id, $size );

      $image_array = [
        'image'  => $image[0],
        'width'  => $image[1],
        'height' => $image[2],
      ];
    } else {
      $no_img      = General_Helper::get_manifest_assets_data( 'images/no-image-' . $size . '.jpg' );
      $image_array = [
        'image'  => $no_img,
        'width'  => '',
        'height' => '',
      ];

      if ( ! empty( $no_image ) ) {
        $image_array['image'] = $no_image;
      }
    }

    return $image_array;
  }

  /**
   * Get image from image array
   * If found return it, if not return no image placeholder.
   *
   * @param string $size Image size from Image object.
   * @param array  $image_array WP image array.
   *
   * @since 1.0.0
   */
  public static function get_image_from_array( $size, $image_array ) {
    if ( ! empty( $image_array ) ) {
      $img = $image_array['sizes'];
      $src = $img[ $size ];
    } else {
      $src = General_Helper::get_manifest_assets_data( 'images/no-image-' . $size . '.jpg' );
    }

    return [
      'image' => $src,
    ];
  }

}
