<?php

/**
 * After setup theme hook
 */

add_action( 'after_setup_theme', 'theme_init' );

if ( ! function_exists( 'theme_init' ) ) {
  function theme_init() {
    require get_parent_theme_file_path( '/inc/admin.php' );
    require get_parent_theme_file_path( '/inc/enqueue.php' );
    require get_parent_theme_file_path( '/inc/helpers.php' );
    require get_parent_theme_file_path( '/inc/media.php' );
    require get_parent_theme_file_path( '/inc/menu.php' );
    require get_parent_theme_file_path( '/inc/theme-options.php' );
    require get_parent_theme_file_path( '/inc/widgets.php' );
    require get_parent_theme_file_path( '/inc/xmlrpc.php' );
  }
}
