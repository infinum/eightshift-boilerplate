<?php

/**
 * The Admin Enqueue specific functionality.
 *
 * @package EightshiftBoilerplate\Enqueue\Admin
 */

declare(strict_types=1);

namespace EightshiftBoilerplate\Enqueue\Admin;

use EightshiftBoilerplate\Config\Config;
use EightshiftBoilerplateVendor\EightshiftLibs\Enqueue\Admin\AbstractEnqueueAdmin;

/**
 * Class EnqueueAdmin
 *
 * This class handles enqueue scripts and styles.
 */
class EnqueueAdmin extends AbstractEnqueueAdmin
{
	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_action('admin_enqueue_scripts', [$this, 'enqueueAdminStyles'], 50);
		\add_action('admin_enqueue_scripts', [$this, 'enqueueAdminScripts']);
	}

	/**
	 * Method that returns assets name used to prefix asset handlers.
	 *
	 * @return string
	 */
	public function getAssetsPrefix(): string
	{
		return Config::getProjectName();
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
	 * Enqueue scripts from AbstractEnqueueBlocks, extended to expose additional data.
	 * Instead of exposing data through localizations, it's now exposed using inline scripts
	 * as ES_ADMIN_DATA.
	 *
	 * @return void
	 */
	public function enqueueAdminScripts(): void
	{
		parent::enqueueAdminScripts();

		$data = \wp_json_encode([
			'nonce' => \wp_create_nonce('wp_rest'),
		]);

		$inlineScript = "const ES_ADMIN_DATA = {$data}";

		\wp_add_inline_script($this->getAdminScriptHandle(), $inlineScript, 'before');
	}
}
