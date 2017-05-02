<?php

/**
 * Register scripts
 */
add_action( 'wp_enqueue_scripts', 'register_scripts', 1 );

if ( ! function_exists( 'register_scripts' ) ) {
	function register_scripts() {
		// jQuery

		// wp_deregister_script( 'jquery-migrate' );
		wp_deregister_script( 'jquery' );

		$cdn_jQuery = wp_register_script( 'jquery-cdn', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js' );

		if ( $cdn_jQuery ) {
			wp_enqueue_script( 'jquery-cdn' );
		} else {
			wp_register_script( 'jquery' );
			wp_enqueue_script( 'jquery' );
		}

		// JS
		wp_register_script( 'scripts', get_template_directory_uri() . '/skin/public/scripts/application.js' );
		wp_enqueue_script( 'scripts' );

		if ( ! function_exists( 'wpcf7_enqueue_scripts' ) ) {
			wpcf7_enqueue_scripts();
		}

		// CSS
		wp_register_style( 'style', get_template_directory_uri() . '/skin/public/styles/application.css' );
		wp_enqueue_style( 'style');

		// Ajax
		wp_localize_script( 'scripts', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}
}

/**
 * Remove Contact form 7 Includes
 */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

/**
* Remove inline gallery css
*/
add_filter( 'use_default_gallery_style', '__return_false' );
