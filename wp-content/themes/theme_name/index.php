<?php
/**
 * Main template file
 *
 * @package {*theme_name*}
 * @version {*version*}
 * @author {*author*}
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://github.com/infinum/wp-boilerplate
 * @since  1.0.0
 */

get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/listing/grid' );
	}
	the_posts_pagination( array( 'screen_reader_text' => ' ' ) );
} else {
	get_template_part( 'template-parts/listing/empty' );
};

get_footer();
