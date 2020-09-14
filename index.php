<?php

/**
 * Display regular index/home page
 *
 * @package EightshiftBoilerplate
 */

get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		the_title();
		the_content();
	}
}

get_footer();
