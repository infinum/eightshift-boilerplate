<?php
/**
 * Function for pagination
 *
 * @package theme_name
 */

/**
 * Add class on default next/prev links
 */
add_filter( 'next_posts_link_attributes', 'posts_link_next_attributes' );
add_filter( 'previous_posts_link_attributes', 'posts_link_prev_attributes' );


if ( ! function_exists( 'posts_link_next_attributes' ) ) {

	/**
	 * Posts next attibutes
	 *
	 * @return string
	 */
	function posts_link_next_attributes() {
		return 'class="page-numbers prev"';
	}
}

if ( ! function_exists( 'posts_link_prev_attributes' ) ) {

	/**
	 * Posts prev attibutes
	 *
	 * @return string
	 */
	function posts_link_prev_attributes() {
		return 'class="page-numbers next"';
	}
}
