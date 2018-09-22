#!/usr/bin/env node

const fs = require('fs');
const path = require('path');
const prompt = require('prompt-sync')();
const files = require('./files');
const {exec} = require('promisify-child-process');
const output = require('./output');
const emoji = require('node-emoji');
const ora = require('ora');

const rootDir = path.join(__dirname, '..');

// Helpers
const fgRed = '\x1b[31m';
const fgGreen = '\x1b[32m';
const fgBlue = '\x1b[34m';
const fgMagenta = '\x1b[35m';
const fgCyan = '\x1b[36m';

// Functions
const consoleOutput = (color, text) => {
  console.log(color, text);
};

const capCase = (string) => string.replace(/\W+/g, '_').split('_').map((item) => item[0].toUpperCase() + item.slice(1)).join('_');

const run = async() => {

  // Main script
  output.writeIntro();

  let confirmed = 'n';
  const newManifest = {};
  do {
    newManifest.themeName = output.prompt({
      label: '1. Please enter your theme name (shown in WordPress admin)*:',
      prompt: `${emoji.get('green_book')} Theme name: `,
      error: 'Theme name field is required and cannot be empty.',
      required: true,
    }).trim();

    newManifest.themePackageName = output.prompt({
      label: '2. Please enter your package name (used in translations - ' +
      'lowercase, no special characters, \'_\' or \'-\' allowed for spaces)*:',
      prompt: `${emoji.get('package')} Package name: `,
      error: 'Package name field is required and cannot be empty.',
      required: true,
    }).replace(/\W+/g, '-').toLowerCase().trim();

    newManifest.themePrefix = output.prompt({
      label: '3. Please enter a theme prefix (used when defining constants - ' +
      'uppercase, no spaces, no special characters)*:',
      prompt: `${emoji.get('bullettrain_front')} Prefix (e.g. INF, ABRR): `,
      error: 'Prefix is required and cannot be empty.',
      required: true,
    }).toUpperCase().trim();

    newManifest.themeEnvConst = `${newManifest.themePrefix}_ENV`;
    newManifest.themeAssetsManifestConst = `${newManifest.themePrefix}_ASSETS_MANIFEST`;

    // Namespace
    newManifest.themeNamespace = capCase(newManifest.themePackageName);

    // Dev url
    newManifest.themeProxyUrl = output.prompt({
      label: '4. Please enter a theme development url (for local development with browsersync -  ' +
      'no protocol)*:',
      prompt: `${emoji.get('earth_africa')} Dev url (e.g. dev.wordpress.com): `,
      error: 'Dev url is required and cannot be empty.',
      required: true,
    }).trim();

    // Theme description
    newManifest.themeDescription = output.prompt({
      label: '5. Please enter your theme description:',
      prompt: `${emoji.get('spiral_note_pad')}  Theme description: `,
      required: false,
    }).trim();

    // Author name
    newManifest.themeAuthor = output.prompt({
      label: '6. Please enter author name:',
      prompt: `${emoji.get('crab')} Author name: `,
      required: false,
    }).trim();

    // Author email
    newManifest.themeAuthorEmail = output.prompt({
      label: '7. Please enter author email:',
      prompt: `${emoji.get('email')}  Author email: `,
      required: false,
    }).trim();

    confirmed = output.summary([
      {label: `${emoji.get('green_book')} Theme name`, variable: newManifest.themeName},
      {label: `${emoji.get('spiral_note_pad')}  Theme description`, variable: newManifest.themeDescription},
      {label: `${emoji.get('crab')} Author`, variable: `${newManifest.themeAuthor} <${newManifest.themeAuthorEmail}>`},
      {label: `${emoji.get('package')} Package`, variable: newManifest.themePackageName},
      {label: `${emoji.get('sun_behind_cloud')}  Namespace`, variable: newManifest.themeNamespace},
      {label: `${emoji.get('bullettrain_front')} Theme prefix`, variable: newManifest.themePrefix},
      {label: `${emoji.get('earth_africa')} Dev url`, variable: newManifest.themeProxyUrl},
    ]);
  } while (confirmed !== 'y');

  // Read info from the old manifest (needles we're replacing in haystack)
  let oldManifest;
  if (fs.existsSync(files.manifest)) {
    oldManifest = JSON.parse(fs.readFileSync(files.manifest, 'utf8'));
  }

  output.dim('--------------------------------------------------');
  output.dim('    Great! We have everything we need for now,    ');
  output.dim('    we\'ll start setting up your project...       ');
  output.dim('--------------------------------------------------');

  // -----------------------------
  //  1. Rename files
  // -----------------------------

  const spinnerRename = ora('1. Replacing files (this might take some time)').start();
  await files.renameAllFiles(oldManifest, newManifest).then(() => {
    spinnerRename.succeed();
  }).catch((error) => {
    spinnerRename.fail(`${spinnerRename.text}\n${error}`);
  });

  // Write the new manifest only after we've replaced everything.
  fs.writeFile(files.manifest, JSON.stringify(newManifest, null, 2), 'utf8', () => {});

  // -----------------------------
  //  2. Update Composer dependencies
  // -----------------------------

  const spinnerComposer = ora('2. Updating composer').start();
  await exec('npx composer update').then(() => {
    spinnerComposer.succeed();
  }).catch((error) => {
    spinnerComposer.fail(`${spinnerComposer.text}\n${error}`);
  });
  
  // -----------------------------
  //  3. Install WP Core
  // -----------------------------

  const spinnerWpCore = ora('3. Installing WP Core').start();
  await exec('wp core download --skip-content').then(() => {
    spinnerWpCore.succeed();
  }).catch((error) => {
    spinnerWpCore.fail(`${spinnerWpCore.text}\n${error}`);
  });
}
run();
