<?php
/**
 * Display regular page
 *
 * @package Inf_Theme
 */

get_header();

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    get_template_part( 'views/single/page' );
  }
}

get_footer();
