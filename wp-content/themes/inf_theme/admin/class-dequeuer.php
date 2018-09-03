<?php
/**
 * Dequeuer is used for dequeuing plugin scripts & styles where they aren't needed
 *
 * @since 1.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

/**
 * Class Dequeuer
 */
class Dequeuer {

  /**
   * Initialize class
   *
   * @since 1.0.0
   */
  public function __construct() {
  }

  /**
   * Used for dequing assets (scripts & styles) of a plugin (identified by $plugin_slug) based on the
   * $should_we_dequeue_here() function.
   *
   * How to use this:
   * ---
   * 1. Create a new function that wraps $this->dequeue_plugin_on
   * 2. Write a anonymouse $should_we_dequeue_here check (returns bool)
   * 3. Hook it to 'wp_print_scripts' and 'wp_print_styles' actions with high priority (>100)
   *
   * @param string   $plugin_slug             Plugin's slug (for example 'contact-form-7').
   * @param function $should_we_dequeue_here  Logic for choosing pages where dequeueing is needed. Should return
   *                                          false for pages where we want to keep the scripts / styles.
   * @return void
   */
  protected function dequeue_plugin_on( string $plugin_slug, $should_we_dequeue_here ) {

    if ( $should_we_dequeue_here() ) {

      if ( current_action() === 'wp_print_scripts' ) {
        global $wp_scripts;

        foreach ( $wp_scripts->queue as $script ) {

          if ( strpos( $wp_scripts->registered[ $script ]->src, "/plugins/$plugin_slug/" ) !== false ) {
            wp_dequeue_script( $script );
          }
        }
      } elseif ( current_action() === 'wp_print_styles' ) {
        global $wp_styles;

        foreach ( $wp_styles->queue as $style ) {

          if ( strpos( $wp_styles->registered[ $style ]->src, "/plugins/$plugin_slug/" ) !== false ) {
            wp_dequeue_style( $style );
          }
        }
      }
    }

  }

  /**
   * Dequeues contact_form_7 on pages defined by the login in the anonymous callback func.
   *
   * @return void
   */
  public function dequeue_contact_form_7() {
    $this->dequeue_plugin_on( 'contact-form-7', function() {
      // Insert logic for choosing on which pages to keep the plugin's styling & scripts
      //
      // Return FALSE for all pages / posts where you want to KEEP assets.
      // Return TRUE  for all pages / posts where you want to DEQUEUE assets.
    } );
  }
}
