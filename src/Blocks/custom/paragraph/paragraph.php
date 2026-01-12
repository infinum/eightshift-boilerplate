<?php

/**
 * Paragraph block template.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Helpers;

echo Helpers::render('paragraph', Helpers::props('paragraph', $attributes));
