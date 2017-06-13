<?php
if ( ! function_exists( 'get_array_value' ) ) {
  /**
  * Check if array has key and return its value if true
  *
  * @param string $key   Array key to check.
  * @param array  $array Array in which the key should be checked.
  * @return string        Value of the key if it exists, empty string if not.
  */
  function get_array_value( $key, $array ) {
    return ( gettype($array) == 'array' && array_key_exists( $key, $array ) ) ? $array[ $key ] : '';
  }
}