<?php

/**
 * Template for the Button Block view.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

echo \wp_kses_post(Components::render('button', $attributes));
