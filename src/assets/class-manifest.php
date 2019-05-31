<?php
/**
 * The Manifest data specific functionality.
 * Used in admin or theme side.
 *
 * @since   4.0.0 Init class.
 * @package Inf_Theme\Assets
 */

namespace Inf_Theme\Assets;

use Eightshift_Libs\Assets\Manifest as LibManifest;
use Eightshift_Libs\Core\Service;

/**
 * Class Mainfest
 */
class Manifest extends LibManifest {

  /**
   * Get Assets Manifest global variable name.
   *
   * @return string
   *
   * @since 4.0.0 Init.
   */
  protected function get_global_variable_name() : string {
    return 'INF_ASSETS_MANIFEST';
  }
}
