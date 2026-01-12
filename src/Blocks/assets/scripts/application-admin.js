/**
 * This is the main entry point for Block Editor blocks scripts used for the `WordPress frontend screen`.
 * This file registers all blocks additional scripts dynamically using `dynamicImport` helper method.
 * File names must follow naming convention to be able run dynamically.
 *
 * `src/blocks/custom/block_name/assets-admin/index.js`.
 *
 * Usage: `WordPress admin`.
 */
import { dynamicImport } from '@eightshift/frontend-libs-tailwind/scripts/helpers';

// Find all blocks and require assets index.js inside it.
dynamicImport(require.context('./../../components', true, /assets-admin\/index\.js$/));
dynamicImport(require.context('./../../custom', true, /assets-admin\/index\.js$/));

// Output all frontend-only styles.
dynamicImport(require.context('./../../components', true, /styles-admin.css$/));
dynamicImport(require.context('./../../custom', true, /styles-admin.css$/));
