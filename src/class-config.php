<?php
/**
 * The file that defines the project entry point class.
 *
 * A class definition that includes attributes and functions used across both the
 * public side of the site and the admin area.
 *
 * @package Eightshift_Boilerplate\Core
 */

declare( strict_types=1 );

namespace Eightshift_Boilerplate\Core;

use Eightshift_Libs\Core\Config as Lib_Config;

/**
 * The project config class.
 *
 * @since 4.0.0
 */
class Config extends Lib_Config {

  /**
   * Method that returns project name.
   *
   * Generally used for naming assets handlers, languages, etc.
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_name() : string {
    return 'eightshift-boilerplate';
  }

  /**
   * Method that returns project version.
   *
   * Generally used for versioning asset handlers while enqueueing them.
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_version() : string {
    return '1.0.0';
  }

  /**
   * Method that returns project prefix.
   *
   * The WordPress filters live in a global namespace, so we need to prefix them to avoid naming collisions.
   *
   * @return string Full path to asset.
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_prefix() : string {
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
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_env() : string {
    if ( defined( 'EB_ENV' ) ) {
      return EB_ENV;
    }

    return 'develop';
  }

  /**
   * Method that returns project REST-API namespace.
   *
   * Used for namespacing projects REST-API routes and fields.
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_routes_namespace() : string {
    return static::get_project_name();
  }

  /**
   * Method that returns project REST-API version.
   *
   * Used for versioning projects REST-API routes and fields.
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_routes_version() : string {
    return 'v1';
  }

  /**
   * Method that returns project primary color.
   *
   * Used for styling the mobile browser color and splash screens. Check head.php for more details.
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_primary_color() : string {
    return '#900000';
  }

  /**
   * Return project absolute path.
   *
   * If used in a theme use get_template_directory() and in case it's used in a plugin use __DIR__.
   *
   * @param string $path Additional path to add to project path.
   *
   * @return string
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_path( string $path = '' ) : string {
    return get_template_directory() . $path;
  }
}
