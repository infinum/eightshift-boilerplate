#!/usr/bin/env node
const prompt = require('prompt-sync')();
const {spawn} = require('child_process');
const {execSync} = require('child_process');
const files = require('./files.js');

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

// ---------------------------
//  1. Info prompting
// ---------------------------

let wpInfo = {
  dbName: 'infinum_boilerplate_dev',
  dbUser: 'wp',
  dbPass: "wp",
  wpUser: "ivan.grginov",
  wpPass: "wp-pass",
  siteName: "ImeStranice"
};

let confirm = 'n';
do {
  // Intro
  consoleOutput(fgGreen, 'We\'re trying to install your theme, please provide us with some info to make it possible');
  consoleOutput(fgBlue, '');
  consoleOutput(fgBlue, '------------');

  // DB Name
  consoleOutput(fgCyan, '1. Please enter your database name:');

  do {
    wpInfo.dbName = prompt(' Database name: ').trim();

    if (wpInfo.dbName.length <= 0) {
      consoleOutput(fgRed, 'Theme database name field cannot be empty.');
    }
  }
  while (wpInfo.dbName.length <= 0);

  consoleOutput(fgBlue, '');
  consoleOutput(fgBlue, '------------');

  // DB User
  consoleOutput(fgCyan, '2. Please enter your database user');

  do {
    wpInfo.dbUser = prompt(' DB user: ').trim();

    if (wpInfo.dbUser.length <= 0) {
      consoleOutput(fgRed, 'Database user field cannot be empty.');
    }
  }
  while (wpInfo.dbUser.length <= 0);

  consoleOutput(fgCyan, '');
  consoleOutput(fgCyan, '------------');

  // DB Pass
  consoleOutput(fgCyan, '3. Please enter your database pass');

  do {
    wpInfo.dbPass = prompt(' DB pass: ').trim();

    if (wpInfo.dbPass.length <= 0) {
      consoleOutput(fgRed, 'Database pass field cannot be empty.');
    }
  }
  while (wpInfo.dbPass.length <= 0);

  consoleOutput(fgBlue, '');
  consoleOutput(fgBlue, '------------');

  // WP Admin username
  consoleOutput(fgCyan, '4. Please enter your desired WP Admin username');

  do {
    wpInfo.wpUser = prompt(' WP username: ').trim();

    if (wpInfo.wpUser.length <= 0) {
      consoleOutput(fgRed, 'WP Admin username field cannot be empty.');
    }
  }
  while (wpInfo.wpUser.length <= 0);

  consoleOutput(fgBlue, '');
  consoleOutput(fgBlue, '------------');

  // Final tally
  consoleOutput(fgCyan, '------------');
  consoleOutput(fgGreen, 'Your details will be:');
  consoleOutput(fgMagenta, `Database name: ${wpInfo.dbName}`);
  consoleOutput(fgMagenta, `Database user: ${wpInfo.dbUser}`);
  consoleOutput(fgMagenta, `Database pass: ${wpInfo.dbPass}`);
  consoleOutput(fgMagenta, `WP admin user: ${wpInfo.wpUser}`);

  consoleOutput(fgMagenta, '');
  confirm = prompt(' Confirm and install? (y/n) ').trim();

} while (confirm !== 'exit' && confirm !== 'y' && confirm.toLowerCase() !== 'yes');

if (confirm === 'exit') {
  consoleOutput(fgGreen, 'Exiting...');
  return true;
}

// ---------------------------
//  2. Installing
// ---------------------------

let state = '0';

// wp config create
try {

  // Try installing the WP core (if needed)
  state = '1. WP Config';
  consoleOutput(fgGreen, `${state}: Installing...`);
  execSync(`wp config create --dbname=${wpInfo.dbName} --dbuser=${wpInfo.dbUser} --dbpass=${wpInfo.dbPass}`, (error, stdout, stderr) => {
    consoleOutput(fgGreen, `  Done!`);
    consoleOutput(fgGreen, '');
  });
} catch (err) {
  consoleOutput(fgGreen, '');
}

// wp core install
try {
  // Now try creating the config (if needed).
  state = '2. WP Install';
  consoleOutput(fgGreen, `${state}: Creating config...`);
  execSync(`wp core install --url=${files.readManifest('proxyUrl')} --title=${wpInfo.siteName} --admin_user=${wpInfo.wpUser} --admin_email=${files.readManifest('email')}`, (error, stdout, stderr) => {
    consoleOutput(fgGreen, `  Done!`);
    consoleOutput(fgGreen, '');
  });

  // Try activating the theme
} catch (err) {
  // consoleOutput(fgRed, `${err}`);
  consoleOutput(fgGreen, '');
}

// wp theme activate
try {
  // Now try creating the config (if needed).
  state = '3. WP Theme Activation';
  consoleOutput(fgGreen, `${state}: Activating theme...`);
  execSync(`wp theme activate ${files.readManifest('package')}`, (error, stdout, stderr) => {
    consoleOutput(fgGreen, `  Done!`);
    consoleOutput(fgGreen, '');
  });

  // Try activating the theme
} catch (err) {
  // consoleOutput(fgRed, `${err}`);
  consoleOutput(fgGreen, '');
}

