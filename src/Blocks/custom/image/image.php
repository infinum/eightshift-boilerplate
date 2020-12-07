<?php

/**
 * Template for the Image Block view.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

echo wp_kses_post(Components::render('image', $attributes));
