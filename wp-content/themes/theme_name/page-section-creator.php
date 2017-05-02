<?php
/**
 * Template Name: Section Creator
 */

get_header();

$sections = get_field( 'sections' );

if ( ! empty( $sections ) ) {
	foreach ( $sections as $section ) {
		if ( ! empty( $section ) ) {
			// TO DO: Check if this will work if we replace it with get_template_part().
			include( locate_template( 'template-parts/sections/' . $section['acf_fc_layout'] . '.php' ) );
		}
	}
}

get_footer();
