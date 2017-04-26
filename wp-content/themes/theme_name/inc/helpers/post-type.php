<?php

/**
 * Return post type link
 */
function get_post_type_link($class, $post_object = NULL, $name = NULL ) {

  // If in loop add post type from global post
  if(!$post_object) {
    global $post;
    $post_type = $post->post_type;
  } else {
    $post_type = $post_object;
  }

  $post_type_object = get_post_type_object($post_type);

  if($post_type !== 'post') {
    $slug = '/' . $post_type_object->rewrite['slug'];
  } else {
    $slug = get_permalink( get_option( 'page_for_posts' ) );
  }

  if(!$name) {
    $name = $post_type_object->labels->singular_name;
  }

  return '<a href="' . $slug . '" class="' . $class . '"> ' . $name . ' </a>';
}

/**
 * Check if custom post type exists
 */
function if_post_type_exists($post_object = NULL) {

  // If in loop add post type from global post
  if(!$post_object) {
    global $post;
    $post_type = $post->post_type;
  } else {
    $post_type = $post_object;
  }

  if($post_type == 'post') {
    $output = false;
  } else {
    $output = true;
  }

  return $output;
}