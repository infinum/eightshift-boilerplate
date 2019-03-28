<?php
/**
 * The Utils-Excerpt specific functionality.
 *
 * @since   1.0.0
 * @package Inf_Theme\Theme\Utils
 */

namespace Inf_Theme\Theme\Utils;

/**
 * Class Excerpt
 */
class Excerpt {

  /**
   * Custom Excerpt to set word limit
   *
   * @param string  $source Excerpt text.
   * @param integer $limit  Number of characters to trim.
   * @return string         Trimmed excerpt.
   *
   * @since 1.0.0
   */
  public static function get_excerpt( $source = null, $limit = null ) {

    if ( empty( $source ) ) {
      return false;
    }

    if ( empty( $limit ) ) {
      $limit = 140;
    }

    // Remove shortcode.
    $output = preg_replace( ' (\[.*?\])', '', $source );
    $output = strip_shortcodes( $output );

    // Remove html tags.
    $output = wp_strip_all_tags( $output );

    // Remove any whitespace character.
    $output = trim( preg_replace( '/\s+/', ' ', $output ) );

    // Check if strings are equal if not remove text until first space.
    if ( strcmp( $source, $output ) !== 0 ) {
      $output = substr( $output, 0, strripos( $output, ' ' ) );
    }

    // Reduce string to limit.
    $output = wp_trim_words( $output, $limit, '...' );

    return $output;

  }

}
