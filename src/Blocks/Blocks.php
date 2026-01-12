<?php

/**
 * Class Blocks is the base class for Gutenberg blocks registration.
 * It provides the ability to register custom blocks using manifest.json.
 *
 * @package EightshiftBoilerplate\Blocks
 */

declare(strict_types=1);

namespace EightshiftBoilerplate\Blocks;

use EightshiftBoilerplateVendor\EightshiftLibs\Blocks\AbstractBlocks;

/**
 * Class Blocks
 */
class Blocks extends AbstractBlocks
{
	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		// Register all custom blocks.
		\add_action('init', [$this, 'registerBlocks'], 10);

		// Create new custom category for custom blocks.
		\add_filter('block_categories_all', [$this, 'getCustomCategory'], 10, 2);

		// Register custom project color palette.
		\add_action('after_setup_theme', [$this, 'changeEditorColorPalette'], 11);

		// Allow only Eightshift blocks in the editor.
		\add_filter('allowed_block_types_all', [$this, 'getAllBlocksList'], 50, 2);

		// Filter block content.
		\add_filter('render_block_data', [$this, 'filterBlocksContent'], 10, 2);
	}
}
