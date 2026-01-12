const fs = require('fs');
const glob = require('glob');

// Make sure to change this in your project!
const BREAKPOINTS = ['sm', 'md'];

const JSON_GLOB_PATTERN = 'src/**/manifest.json'; // Recursively find all manifest.json files

const OUTPUT_FILE = 'es-tw-responsive-classes.txt'; // A file Tailwind will scan

let classes = new Set();

const verbose = process.argv.includes('--verbose');

const getAllClasses = (input) => {
	return Object.values(input).forEach((value) => {
		value.split(' ').forEach((cls) => {
			// classes.add(cls);

			BREAKPOINTS.forEach((bp) => {
				classes.add(`${bp}:${cls}`);
				classes.add(`max-${bp}:${cls}`);
			});
		});
	});
};

function processJsonFile(jsonPath) {
	const content = fs.readFileSync(jsonPath, 'utf-8');
	const json = JSON.parse(content);

	if (!json?.tailwind?.options) {
		return '';
	}

	classes = new Set();

	const responsiveOptions = Object.values(json?.tailwind?.options)?.filter((option) => option.responsive);

	responsiveOptions.forEach(({ twClasses, twClassesEditor, twClassesEditorOnly }) => {
		if (twClasses) {
			getAllClasses(twClasses);
		}

		if (twClassesEditor) {
			getAllClasses(twClassesEditor);
		}

		if (twClassesEditorOnly) {
			getAllClasses(twClassesEditorOnly);
		}
	});

	return [...classes].join(' ');
}

// Find all manifest.json files inside src/
const manifestFiles = glob.sync(JSON_GLOB_PATTERN);

// Using Set to avoid duplicates.
const allClasses = new Set();

// Process manifests.
manifestFiles.forEach((filePath) => {
	if (verbose) {
		console.log(`├─ ${filePath}`);
	}

	processJsonFile(filePath)
		.split(/\s+/)
		.forEach((cls) => allClasses.add(cls));
});

fs.writeFileSync(OUTPUT_FILE, [...allClasses].join(' '));
