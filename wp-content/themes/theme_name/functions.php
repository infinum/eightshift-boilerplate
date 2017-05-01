<?php
/**
 * Theme functions and definitions
 *
 * Set up the theme and provide helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @package {*theme_name*}
 * @version {*version*}
 * @author {*author*}
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://github.com/infinum/wp-boilerplate
 * @since  1.0.0
 */

/**
 * Theme includes
 */
require get_parent_theme_file_path( '/inc/admin.php' );
require get_parent_theme_file_path( '/inc/enqueue.php' );
require get_parent_theme_file_path( '/inc/helpers.php' );
require get_parent_theme_file_path( '/inc/media.php' );
require get_parent_theme_file_path( '/inc/menu.php' );
require get_parent_theme_file_path( '/inc/theme-options.php' );
require get_parent_theme_file_path( '/inc/widgets.php' );
require get_parent_theme_file_path( '/inc/xmlrpc.php' );
