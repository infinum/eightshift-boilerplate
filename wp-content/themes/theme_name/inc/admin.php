<?php
/**
 * Functions related to Admin section
 *
 * @package theme_name
 */

add_filter( 'login_headerurl', 'custom_login_url' );

if ( ! function_exists( 'custom_login_url' ) ) {
	/**
	 * Custom WordPress Login link
	 *
	 * @param string $url Login header logo URL.
	 * @return string|void Custom header logo URL.
	 */
	function custom_login_url( $url ) {
		return home_url( '/' );
	}
}

add_action( 'login_enqueue_scripts', 'login_css' );

if ( ! function_exists( 'login_css' ) ) {
	/**
	 * Custom WordPress Login Logo
	 */
	function login_css() {
		wp_register_style( 'login_css', get_template_directory_uri() . '/skin/public/styles/applicationAdmin.css' );
		wp_enqueue_style( 'login_css' );
	}
}

add_action( 'admin_init', 'theme_add_editor_styles' );

if ( ! function_exists( 'theme_add_editor_styles' ) ) {
	/**
	 * Add custom style to Editor
	 *
	 * @return void
	 */
	function theme_add_editor_styles() {
		add_editor_style( '/skin/public/styles/applicationAdmin.css' );
	}
}
