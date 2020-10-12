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
		'footer',
		[
			'leftComponent' => Components::render('copyright'),
			'centerComponent' => '',
			'rightComponent' => Components::render(
				'menu',
				[
					'variation' => 'horizontal'
				]
			),
		]
	)
);

echo \wp_kses_post(
	Components::render('tracking-before-body-end')
);
?>

<?php wp_footer(); ?>
</body>
</html>
