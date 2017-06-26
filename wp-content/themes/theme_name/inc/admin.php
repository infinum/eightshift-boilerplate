<?php
/**
 * Functions related to Admin section
 *
 * @package theme_name
 */

add_filter( 'login_headerurl', 'inf_custom_login_url' );

if ( ! function_exists( 'inf_custom_login_url' ) ) {
	/**
	 * Custom WordPress Login link
	 *
	 * @param string $url Login header logo URL.
	 * @return string|void Custom header logo URL.
	 */
	function inf_custom_login_url( $url ) {
		return home_url( '/' );
	}
}

add_action( 'login_enqueue_scripts', 'inf_login_css' );

if ( ! function_exists( 'inf_login_css' ) ) {
	/**
	 * Custom WordPress Login Logo
	 */
	function inf_login_css() {
		wp_register_style( 'inf_login_css', get_template_directory_uri() . '/skin/public/styles/applicationAdmin.css' );
		wp_enqueue_style( 'inf_login_css' );
	}
}

add_action( 'admin_init', 'inf_theme_add_editor_styles' );

if ( ! function_exists( 'inf_theme_add_editor_styles' ) ) {
	/**
	 * Add custom style to Editor
	 *
	 * @return void
	 */
	function inf_theme_add_editor_styles() {
		add_editor_style( '/skin/public/styles/applicationAdmin.css' );
	}
}
