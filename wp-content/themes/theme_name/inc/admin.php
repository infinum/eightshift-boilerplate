<?php

add_filter( 'login_headerurl', 'custom_login_url' );

if ( ! function_exists( 'custom_login_url' ) ) {
  /**
   * Custom WordPress Login link
   *
   * @param string $url Login header logo URL.
   * @return string|void Custom header logo URL.
   */
  function custom_login_url( $url ) {
    return home_url( '/' );
  }
}

add_action( 'login_enqueue_scripts', 'login_css' );

if ( ! function_exists( 'login_css' ) ) {
  /**
   * Custom WordPress Login Logo
   */
  function login_css() {
    wp_register_style( 'login_css', get_template_directory_uri() . '/style-admin.css' );
    wp_enqueue_style( 'login_css' );
  }
}
