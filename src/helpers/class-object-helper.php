<?php
/**
 * The object helper specific functionality inside classes.
 * Used in admin or theme side but only inside a class.
 *
 * @since   3.0.0
 * @package Inf_Theme\Helpers
 */

namespace Inf_Theme\Helpers;

/**
 * Class Object Helper
 */
trait Object_Helper {

  /**
   * Check if XML is valid file used for svg.
   *
   * @param xml $xml Full xml document.
   * @return boolean
   *
   * @since 3.0.0 Moved to trait.
   * @since 1.0.0
   */
  public function is_valid_xml( $xml ) {
    \libxml_use_internal_errors( true );
    $doc = new \DOMDocument( '1.0', 'utf-8' );
    $doc->loadXML( $xml );
    $errors = \libxml_get_errors();
    return empty( $errors );
  }

}
