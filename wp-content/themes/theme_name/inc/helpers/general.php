<?php

/**
 * Check if array has hey and return key if true
 *
 * @param [string] $key
 * @param [array] $array
 * @return void
 */
function get_array_key($key, $array) {
 if(array_key_exists($key, $array)) {
    $output = $array[$key];
  } else {
    $output = '';
  }

  return $output;
}
 