<?php
/**
 * The Manifest Helper specific functionality.
 * USE ONLY IN VIEWS WHERE YOU CANT CONTROL RENDERING METHODS.
 *
 * @since   4.0.0 Init class.
 * @package Inf_Theme\Assets
 */

namespace Inf_Theme\Assets;

use Inf_Theme\Assets\Manifest;

/**
 * Class Manifest_Helper
 */
class Manifest_Helper {

  /**
   * Set Assets Manifest global variable name.
   *
   * @param string $key File name key you want to get from manifest.
   *
   * @return string
   *
   * @since 4.0.0 Init.
   */
  public static function get_assets_manifest_item( string $key ) : string {
    $manifest = new Manifest();
    return $manifest->get_assets_manifest_item( $key );
  }
}
