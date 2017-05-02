<?php

/**
 * Set up widget areas
 */
if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar(
		array(
		'name' => __( 'Blog', 'Project_name' ),
		'id' => 'blog',
		'description' => __( '', 'Project_name' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		)
	);
}
