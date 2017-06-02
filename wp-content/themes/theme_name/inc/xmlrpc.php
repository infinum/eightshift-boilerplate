<?php

/**
 * @file Disable XMLRPC
 *
 * You will also likely want to add this to .htaccess if you can:
 * <Files xmlrpc.php>
 *     order allow,deny
 *     deny from all
 * </Files>
 *
 * OR in the NGINX server block:
 * location /xmlrpc.php {
 *     deny all;
 * }
 */

add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_headers', 'exposition_disable_x_pingback' );

function exposition_disable_x_pingback( $headers ) {
  unset( $headers['X-Pingback'] );

  return $headers;
}

