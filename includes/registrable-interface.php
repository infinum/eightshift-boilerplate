<?php
/**
 * Registrable interface file
 *
 * @since   1.0.0
 * @package Inf_Theme\Includes
 */

namespace Inf_Theme\Includes;

/**
 * Registrable interface.
 *
 * An object that can be registered.
 *
 * A hook register interface that is used by object
 * that needs to register to WordPress actions and filter hooks.
 *
 * @since 1.0.0
 */
interface Registrable {

  /**
   * Register the current Registrable.
   *
   * A register method holds the plugin action and filter hooks.
   * Following the single responsibility principle, every class
   * holds a functionality for a certain part of the plugin.
   * This is why every class should hold its own hooks.
   *
   * @return void
   */
  public function register();
}
