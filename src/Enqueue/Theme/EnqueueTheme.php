<?php
/**
 * The Theme/Frontend Enqueue specific functionality.
 *
 * @package EightshiftBoilerplate\Enqueue\Theme
 */

declare( strict_types=1 );

namespace EightshiftBoilerplate\Enqueue\Theme;

use EightshiftBoilerplate\Config\Config;
use EightshiftBoilerplateVendor\EightshiftLibs\Enqueue\Theme\AbstractEnqueueTheme;
use EightshiftBoilerplateVendor\EightshiftLibs\Manifest\ManifestInterface;

/**
 * Class EnqueueTheme
 */
class EnqueueTheme extends AbstractEnqueueTheme {

  /**
   * Create a new admin instance.
   *
   * @param ManifestInterface $manifest Inject manifest which holds data about assets from manifest.json.
   */
  public function __construct( ManifestInterface $manifest ) {
    $this->manifest = $manifest;
  }

  /**
   * Register all the hooks
   *
   * @return void
   */
  public function register() : void {
    add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ], 10 );
    add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
  }

  /**
   * Method that returns assets name used to prefix asset handlers.
   *
   * @return string
   */
  public function get_assets_prefix() : string {
    return Config::get_project_name();
  }

  /**
   * Method that returns assets version for versioning asset handlers.
   *
   * @return string
   */
  public function get_assets_version() : string {
    return Config::get_project_version();
  }
}
