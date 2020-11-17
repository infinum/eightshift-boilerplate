<?php

/**
 * Display footer
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Components;

?>

</main>

<?php
echo wp_kses_post(
	Components::render(
		'layout-three-columns',
		[
			'layoutLeft' => Components::render(
				'copyright',
				[
					'copyrightBy' => esc_html__('Eightshift', 'eightshift-boilerplate'),
					'copyrightYear' => gmdate('Y'),
					'copyrightContent' => esc_html__('Made with 🧡  by Eightshift team', 'eightshift-boilerplate'),
				]
			),
			'layoutRight' => Components::render(
				'menu',
				[
					'variation' => 'horizontal'
				]
			),
		]
	)
);

wp_footer();
?>
</body>
</html>
