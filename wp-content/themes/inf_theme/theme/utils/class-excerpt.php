<?php
/**
 * The Utils-Excerpt specific functionality.
 *
 * @since   3.0.0 Removing constructor and global variables.
 * @since   2.0.0
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
   * @since 2.0.0
   */
  public function get_excerpt( $source = null, $limit = null ) {

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
    $output = strip_tags( $output );

    // Reduce string to limit.
    $output = substr( $output, 0, $limit );

    // Remove any whitespace character.
    $output = trim( preg_replace( '/\s+/', ' ', $output ) );

    // Check if strings are equal if not remove text until first space.
    if ( strcmp( $source, $output ) !== 0 ) {
      $output = substr( $output, 0, strripos( $output, ' ' ) );
    }

    $output = '<p>' . $output . '...</p>';
    return $output;
  }

}
