<?php
/**
 * The Media specific functionality.
 *
 * @since   1.0.0
 * @package Eightshift_Boilerplate\Media
 */

declare( strict_types=1 );

namespace Eightshift_Boilerplate\Media;

use Eightshift_Libs\Media\Media as Libs_Media;

/**
 * Class Media
 *
 * This class handles all media options. Sizes, Types, Features, etc.
 *
 * @since 1.0.0
 */
class Media extends Libs_Media {

  /**
   * Register all the hooks
   *
   * @return void
   *
   * @since 1.0.0
   */
  public function register() {
    parent::register();

    add_action( 'after_setup_theme', [ $this, 'add_custom_image_sizes' ], 20 );
  }

  /**
   * Create new image sizes
   *
   * @return void
   *
   * @since 1.0.0
   */
  public function add_custom_image_sizes() {
    \add_image_size( 'listing', 570, 320, true );
  }
}
