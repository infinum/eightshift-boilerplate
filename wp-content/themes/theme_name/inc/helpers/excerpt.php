<?php

/**
 * Custom Excerpt to set word limit
 *
 * @param [integer] $limit
 * @param [void] $source
 * @return void
 */
function get_excerpt($limit, $source = null){

  if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
  $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
  $excerpt = strip_shortcodes($excerpt);
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $limit);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
  $excerpt = $excerpt . '...';

  return $excerpt;
}