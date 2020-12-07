<?php

/**
 * The file that defines the project entry point class.
 *
 * A class definition that includes attributes and functions used across both the
 * public side of the site and the admin area.
 *
 * @package EightshiftBoilerplate\Config
 */

declare(strict_types=1);

namespace EightshiftBoilerplate\Config;

use EightshiftBoilerplateVendor\EightshiftLibs\Config\AbstractConfigData;

/**
 * The project config class.
 */
class Config extends AbstractConfigData
{

	/**
	 * Method that returns project name.
	 *
	 * Generally used for naming assets handlers, languages, etc.
	 */
	public static function getProjectName(): string
	{
		return 'eightshift-libs';
	}

	/**
	 * Method that returns project version.
	 *
	 * Generally used for versioning asset handlers while enqueueing them.
	 */
	public static function getProjectVersion(): string
	{
		return '1.0.0';
	}

	/**
	 * Method that returns project prefix.
	 *
	 * The WordPress filters live in a global namespace, so we need to prefix them to avoid naming collisions.
	 *
	 * @return string Full path to asset.
	 */
	public static function getProjectPrefix(): string
	{
		return 'eb';
	}

	/**
	 * Returns the project environment variable descriptor.
	 *
	 * Used for defining global settings depending on the environment of the project.
	 * Can be one of, but not limited to, develop, staging, production.
	 *
	 * Defaults to 'develop' (as to not cache manifest in transient) if not otherwise
	 * defined in wp-config.php
	 *
	 * @return string Current project environment string.
	 */
	public static function getProjectEnv(): string
	{
		if (defined('EB_ENV')) {
			return EB_ENV;
		}

		return 'develop';
	}

	/**
	 * Method that returns project REST-API namespace.
	 *
	 * Used for namespacing projects REST-API routes and fields.
	 *
	 * @return string Project name.
	 */
	public static function getProjectRoutesNamespace(): string
	{
		return static::getProjectName();
	}

	/**
	 * Method that returns project REST-API version.
	 *
	 * Used for versioning projects REST-API routes and fields.
	 *
	 * @return string Project route version.
	 */
	public static function getProjectRoutesVersion(): string
	{
		return 'v1';
	}
}
