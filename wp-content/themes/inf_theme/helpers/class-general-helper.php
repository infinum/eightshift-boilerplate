<?php
/**
 * The general helper specific functionality.
 * Used in admin or theme side.
 *
 * @since   3.0.0 Removing constructor and global variables.
 * @since   2.0.0
 * @package Inf_Theme\Helpers
 */

namespace Inf_Theme\Helpers;

/**
 * Class General Helper
 */
class General_Helper {

  /**
   * Check if array has key and return its value if true.
   * Useful if you want to be sure that key exists and return empty if it doesn't.
   *
   * @param string $key   Array key to check.
   * @param array  $array Array in which the key should be checked.
   * @return string       Value of the key if it exists, empty string if not.
   *
   * @since 2.0.0
   */
  public function get_array_value( $key, $array ) {
    return ( gettype( $array ) === 'array' && array_key_exists( $key, $array ) ) ? $array[ $key ] : '';
  }

  /**
   * Return full path for specific asset from manifest.json
   * This is used for cache busting assets.
   *
   * @param string $key File name key you want to get from manifest.
   * @return string Full path to asset.
   *
   * @since 3.0.0
   */
  public function get_manifest_assets_data( $key = null ) {
    $data = INF_ASSETS_MANIFEST;

    if ( ! ( $key || $data ) ) {
      return;
    }

    $asset = $this->get_array_value( $key, $data );

    if ( ! empty( $asset ) ) {
      return home_url( $asset );
    }
  }

  /**
   * Check if XML is valid file used for svg.
   *
   * @param xml $xml Full xml document.
   * @return boolean
   *
   * @since 2.0.2
   */
  public function is_valid_xml( $xml ) {
    libxml_use_internal_errors( true );
    $doc = new \DOMDocument( '1.0', 'utf-8' );
    $doc->loadXML( $xml );
    $errors = libxml_get_errors();
    return empty( $errors );
  }

  /**
   * Call a shortcode function by tag name.
   *
   * @author J.D. Grimes
   * @link https://codesymphony.co/dont-do_shortcode/
   *
   * @param string $tag     The shortcode whose function to call.
   * @param array  $atts    The attributes to pass to the shortcode function. Optional.
   * @param array  $content The shortcode's content. Default is null (none).
   *
   * @return string|bool False on failure, the result of the shortcode on success.
   *
   * @since 2.0.0
   */
  public function inf_do_shortcode( $tag, array $atts = array(), $content = null ) {

    global $shortcode_tags;

    if ( ! isset( $shortcode_tags[ $tag ] ) ) {
      return false;
    }

    return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
  }
}
