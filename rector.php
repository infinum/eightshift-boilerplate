<?php

/**
 * Rector bootstrap.
 *
 * @package EightshiftBoilerplate
 */

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\Property\RemoveUselessVarTagRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return RectorConfig::configure()
	->withPaths([
		__DIR__,
	])
	->withBootstrapFiles([__DIR__ . '/vendor-prefixed/autoload.php'])
	->withPhpSets(php84: true)
	->withSets([LevelSetList::UP_TO_PHP_84, SetList::CODE_QUALITY, SetList::DEAD_CODE, SetList::TYPE_DECLARATION, SetList::EARLY_RETURN])
	->withSkip([
		RemoveUselessVarTagRector::class,
		__DIR__ . '/vendor-prefixed/*',
		__DIR__ . '/vendor/*',
		__DIR__ . '/node_modules/*',
		__DIR__ . '/eightshift/*',
		__DIR__ . '/public/*',
		__DIR__ . '/.husky/*',
		__DIR__ . '/.github/*',
		__DIR__ . '/docs/*',
	])
	->withIndent("\t", indentSize: 1)
	->withImportNames(importShortClasses: false, removeUnusedImports: true)
	->withParallel();
