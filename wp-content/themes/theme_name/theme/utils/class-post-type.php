<?php
/**
 * The Utils-Post Type specific functionality.
 *
 * @since   1.0.0
 * @package theme_name
 */

namespace Inf_Theme\Theme\Utils;

/**
 * Class Post Type
 */
class Post_Type {

  /**
   * Global theme name
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $theme_name;

  /**
   * Global theme version
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $theme_version;

  /**
   * Global assets version
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $assets_version;

  /**
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   *
   * @since 1.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name     = $theme_info['theme_name'];
    $this->theme_version  = $theme_info['theme_version'];
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Return post type link
   *
   * @param  string $class       Class to add to the link.
   * @param  object $post_object Post object.
   * @param  string $name        Name of the link.
   * @return string              Html link to the post.
   *
   * @since 1.0.0
   */
  function get_post_type_link( $class = null, $post_object = null, $name = null ) {

    // If in loop add post type from global post.
    if ( ! $post_object ) {
      global $post;
      $post_type = $post->post_type;
    } else {
      $post_type = $post_object;
    }

    $post_type_object = get_post_type_object( $post_type );

    if ( 'post' !== $post_type ) {
      $slug = '/' . $post_type_object->rewrite['slug'];
    } else {
      $slug = get_permalink( get_option( 'page_for_posts' ) );
    }

    if ( ! $name ) {
      $name = $post_type_object->labels->singular_name;
    }

    return '<a href="' . $slug . '" class="' . $class . '"> ' . $name . ' </a>';
  }

  /**
   * Check if custom post type exists
   *
   * @param object $post_object Post object.
   * @return boolian            True/False if exists.
   *
   * @since 1.0.0
   */
  function does_post_type_exist( $post_object = null ) {

    // If in loop add post type from global post.
    if ( ! $post_object ) {
      global $post;
      $post_type = $post->post_type;
    } else {
      $post_type = $post_object;
    }

    if ( 'post' === $post_type ) {
      $output = false;
    } else {
      $output = true;
    }

    return $output;
  }
}
