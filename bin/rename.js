#!/usr/bin/env node

const fs = require('fs');
const path = require('path');
const prompt = require('prompt-sync')();
const replace = require('replace-in-file');

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

const findReplace = (findString, replaceString) => {
  const regex = new RegExp(findString, 'g');
  const options = {
    files: `${rootDir}/**/*`,
    from: regex,
    to: replaceString,
    ignore: [
      `${rootDir}/node_modules/**/*`,
      `${rootDir}/.git/**/*`,
      `${rootDir}/.github/**/*`,
      `${rootDir}/vendor/**/*`,
      `${rootDir}/_rename.sh`,
      `${rootDir}/bin/rename.js`,
    ],
  };

  try {
    const changes = replace.sync(options);

    consoleOutput(fgGreen, '');
    consoleOutput(fgGreen, '------------');
    consoleOutput(fgGreen, `${findString}-> ${replaceString}. Modified files: ${changes.join(', ')}`);
  } catch (error) {

    consoleOutput(fgMagenta, '');
    consoleOutput(fgMagenta, '------------');
    console.error('Error occurred:', error);
  }
};


// Main script
consoleOutput(fgGreen, 'Welcome to Boilerplate readme script. The script will uniquely set up your theme.');
consoleOutput(fgGreen, '* - required');
consoleOutput(fgCyan, '');
consoleOutput(fgCyan, '------------');

// Theme name
consoleOutput(fgBlue, '1. Please enter your theme name (shown in WordPress admin)*:');

let themeName;

do {
  themeName = prompt(' Theme name: ').trim();

  if (themeName.length <= 0) {
    consoleOutput(fgRed, 'Theme name field is required and cannot be empty.');
  }
}
while (themeName.length <= 0);

// Package name
consoleOutput(fgCyan, '');
consoleOutput(fgCyan, '------------');
consoleOutput(fgBlue, '2. Please enter your package name (used in translations - ' +
  'lowercase, no special characters, \'_\' or \'-\' allowed for spaces)*:');

let themePackageName;
do {
  themePackageName = prompt(' Package name: ').replace(/\W+/g, '-').toLowerCase().trim();

  if (themePackageName.length <= 0) {
    consoleOutput(fgRed, 'Package name field is required and cannot be empty.');
  }
}
while (themePackageName.length <= 0);

// Theme prefix
consoleOutput(fgCyan, '');
consoleOutput(fgCyan, '------------');
consoleOutput(fgBlue, '3. Please enter a theme prefix (used when defining constants - ' +
'uppercase, no spaces, no special characters)*:');

let themePrefix;
do {
  themePrefix = prompt(' Prefix (e.g. INF, ABRR): ').toUpperCase().trim();

  if (themePrefix.length <= 0) {
    consoleOutput(fgRed, 'Prefix is required and cannot be empty.');
  }
}
while (themePrefix.length <= 0);

const themeEnvConst = `${themePrefix}_ENV`;
const themeAssetsManifestConst = `${themePrefix}_ASSETS_MANIFEST`;

// Namespace
const themeNamespace = capCase(themePackageName);

// Dev url
consoleOutput(fgCyan, '');
consoleOutput(fgCyan, '------------');
consoleOutput(fgBlue, '4. Please enter a theme development url (for local development with browsersync -  ' +
  'no protocol)*:');

let themeProxyUrl;
do {
  themeProxyUrl = prompt(' Dev url (e.g. dev.wordpress.com): ').trim();

  if (themeProxyUrl.length <= 0) {
    consoleOutput(fgRed, 'Dev url is required and cannot be empty.');
  }
}
while (themeProxyUrl.length <= 0);

// Theme description
consoleOutput(fgCyan, '');
consoleOutput(fgCyan, '------------');
consoleOutput(fgBlue, '5. Please enter your theme description:');

const themeDescription = prompt(' Theme description: ').trim();

// Author name
consoleOutput(fgCyan, '');
consoleOutput(fgCyan, '------------');
consoleOutput(fgBlue, '6. Please enter author name:');

const themeAuthor = prompt(' Author name: ').trim();

// Author email
consoleOutput(fgCyan, '');
consoleOutput(fgCyan, '------------');
consoleOutput(fgBlue, '7. Please enter author email:');

const themeAuthorEmail = prompt(' Author email: ').trim();

consoleOutput(fgCyan, '');
consoleOutput(fgCyan, '------------');
consoleOutput(fgGreen, 'Your details will be:');
consoleOutput(fgMagenta, `Theme name: ${themeName}`);
consoleOutput(fgMagenta, `Theme description: ${themeDescription}`);
consoleOutput(fgMagenta, `Author: ${themeAuthor} <${themeAuthorEmail}>`);
consoleOutput(fgMagenta, `Text domain: ${themePackageName}`);
consoleOutput(fgMagenta, `Package: ${themePackageName}`);
consoleOutput(fgMagenta, `Namespace: ${themeNamespace}`);
consoleOutput(fgMagenta, `Theme prefix: ${themePrefix}`);
consoleOutput(fgMagenta, `Dev url: ${themeProxyUrl}`);

consoleOutput(fgMagenta, '');
const confirm = prompt(' Confirm and rename? (y/n) ').trim();

if (confirm === 'y') {
  consoleOutput(fgCyan, '');
  consoleOutput(fgCyan, '------------');
  consoleOutput(fgGreen, 'This might take some time...');

  consoleOutput(fgGreen, '');
  findReplace('init_theme_real_name', themeName);

  consoleOutput(fgGreen, '');
  findReplace('init_description', themeDescription);

  consoleOutput(fgGreen, '');
  findReplace('init_author_name', themeAuthor);

  consoleOutput(fgGreen, '');
  findReplace('inf_theme', themePackageName);

  consoleOutput(fgGreen, '');
  findReplace('Inf_Theme', themeNamespace);

  consoleOutput(fgGreen, '');
  findReplace('INF_ENV', themeEnvConst);

  consoleOutput(fgGreen, '');
  findReplace('INF_ASSETS_MANIFEST', themeAssetsManifestConst);

  consoleOutput(fgGreen, '');
  findReplace('dev.boilerplate.com', themeProxyUrl);

  consoleOutput(fgGreen, '');
  if (themePackageName !== 'inf_theme') {
    if (fs.existsSync(`${rootDir}/wp-content/themes/inf_theme/`)) {
      fs.renameSync(`${rootDir}/wp-content/themes/inf_theme/`, `${rootDir}/wp-content/themes/${themePackageName}/`, (err) => {
        if (err) {
          throw err;
        }
        fs.statSync(`${rootDir}/wp-content/${themePackageName}/`, (error, stats) => {
          if (error) {
            throw error;
          }
          consoleOutput(fgBlue, `stats: ${JSON.stringify(stats)}`);
        });
      });
    }
  }

  consoleOutput(fgGreen, '');
  consoleOutput(fgGreen, '------------');
  consoleOutput(fgGreen, 'Finished! Success! Now start _setup.sh script to begin installations.');

} else {
  consoleOutput(fgRed, '');
  consoleOutput(fgRed, '------------');
  consoleOutput(fgRed, 'Cancelled.');
}
