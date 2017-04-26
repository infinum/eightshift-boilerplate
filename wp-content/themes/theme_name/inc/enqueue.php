<?php

/**
 * Register scripts
 */
function register_scripts() {

  //jQuery
  if ( ! is_admin() ) {
    // wp_deregister_script( 'jquery-migrate' );
    wp_deregister_script('jquery');
    wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js' );
  }

  //JS
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/skin/public/scripts/application.js' );
  if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
    wpcf7_enqueue_scripts();
  }

  //CSS
  wp_enqueue_style('style', get_template_directory_uri(). '/skin/public/styles/application.css');

  //Ajax
  wp_localize_script( 'global_script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

}add_action('wp_enqueue_scripts', 'register_scripts', 1);

// -----------------------------------------------------------

/**
 * Remove Contact form 7 Includes
 */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// -----------------------------------------------------------

/**
* Remove inline gallery css
*/
add_filter( 'use_default_gallery_style', '__return_false' );
