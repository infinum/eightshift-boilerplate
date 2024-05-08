<?php

/**
 * Theme Name: %themeName%
 * Description: %description%
 * Author: %author%
 * Author URI: %authorUrl%
 * Version: %version%
 * License: MIT
 * License URI: http://www.gnu.org/licenses/gpl.html
 * Text Domain: %textdomain%
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
require __DIR__ . '/vendor/autoload.php';

/**
 * Run all WPCLI commands.
 */
if (\class_exists(Cli::class)) {
	(new Cli())->load('boilerplate');
}
