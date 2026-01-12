<?php

/**
 * Theme Name: Eightshift Boilerplate Setup Theme
 * Description: This is a initial setup for the Eightshift WordPress Boilerplate Theme.
 * Author: Eightshift team
 * Author URI: https://eightshift.com/
 * Version: 13.0.0
 * License: MIT
 * License URI: http://www.gnu.org/licenses/gpl.html
 * Text Domain: eightshift-boilerplate
 *
 * @package EightshiftBoilerplate
 */

declare(strict_types=1);

namespace EightshiftBoilerplate;

use EightshiftBoilerplate\Cache\ManifestCache;
use EightshiftBoilerplate\Main\Main;
use EightshiftBoilerplateVendor\EightshiftLibs\Cli\Cli;

/**
 * If this file is called directly, abort.
 */
if (! \defined('WPINC')) {
	die;
}

/**
 * Bailout, if the theme is not loaded via Composer.
 */
if (!\file_exists(__DIR__ . '/vendor/autoload.php')) {
	return;
}

/**
 * Require the Composer autoloader.
 */
$loader = require __DIR__ . '/vendor/autoload.php';

/**
 * Require the Composer autoloader for the prefixed libraries.
 */
if (\file_exists(__DIR__ . '/vendor-prefixed/autoload.php')) {
	require __DIR__ . '/vendor-prefixed/autoload.php';
}

/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 */
if (\class_exists(Main::class) && \class_exists(ManifestCache::class)) {
	(new ManifestCache())->setAllCache();
	(new Main($loader->getPrefixesPsr4(), __NAMESPACE__))->register();
}

/**
 * Run all WP-CLI commands.
 */
if (\class_exists(Cli::class)) {
	(new Cli())->load('boilerplate');
}
