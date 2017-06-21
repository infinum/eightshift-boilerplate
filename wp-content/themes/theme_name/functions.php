<?php
/**
 * Theme Name: {*theme_name*}
 * Description: {*description*}
 * Author: {*author*}
 * Author URI: {*author_uri*}
 * Version: {*version*}
 *
 * @package theme_name
 */

/**
 * Change every time you deply changes in assets to server
 * to force browser to clear cache
 *
 * @package theme_name
 */

const ASSETS_VARSION = '1';

require get_parent_theme_file_path( '/inc/admin.php' );
require get_parent_theme_file_path( '/inc/enqueue.php' );
require get_parent_theme_file_path( '/inc/general.php' );
require get_parent_theme_file_path( '/inc/helpers.php' );
require get_parent_theme_file_path( '/inc/media.php' );
require get_parent_theme_file_path( '/inc/menu.php' );
require get_parent_theme_file_path( '/inc/pagination.php' );
require get_parent_theme_file_path( '/inc/theme-options.php' );
require get_parent_theme_file_path( '/inc/widgets.php' );
