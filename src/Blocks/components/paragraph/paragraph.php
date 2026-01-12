<?php

/**
 * Paragraph component template.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Helpers;

$paragraphUse = Helpers::checkAttr('paragraphUse', $attributes, $manifest);

if (!$paragraphUse) {
	return;
}

$additionalClass = $attributes['additionalClass'] ?? '';

$paragraphContent = Helpers::checkAttr('paragraphContent', $attributes, $manifest);

if (!$paragraphContent) {
	return;
}
?>

<p class="<?php echo esc_attr(Helpers::tailwindClasses('base', $attributes, $manifest, $additionalClass)); ?>">
	<?php
	// phpcs:ignore Eightshift.Security.HelpersEscape.OutputNotEscaped
	echo $paragraphContent;
	?>
</p>
