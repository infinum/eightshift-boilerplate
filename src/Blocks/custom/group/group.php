<?php

/**
 * Template for the Group block.
 *
 * @package EightshiftBoilerplate
 */

$blockClass = $attributes['blockClass'] ?? '';

?>

<div class="<?php echo esc_attr($blockClass); ?>">
	<?php echo wp_kses_post($innerBlockContent); ?>
</div>
