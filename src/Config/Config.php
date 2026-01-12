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

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Helpers;

/**
 * The project config class.
 */
class Config
{
	/**
	 * Method that returns project name.
	 *
	 * Generally used for naming assets handlers, languages, etc.
	 */
	public static function getProjectName(): string
	{
		return Helpers::getThemeName();
	}

	/**
	 * Method that returns project version.
	 *
	 * Generally used for versioning asset handlers while enqueueing them.
	 */
	public static function getProjectVersion(): string
	{
		return Helpers::getThemeVersion();
	}

	/**
	 * Method that returns project text domain.
	 *
	 * Generally used for caching and translations.
	 */
	public static function getProjectTextDomain(): string
	{
		return Helpers::getThemeTextDomain();
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
		return self::getProjectName();
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
