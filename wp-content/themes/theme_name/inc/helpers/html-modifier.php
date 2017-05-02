<?php
/**
 * HTML Modifier - Add modifier class
 *
 * @param string $class 	Class to which the modifier will be added.
 * @param string $modifier  The modifier added to the class.
 * @return string			Full modified class.
 */
function modifier( $class, $modifier ) {
	return ( ! empty( $modifier ) ) ? $class . '--' . $modifier : '';
}
