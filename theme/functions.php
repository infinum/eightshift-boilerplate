<?php
/**
 * Theme Name: Eightshift Boilerplate Title
 * Description: Eightshift Boilerplate Description
 * Author: Team Eightshift
 * Author URI: https://eightshift.com/
 * Version: 4.0.0
 * Text Domain: eightshift-boilerplate
 *
 * @package Eightshift_Boilerplate
 *
 * @since 1.0.0
 */

declare( strict_types=1 );

namespace Eightshift_Boilerplate;

use Eightshift_Boilerplate\Core\Theme;

/**
 * If this file is called directly, abort.
 *
 * @since 1.0.0
 */
if ( ! \defined( 'WPINC' ) ) {
  die;
}

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 *
 * @since 1.0.0
 */
require dirname( __DIR__ ) . '/vendor/autoload.php';

/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
( new Theme() )->register();
