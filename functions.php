<?php
/**
 * Theme Name: Infinum WP Boilerplate
 * Description: This is WP Boilerplate, a modern boilerplate / starter theme.
 * Author: Team Eightshift
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
 * Include the autoloader so we can dynamically include the rest of the classes.
 *
 * @since 1.0.0
 * @package Inf_Theme
 */
require get_template_directory() . '/vendor/autoload.php';

/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 *
 * @since 3.0.0 Shorten the theme initialization.
 * @since 2.0.0
 */
( new Includes\Main() )->register();
