<?php
/**
 * The Utils-Images specific functionality.
 *
 * @since   2.0.0
 * @package Inf_Theme\Theme\Utils
 */

namespace Inf_Theme\Theme\Utils;

/**
 * Class Images
 */
class Images {

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
   * Ger featured image for specific post/page ID.
   *
   * If found return it, if not return no image placeholder.
   *
   * @param  string  $size     Image size. Accepts any valid image size.
   * @param  integer $post_id  Post ID.
   * @param  integer $no_image Link to no image thumbnail.
   * @return array             Array with image settings.
   *
   * @since 2.0.0
   */
  public function get_post_image( $size, $post_id = null, $no_image = null ) {
    global $post;

    if ( ! $post_id ) {
      $post_id = $post->ID;
    }

    if ( has_post_thumbnail( $post_id ) ) {
      $attachemnt_id = get_post_thumbnail_id( $post_id );
      $image         = wp_get_attachment_image_src( $attachemnt_id, $size );

      $image_array = [
          'image'  => esc_url( $image[0] ),
          'width'  => esc_html( $image[1] ),
          'height' => esc_html( $image[2] ),
      ];
    } else {
      $image_array = [
          'image'  => esc_url( INF_IMAGE_URL . 'no-image-' . $size . '.jpg' ),
          'width'  => '',
          'height' => '',
      ];

      if ( ! empty( $no_image ) ) {
        $image_array['image'] = esc_url( $no_image );
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
   * @since 2.0.0
   */
  public function get_image_from_array( $size, $image_array ) {
    if ( ! empty( $image_array ) ) {
      $img = $image_array['sizes'];
      $src = $img[ $size ];
    } else {
      $src = INF_IMAGE_URL . 'no-image-' . $size . '.jpg';
    }

    return [
        'image' => $src,
    ];
  }

}
