<?php
/**
 * Theme Name: init_theme_real_name
 * Description: init_description
 * Author: init_author_name
 * Author URI: init_author_uri
 * Version: 1.0
 * Text Domain: init_theme_name
 *
 * @package init_theme_name
 */

namespace Inf_Theme;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/**
 * Theme version global
 *
 * @package init_theme_name
 */

define( 'INF_THEME_VERSION', '1.0.0' );

/**
 * Theme name global
 *
 * @package init_theme_name
 */

define( 'INF_THEME_NAME', 'init_theme_name' );

/**
 * Change every time you deploy changes in assets to the server
 * to force browser to clear cache
 *
 * @package init_theme_name
 */

define( 'INF_ASSETS_VERSION', '1.0.0' );

/**
 * Global image path
 *
 * @package init_theme_name
 */
define( 'INF_IMAGE_URL', get_template_directory_uri() . '/skin/public/images/' );

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 *
 * @package init_theme_name
 */
include_once( 'lib/autoloader.php' );

/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function init_theme() {
  $plugin = new Includes\Main();
  $plugin->run();
}

init_theme();
