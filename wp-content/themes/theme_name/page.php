<?php

get_header();

while ( have_posts() ) { the_post();
	get_template_part( 'template-parts/single/page' );
};

wp_reset_query();

get_footer();
