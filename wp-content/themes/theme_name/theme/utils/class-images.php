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

class Images {

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
   * Init call
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Get post image
   *
   * If found return if not return no image placeholder.
   *
   * @param  string|array $size  Image size. Accepts any valid image size, or an array of width and height values in pixels.
   * @param  integer      $post_id   Post ID.
   * @param  integer      $no_image  Link to no image thumbnail.
   * @return array        Array with image settings.
   */
  function get_post_image( $size, $post_id = null, $no_image = null ) {
    global $post;

    if ( ! $post_id ) {
      $post_id = $post->ID;
    }

    if ( has_post_thumbnail( $post_id ) ) {
      $attachemnt_id = get_post_thumbnail_id( $post_id );
      $image = wp_get_attachment_image_src( $attachemnt_id, $size );

      $image_array = [
          'image' => esc_url( $image[0] ),
          'width' => esc_html( $image[1] ),
          'height' => esc_html( $image[2] ),
      ];
    } else {
      $image_array = [
          'image' => esc_url( INF_IMAGE_URL . 'no-image-' . $size . '.jpg' ),
          'width' => '',
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
   * If found return if not return no image placeholder
   *
   * @param [type] $size Image size from Image object.
   * @param [type] $image_array WP image array.
   */
  function get_image_from_array( $size, $image_array ) {
    if ( ! empty( $image_array ) ) {
      $img = $image_array['sizes'];
      $src = $img[ $size ];
    } else {
      $src = INF_IMAGE_URL . 'no-image-' . $size . '.jpg';
    }

    return [
        'image' => esc_url( $src ),
    ];
  }

}
