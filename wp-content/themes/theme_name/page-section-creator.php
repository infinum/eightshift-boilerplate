<?php
/**
 * Template Name: Section Creator
 * Display page as Section Creator
 *
 * @package theme_name
 */

get_header();

$sections = get_field( 'sections' );

if ( ! empty( $sections ) ) {
	foreach ( $sections as $section ) {
		if ( ! empty( $section ) ) {
			include( locate_template( 'template-parts/sections/' . $section['acf_fc_layout'] . '.php' ) );
		}
	}
}

get_footer();
