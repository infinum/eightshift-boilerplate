import { eightshiftConfig } from '@eightshift/frontend-libs-tailwind/webpack/index.mjs';
import path from 'path';
import { fileURLToPath } from 'url';
import { execSync } from 'child_process';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const esTwResponsiveCompiler = () => ({
	apply: (compiler) => {
		// Initial run.
		compiler.hooks.initialize.tap('PreprocessTailwindPlugin', () => {
			console.log('🔄 Generating responsive Tailwind class combinations');

			try {
				execSync('node preprocess-tailwind.js', { stdio: 'inherit' });
				console.log('✅ Done!');
			} catch (error) {
				console.error('❌ Failed. ', error);
			}
		});

		// Re-run on manifest edit.
		compiler.hooks.watchRun.tapAsync('PreprocessTailwindPlugin', ({ modifiedFiles }, callback) => {
			if (modifiedFiles) {
				const manifestChanged = [...modifiedFiles].some((file) => file.includes('manifest.json')) ?? false;

				if (manifestChanged) {
					console.log('🔄 A manifest was modified, re-running responsive Tailwind class combination generation');
					try {
						execSync('node preprocess-tailwind.js', { stdio: 'inherit' });
						console.log('✅ Done!');
					} catch (error) {
						console.error('❌ Failed. ', error);
					}
				}
			}

			callback();
		});
	},
});

/**
 * This is a main entrypoint for Webpack config.
 * All the settings are pulled from node_modules/@eightshift/frontend-libs/webpack.
 * We are loading mostly used configuration but you can always override or turn off the default setup and provide your own.
 * Please referer to Eightshift-libs wiki for details.
 */
export default (_, argv) => {
	const projectConfig = {
		config: {
			projectDir: __dirname, // Current project directory absolute path.
			projectPath: 'wp-content/themes/eightshift-boilerplate', // Project path relative to project root.
		},
	};

	// Generate webpack config for this project using options object.
	const config = eightshiftConfig(argv.mode, projectConfig);

	return {
		...config,
		plugins: [esTwResponsiveCompiler, ...config.plugins],
	};
};
