<?php
/**
 * Set up widget areas
 *
 * @package theme_name
 */

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar(
		array(
		'name'          => esc_html__( 'Blog', 'theme_name' ),
		'id'            => 'blog',
		'description'   => esc_html__( 'Description', 'theme_name' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
		)
	);
}
