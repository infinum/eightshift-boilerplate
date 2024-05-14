<?php

/**
 * Theme Name: Eightshift Boilerplate Theme
 * Description: This is a initial setup for the Eightshift WordPress Boilerplate Theme.
 * Author: Eightshift team
 * Author URI: https://eightshift.com/
 * Version: 12.0.0
 * License: MIT
 * License URI: http://www.gnu.org/licenses/gpl.html
 * Text Domain: eightshift-boilerplate
 *
 * @package EightshiftBoilerplate
 */

declare(strict_types=1);

namespace EightshiftBoilerplate;

use EightshiftLibs\Cli\Cli;

/**
 * If this file is called directly, abort.
 */
if (! \defined('WPINC')) {
	die;
}

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 */
if (!\file_exists(__DIR__ . '/vendor/autoload.php')) {
	return;
}

require __DIR__ . '/vendor/autoload.php';

/**
 * Run all WPCLI commands.
 */
if (\class_exists(Cli::class)) {
	(new Cli())->load('boilerplate');
}
