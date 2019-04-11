<?php
/**
 * The Manifest data specific functionality.
 *
 * @since   4.0.0 Init class.
 * @package Inf_Theme\Core
 */

namespace Inf_Theme\Core;

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
    \add_action( 'init', [ $this, 'register_manifest' ] );
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
}
