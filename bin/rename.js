#!/usr/bin/env node

const fs = require('fs');
const path = require('path');
const prompt = require('prompt-sync')();

const rootDir = path.join(__dirname, '..');

// Helpers
const fgRed = '\x1b[31m';
const fgGreen = '\x1b[32m';
const fgYellow = '\x1b[33m';
const fgBlue = '\x1b[34m';
const fgMagenta = '\x1b[35m';
const fgCyan = '\x1b[36m';

// Functions
const consoleOutput = (color, text) => {
  console.log(color, text);
};

const capCase = (string) => string.replace(/\W+/g, '_').split('_').map((item) => item[0].toUpperCase() + item.slice(1)).join('_');


// Main script
consoleOutput(fgGreen, 'The script will uniquely set up your theme.');
consoleOutput(fgGreen, '* - required');

// Theme name
consoleOutput(fgBlue, 'Please enter your theme name (shown in WordPress admin)*:');

let themeName;

do {
  consoleOutput(fgBlue, '');
  themeName = prompt('Theme name: ').trim();

  if (themeName.length <= 0) {
    consoleOutput(fgRed, 'Theme name field is required and cannot be empty.');
  }
}
while (themeName.length <= 0);

// Package name
consoleOutput(fgBlue, 'Please enter your package name (used in translations - ' +
  'lowercase with no special characters, \'_\' or \'-\' allowed for spaces)*:');

let themePackageName;
do {
  consoleOutput(fgBlue, '');
  themePackageName = prompt('Package name: ').replace(/\W+/g, '-').toLowerCase().trim();

  if (themePackageName.length <= 0) {
    consoleOutput(fgRed, 'Package name field is required and cannot be empty.');
  }
}
while (themePackageName.length <= 0);

// Theme prefix
consoleOutput(fgBlue, 'Please enter a theme prefix (used when defining constants)*:');

let themePrefix;
do {
  consoleOutput(fgBlue, '');
  themePrefix = prompt('Prefix (e.g. INF, ABRR): ').toUpperCase().trim();

  if (themePrefix.length <= 0) {
    consoleOutput(fgRed, 'Prefix is required and cannot be empty.');
  }
}
while (themePrefix.length <= 0);

const themeVersionConst = `${themePrefix}_THEME_VERSION`;
const themeNameConst = `${themePrefix}_THEME_NAME`;
const themeImageUrlConst = `${themePrefix}_IMAGE_URL`;
const themeEnvConst = `${themePrefix}_ENV`;

// Namespace
const themeNamespace = capCase(themePackageName);

// Dev url
consoleOutput(fgBlue, 'Please enter a theme development url ' +
  '(for local development with browsersync e.g. dev.wordpress.com)*:');

let themeProxyUrl;
do {
  consoleOutput(fgBlue, '');
  themeProxyUrl = prompt('Dev url: ').trim();

  if (themeProxyUrl.length <= 0) {
    consoleOutput(fgRed, 'Dev url is required and cannot be empty.');
  }
}
while (themeProxyUrl.length <= 0);

// Theme description
consoleOutput(fgBlue, 'Please enter your theme description:');

const themeDescription = prompt('Theme description: ').trim();

// Author name
consoleOutput(fgBlue, 'Please enter author name:');

const themeAuthor = prompt('Author name: ').trim();

// Author email
consoleOutput(fgBlue, 'Please enter author email:');

const themeAuthorEmail = prompt('Author email: ').trim();

consoleOutput(fgCyan, '----------------------------------------------------');
consoleOutput(fgGreen, 'Your details will be:');
consoleOutput(fgMagenta, `Theme name: ${themeName}`);
consoleOutput(fgMagenta, `Theme description: ${themeDescription}`);
consoleOutput(fgMagenta, `Author: ${themeAuthor} <${themeAuthorEmail}>`);
consoleOutput(fgMagenta, `Text domain: ${themePackageName}`);
consoleOutput(fgMagenta, `Package: ${themePackageName}`);
consoleOutput(fgMagenta, `Namespace: ${themeNamespace}`);
consoleOutput(fgMagenta, `Theme prefix: ${themePrefix}`);
consoleOutput(fgMagenta, `Dev url: ${themeProxyUrl}`);

const confirm = prompt('Confirm? (y/n) ').trim();

if (confirm === 'y') {
  consoleOutput(fgYellow, 'REPLACE!');
} else {
  consoleOutput(fgRed, 'Cancelled.');
}




