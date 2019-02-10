<?php
/**
 * Service interface file
 *
 * @since   1.0.0
 * @package Inf_Theme\Includes
 */

namespace Inf_Theme\Includes;

use Inf_Theme\Includes\Registrable;

/**
 * Interface Service.
 *
 * A generic service. Service is a self contained part of a theme functionality.
 *
 * @since 1.0.0
 */
interface Service extends Registrable {
  /**
   * Theme Name Constant
   *
   * @var string
   *
   * @since 1.0.0
   */
  const THEME_NAME = 'inf_theme';

  /**
   * Theme Version Constant
   *
   * @var string
   *
   * @since 1.0.0
   */
  const THEME_VERSION = '1.0.0';

}
