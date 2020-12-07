<?php

/**
 * Template for the Link Block view.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

echo \wp_kses_post(Components::render('link', $attributes));
