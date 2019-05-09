<?php
/**
 * The Manifest data specific functionality.
 * Used in admin or theme side.
 *
 * @since   4.0.0 Init class.
 * @package Inf_Theme\General
 */

namespace Inf_Theme\General;

use Eightshift_Libs\Assets\Manifest as LibManifest;
use Eightshift_Libs\Core\Service;

/**
 * Class Mainfest
 */
class Manifest extends LibManifest implements Service {

  /**
   * Register all the hooks
   *
   * @return void
   *
   * @since 4.0.0 Init.
   */
  public function register() : void {
    add_action( 'init', [ $this, 'register_manifest' ] );
  }

  /**
   * Provide manifest.json url location.
   * You project must provide location for the manifest.json for this to work.
   *
   * @return string
   *
   * @since 1.0.0
   */
  protected function get_manifest_url() : string {
    return get_template_directory() . '/skin/public/manifest.json';
  }

  /**
   * Define global variable for assets manifest.
   *
   * @return void
   *
   * @since 4.0.0 Init.
   */
  public function register_manifest() : void {
    \define( 'INF_ASSETS_MANIFEST', static::register_assets_manifest_data() );
  }

  /**
   * Return full path for specific asset from manifest.json
   * This is used for cache busting assets.
   *
   * @param string $key File name key you want to get from manifest.
   * @return string Full path to asset.
   *
   * @since 1.0.0
   */
  public function get_manifest_assets_data( $key = null ) : ?string {
    if ( ! $key ) {
      return '';
    }

    $data = \json_decode( INF_ASSETS_MANIFEST );

    if ( ! $data ) {
      return '';
    }

    $asset = $data->$key ?? '';

    if ( empty( $asset ) ) {
      return '';
    }
    return \home_url( $asset );
  }
}
