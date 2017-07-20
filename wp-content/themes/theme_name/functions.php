<?php
/**
 * Theme Name: theme_name
 * Description: description
 * Author: author
 * Author URI: author_uri
 * Version: version
 *
 * @package theme_name
 */

/**
 * Change every time you deploy changes in assets to server
 * to force browser to clear cache
 *
 * @package theme_name
 */

define( 'ASSETS_VERSION', '1' );

/**
 * Global image path
 *
 * @package theme_name
 */
define( 'IMAGE_URL', get_template_directory_uri() . '/skin/public/images/' );

add_action( 'after_setup_theme', 'inf_after_setup_theme_init' );

/**
 * Require functions partials
 *
 * @return void
 */
function inf_after_setup_theme_init() {

	require get_parent_theme_file_path( '/inc/admin.php' );
	require get_parent_theme_file_path( '/inc/enqueue.php' );
	require get_parent_theme_file_path( '/inc/general.php' );
	require get_parent_theme_file_path( '/inc/helpers.php' );
	require get_parent_theme_file_path( '/inc/media.php' );
	require get_parent_theme_file_path( '/inc/menu.php' );
	require get_parent_theme_file_path( '/inc/pagination.php' );
	require get_parent_theme_file_path( '/inc/theme-options.php' );
	require get_parent_theme_file_path( '/inc/widgets.php' );
}

