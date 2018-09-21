#!/usr/bin/env node

const fs = require('fs');
const path = require('path');
const prompt = require('prompt-sync')();
const files = require('./files');

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

// Main script
consoleOutput(fgGreen, 'Welcome to Boilerplate rename script. The script will uniquely set up your theme.');
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

// Save to manifest
let oldManifest;
let newManifest;
if (fs.existsSync(files.manifest)) {
  oldManifest = JSON.parse(fs.readFileSync(files.manifest, 'utf8'));

  newManifest = JSON.stringify({
    name: themeName,
    description: themeDescription,
    author: themeAuthor,
    email: themeAuthorEmail,
    package: themePackageName,
    namespace: themeNamespace,
    env: themeEnvConst,
    assetManifest: themeAssetsManifestConst,
    proxyUrl: themeProxyUrl,
  }, null, 2);
}

if (confirm === 'y') {
  consoleOutput(fgCyan, '');
  consoleOutput(fgCyan, '------------');
  consoleOutput(fgGreen, 'This might take some time...');

  consoleOutput(fgGreen, '');
  findReplace(oldManifest.name, themeName);

  consoleOutput(fgGreen, '');
  findReplace(oldManifest.description, themeDescription);

  consoleOutput(fgGreen, '');
  findReplace(oldManifest.author, themeAuthor);

  consoleOutput(fgGreen, '');
  findReplace(oldManifest.package, themePackageName);

  consoleOutput(fgGreen, '');
  findReplace(oldManifest.namespace, themeNamespace);

  consoleOutput(fgGreen, '');
  findReplace(oldManifest.env, themeEnvConst);

  consoleOutput(fgGreen, '');
  findReplace(oldManifest.assetManifest, themeAssetsManifestConst);

  consoleOutput(fgGreen, '');
  findReplace(oldManifest.proxyUrl, themeProxyUrl);

  consoleOutput(fgGreen, '');
  
  if (themePackageName !== oldManifest.package) {
    if (fs.existsSync(path.join(`${files.themeFolder}/${oldManifest.package}/`))) {
      fs.renameSync(path.join(`${files.themeFolder}/${oldManifest.package}/`), path.join(`${files.themeFolder}/${themePackageName}/`), (err) => {
        if (err) {
          throw err;
        }
        fs.statSync(`${files.wpContentFolder}/${themePackageName}/`, (error, stats) => {
          if (error) {
            throw error;
          }
          consoleOutput(fgBlue, `stats: ${JSON.stringify(stats)}`);
        });
      });
    }
  }

  // Write the new manifest only after we've replaced everything.
  fs.writeFile(files.manifest, newManifest, 'utf8', () => {});

  consoleOutput(fgGreen, '');
  consoleOutput(fgGreen, '------------');
  consoleOutput(fgGreen, 'Finished! Success! Now start _setup.sh script to begin installations.');

} else {
  consoleOutput(fgRed, '');
  consoleOutput(fgRed, '------------');
  consoleOutput(fgRed, 'Cancelled.');
}
