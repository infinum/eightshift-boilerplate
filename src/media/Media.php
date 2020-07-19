<?php
/**
 * The Media specific functionality.
 *
 * @package EightshiftBoilerplate\Media
 */

declare( strict_types=1 );

namespace EightshiftBoilerplate\Media;

use EightshiftBoilerplateVendor\EightshiftLibs\Media\Media as MediaMedia;

/**
 * Class Media
 *
 * This class handles all media options. Sizes, Types, Features, etc.
 */
class Media extends MediaMedia {

  /**
   * Register all the hooks
   *
   * @return void
   */
  public function register() {
    parent::register();

    add_action( 'after_setup_theme', [ $this, 'add_custom_image_sizes' ], 20 );
  }

  /**
   * Create new image sizes
   *
   * @return void
   */
  public function add_custom_image_sizes() {
    \add_image_size( 'listing', 570, 320, true );
  }
}
