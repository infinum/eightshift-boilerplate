<?php
/**
 * Display regular index/home page
 *
 * @package Inf_Theme
 */

get_header();

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    get_template_part( 'template-parts/listing/articles/grid' );
  }

  the_posts_pagination();

} else {

  get_template_part( 'template-parts/listing/articles/empty' );

};

get_footer();
