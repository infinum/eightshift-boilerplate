<?php get_header(); ?>

<?php
  while ( have_posts() ) { the_post();
    get_template_part( 'template-parts/single/post' );
  };

  wp_reset_query();
  
?>

<?php get_footer(); ?>