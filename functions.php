<?php
/**
 * Theme Name: Eightshift Boilerplate Title
 * Description: Eightshift Boilerplate Description
 * Author: Team Eightshift
 * Author URI: https://eightshift.com/
 * Version: 4.0.0
 * Text Domain: eightshift-boilerplate
 *
 * @package EightshiftBoilerplate
 */

declare( strict_types=1 );

namespace EightshiftBoilerplate;

use EightshiftBoilerplate\Core\Main;

/**
 * If this file is called directly, abort.
 */
if ( ! \defined( 'WPINC' ) ) {
  die;
}

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 */
( new Main() )->register();
