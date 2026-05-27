<?php

/**
 * Display regular index/home page
 *
 * @package EightshiftBoilerplate
 */

declare(strict_types=1);

get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		the_content();
	}
}

get_footer();
