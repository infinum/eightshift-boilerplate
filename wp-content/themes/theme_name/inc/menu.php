<?php
/**
 * Set menues
 *
 * @package theme_name
 */

add_action( 'init', 'inf_register_menus' );

if ( ! function_exists( 'inf_register_menus' ) ) {
	/**
	 * Register Menu positions
	 */
	function inf_register_menus() {
		register_nav_menus(
			array(
			'header_main_nav' => esc_html__( 'Menu', 'theme_name' ),
			)
		);
	}
}

require get_parent_theme_file_path( '/inc/menu/class-walker-texas-ranger.php' );
