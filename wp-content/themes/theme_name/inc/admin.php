<?php

/**
 * Custom WordPress Login link
 * @param $url
 * @return string|void
 */
function custom_login_url($url) {
  return home_url( '/' );
}add_filter( 'login_headerurl', 'custom_login_url' );

// -----------------------------------------------------------

/**
 * Custom WordPress Login Logo
 */
function login_css() {
  wp_enqueue_style( 'login_css', get_template_directory_uri() . '/style-admin.css' );
}add_action('login_head', 'login_css');

// -----------------------------------------------------------