<?php
get_header();

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    get_template_part( 'template-parts/listing/grid' );
  }
  the_posts_pagination( array(
    'screen_reader_text' => ' ',
  ) );
} else {
  get_template_part( 'template-parts/listing/empty' );
};

get_footer();
