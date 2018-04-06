<?php
/**
 * Template Name: Section Creator
 * Display page as Section Creator
 *
 * @package Inf_Theme\Page_Templates
 */

get_header();

$sections = get_field( 'sections' );

if ( ! empty( $sections ) ) {
  foreach ( $sections as $section ) {
    if ( ! empty( $section ) ) {
      $template = locate_template( 'template-parts/sections/section-creator/' . str_replace( '_', '-', $section['acf_fc_layout'] ) . '.php' );

      if ( ! empty( $template ) ) {
        include $template;
      }
    }
  }
}

get_footer();
