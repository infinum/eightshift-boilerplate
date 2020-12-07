<?php

/**
 * Template for the Paragraph Block view.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

echo \wp_kses_post(Components::render('paragraph', $attributes));
