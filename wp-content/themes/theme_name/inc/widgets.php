<?php
/**
 * Set up widget areas
 */
if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar(
		array(
		'name'          => esc_html__( 'Blog', 'text_domain' ),
		'id'            => 'blog',
		'description'   => esc_html__( '', 'text_domain' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
		)
	);
}
