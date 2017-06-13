<?php

/**
* ACF options pages
*/
if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
    'page_title' 	=> 'Theme General Settings',
    'menu_title'	=> 'Theme',
    'menu_slug' 	=> 'theme-general-settings',
    'capability'	=> 'edit_posts',
    'redirect'		=> false
  ));

  // acf_add_options_sub_page(array(
  //   'page_title' 	=> 'Theme Map Settings',
  //   'menu_title'	=> 'Map',
  //   'parent_slug'	=> 'theme-general-settings',
  // ));

  // acf_add_options_sub_page(array(
  //   'page_title' 	=> 'Theme Footer Settings',
  //   'menu_title'	=> 'Footer',
  //   'parent_slug'	=> 'theme-general-settings',
  // ));
}