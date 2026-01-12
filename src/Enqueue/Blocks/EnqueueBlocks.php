<?php

/**
 * Enqueue class used to define all script and style enqueues for Gutenberg blocks.
 *
 * @package EightshiftBoilerplate\Enqueue\Blocks
 */

declare(strict_types=1);

namespace EightshiftBoilerplate\Enqueue\Blocks;

use EightshiftBoilerplate\Config\Config;
use EightshiftBoilerplateVendor\EightshiftLibs\Enqueue\Blocks\AbstractEnqueueBlocks;

/**
 * Enqueue_Blocks class.
 */
class EnqueueBlocks extends AbstractEnqueueBlocks
{
	/**
	 * Register all the hooks
	 */
	public function register(): void
	{
		// Editor only script.
		\add_action('enqueue_block_editor_assets', [$this, 'enqueueBlockEditorScript']);

		// Editor only style.
		\add_action('enqueue_block_editor_assets', [$this, 'enqueueBlockEditorStyle'], 50);

		// Frontend only script.
		\add_action('wp_enqueue_scripts', [$this, 'enqueueBlockFrontendScript']);

		// Frontend only style.
		\add_action('wp_enqueue_scripts', [$this, 'enqueueBlockFrontendStyle'], 50);

		// Unregister default style overrides.
		\add_action('enqueue_block_editor_assets', [$this, 'unregisterDefaultStyleOverrides'], 102);
	}

	/**
	 * Method that returns assets name used to prefix asset handlers.
	 *
	 * @return string
	 */
	public function getAssetsPrefix(): string
	{
		return Config::getProjectTextDomain();
	}

	/**
	 * Method that returns assets version for versioning asset handlers.
	 *
	 * @return string
	 */
	public function getAssetsVersion(): string
	{
		return Config::getProjectVersion();
	}

	/**
	 * Get front end style dependencies
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 *
	 * @return array<int, string> List of all the style dependencies.
	 */
	protected function getBlockFrontendStyleDependencies(): array
	{
		return [];
	}

	/**
	 * Get style dependencies
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 *
	 * @return string[] List of all the style dependencies.
	 */
	protected function getBlockEditorStyleDependencies(): array
	{
		return [];
	}
}
