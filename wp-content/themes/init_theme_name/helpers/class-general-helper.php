<?php
/**
 * The general helper specific functionality.
 * Used in admin or theme side.
 *
 * @since   2.0.0
 * @package init_theme_name
 */

namespace Inf_Theme\Helpers;

/**
 * Class General Helper
 */
class General_Helper {

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
    $this->theme_name     = $theme_info['theme_name'];
    $this->theme_version  = $theme_info['theme_version'];
  }

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
   * Return timestamp when file is changes.
   * This is used for cache busting assets.
   *
   * @param string $filename File name you want to get timestamp from.
   * @return init Timestamp.
   *
   * @since 2.0.1
   */
  public function get_assets_version( $filename = null ) {
    if ( ! $filename ) {
      return false;
    }

    $file_location = get_template_directory() . $filename;

    if ( ! file_exists( $file_location ) ) {
      return;
    }

    return filemtime( $file_location );
  }

}
