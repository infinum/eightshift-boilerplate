<?php
/**
 * Display regular page
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

get_header();

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    the_title();
    the_content();
  }

  echo wp_kses_post( Components::render( 'google-rich-snippets' ) );
}

get_footer();
