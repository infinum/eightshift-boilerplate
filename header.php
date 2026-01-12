<?php

/**
 * Main header file
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Helpers;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<?php
	// Head component.
	echo Helpers::render('head');

	wp_head();
	?>
</head>

<body>

	<main class="main-content layout-base" id="main-content">
