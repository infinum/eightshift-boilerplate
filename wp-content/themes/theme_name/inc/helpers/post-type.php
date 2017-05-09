<?php
if ( ! function_exists( 'get_post_type_link' ) ) {
  /**
   * Return post type link
   *
   * @param   string $class Class to add to the link.
   * @param   object $post_object Post object.
   * @param   string $name Name of the link.
   * @return  string Html link to the post.
   */
  function get_post_type_link( $class, $post_object = null, $name = null ) {

    // If in loop add post type from global post.
    if ( ! $post_object ) {
      global $post;
      $post_type = $post->post_type;
    } else {
      $post_type = $post_object;
    }

    $post_type_object = get_post_type_object( $post_type );

    if ( $post_type !== 'post' ) {
      $slug = '/' . $post_type_object->rewrite['slug'];
    } else {
      $slug = get_permalink( get_option( 'page_for_posts' ) );
    }

    if ( ! $name ) {
      $name = $post_type_object->labels->singular_name;
    }

    return '<a href="' . $slug . '" class="' . $class . '">' . $name . '</a>';
  }
}
