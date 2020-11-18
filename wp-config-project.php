<?php

/**
 * Global Environment variable
 *
 * Define global environment variable, and define certain
 * settings based on it.
 *
 * @package EightshiftBoilerplate
 */

if (! defined('EB_ENV')) {
	return false;
}

// Limit revisions for better optimizations.
define('WP_POST_REVISIONS', 10);

// Optimize assets in admin.
define('COMPRESS_CSS', true);
define('COMPRESS_SCRIPTS', true);
define('CONCATENATE_SCRIPTS', true);
define('ENFORCE_GZIP', true);

// Disable editing theme from admin.
define('DISALLOW_FILE_EDIT', true);

// Auto save interval higher to optimize admin.
define('AUTOSAVE_INTERVAL', 240);

// Disable automatic updating of plugins.
define('AUTOMATIC_UPDATER_DISABLED', true);

// Enable debug and error loging.
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);

// Helps preventing login fails.
if (! defined('WP_CLI')) {
	define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
}

// Environment based setup.
if (EB_ENV === 'develop') {
	// Enable direct upload from admin.
	define('FS_METHOD', 'direct');

	// Enable debug and error loging.
	define('WP_DEBUG_DISPLAY', true);
} else {
	// Disable plugins / themes updates from admin.
	define('DISALLOW_FILE_MODS', true);

	// Force login to admin with ssl.
	define('FORCE_SSL_LOGIN', true);

	// Enable debug and error loging.
	define('WP_DEBUG_DISPLAY', false);
}
