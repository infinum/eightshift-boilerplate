<?php
/**
 * Display regular index/home page
 *
 * @package EightshiftBoilerplate
 */

get_header();

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    the_title();
    the_content();
  }

  require locate_template( 'src/blocks/components/google-rich-snippets/google-rich-snippets.php' );
}

get_footer();
