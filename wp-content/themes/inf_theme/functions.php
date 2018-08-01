<?php
/**
 * Theme Name: init_theme_real_name
 * Description: init_description
 * Author: init_author_name
 * Author URI:
 * Version: 1.0
 * Text Domain: inf_theme
 *
 * @package Inf_Theme
 */

namespace Inf_Theme;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/**
 * Global image path
 *
 * @since 2.0.0
 * @package Inf_Theme
 */
define( 'INF_IMAGE_URL', get_template_directory_uri() . '/skin/public/images/' );

/**
 * Global assets public path
 *
 * @since 3.0.0
 * @package Inf_Theme
 */
define( 'INF_ASSETS_PUBLIC_PATH', get_template_directory() . '/skin/public/' );

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 *
 * @since 2.1.0 Using Composer based autloader.
 * @since 2.0.0
 * @package Inf_Theme
 */
require WP_CONTENT_DIR . '/../vendor/autoload.php';

/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 *
 * @since 2.0.0
 */
function init_theme() {
  $plugin = new Includes\Main();
  $plugin->run();
}

init_theme();
