<?php
/**
 * ACF options pages
 *
 * @package theme_name
 */

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
		'page_title' => esc_html__( 'Theme General Settings', 'theme_name' ),
		'menu_title' => esc_html__( 'Theme', 'theme_name' ),
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false,
		)
	);
}
