<?php
/**
 * The Wysiwyg editor specific functionality.
 *
 * @since   1.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

use Inf_Theme\Includes\Service;

/**
 * Class Editor
 */
class Editor implements Service {

  /**
   * Register all the hooks
   *
   * @since 1.0.0
   */
  public function register() {
    add_action( 'admin_init', [ $this, 'add_editor_styles' ] );
  }

  /**
   * Add theme specific styles to editor
   *
   * @since 1.0.0
   */
  public function add_editor_styles() {
    add_editor_style( '/skin/public/styles/applicationAdmin.css' );
  }

}
