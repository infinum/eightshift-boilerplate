<?php

/**
 * Wrapper.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Helpers;

$wrapperUse = Helpers::checkAttr('wrapperUse', $attributes, $manifest);

if (!$wrapperUse) {
	// phpcs:ignore Eightshift.Security.HelpersEscape.OutputNotEscaped
	echo $renderContent;
	return;
}

?>

<div>
	<?php
	// phpcs:ignore Eightshift.Security.HelpersEscape.OutputNotEscaped
	echo $renderContent;
	?>
</div>
