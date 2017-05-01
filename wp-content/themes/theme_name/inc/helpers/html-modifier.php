<?php

/**
 * HTML Modifier - Add modifier class
 *
 * @param [string] $class
 * @param [string] $modifier
 * @return string
 */
function modifier( $class, $modifier ) {
	if ( ! empty( $modifier ) ) {
		$output = $class . '--' . $modifier;
	} else {
		$output = '';
	}

	return $output;
}
