<?php
/**
 * Register scripts
 *
 * @package theme_name
 */

add_action( 'wp_enqueue_scripts', 'inf_register_scripts', 1 );

if ( ! function_exists( 'inf_register_scripts' ) ) {

  /**
   * Register global theme scripts
   */
  function inf_register_scripts() {

    // Remove jQuery because it is bundled in with webpack.
    wp_deregister_script( 'jquery' );

    // JS.
    wp_register_script( 'scripts', get_template_directory_uri() . '/skin/public/scripts/application.js', array( 'jquery' ), ASSETS_VERSION );
    wp_enqueue_script( 'scripts' );

    // CSS.
    wp_register_style( 'style', get_template_directory_uri() . '/skin/public/styles/application.css', array(), ASSETS_VERSION );
    wp_enqueue_style( 'style' );

    // Ajax.
    wp_localize_script( 'scripts', 'themeLocalization', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ) );
  }
}

/**
 * Remove Contact form 7 Includes
 */
add_filter( 'wpcf7_load_css', '__return_false' );

/**
* Remove inline gallery css
*/
add_filter( 'use_default_gallery_style', '__return_false' );
