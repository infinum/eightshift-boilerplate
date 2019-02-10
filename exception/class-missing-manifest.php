<?php
/**
 * File containing the failure exception class when assets aren't bundled
 *
 * @since 1.1.0
 * @package Inf_Theme\Exception
 */

declare( strict_types=1 );

namespace Inf_Theme\Exception;

/**
 * Class Plugin_Activation_Failure.
 */
class Missing_Manifest extends \InvalidArgumentException implements General_Exception {

  /**
   * Create a new instance of the exception in case
   * a manifest file is missing.
   *
   * @param string $message Error message to show on
   * thrown exception.
   *
   * @return static
   */
  public static function message( $message ) {
    return new static( $message );
  }
}
