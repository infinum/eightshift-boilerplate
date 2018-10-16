#!/usr/bin/env node

const fs = require('fs');
const path = require('path');
const prompt = require('prompt-sync')();
const files = require('./files');
const {exec} = require('promisify-child-process');
const output = require('./output');
const emoji = require('node-emoji');
const ora = require('ora');
const chalk = require('chalk');
const wpInstaller = require('./wp-installer');
const rename = require('./rename');

const capCase = (string) => string.replace(/\W+/g, '_').split('_').map((item) => item[0].toUpperCase() + item.slice(1)).join('_');

const run = async() => {

  // Main script
  output.writeIntro();

  // Get manifest data. Prompt for new data and read old data from theme-manifest.json
  const newManifest = rename.promptThemeData();
  const oldManifest = files.readManifestFull();

  output.normal('--------------------------------------------------');
  output.normal('');
  output.normal('    Great! We have everything we need for now,    ');
  output.normal('    we\'ll start setting up your project...       ');
  output.normal('');
  output.normal('--------------------------------------------------');
  output.normal('');

  // -----------------------------
  //  Rename files
  // -----------------------------

  const spinnerRename = ora('1. Renaming files (this might take some time)').start();
  await files.renameAllFiles(oldManifest, newManifest).then(() => {
    spinnerRename.succeed();
  }).catch((error) => {
    spinnerRename.fail(`${spinnerRename.text}\n${error}`);
    process.exit();
  });

  // Write the new manifest only after we've replaced everything.
  fs.writeFile(files.manifest, JSON.stringify(newManifest, null, 2), 'utf8', () => {});

  // -----------------------------
  //  Update Composer dependencies
  // -----------------------------

  const spinnerComposer = ora('2. Updating composer').start();
  await exec('npx composer update').then(() => {
    spinnerComposer.succeed();
  }).catch((error) => {
    spinnerComposer.fail(`${spinnerComposer.text}\n${error}`);
    process.exit();
  });
  
  // ----------------------------------------------------
  //  Check if wp-cli works
  //
  //  If not, download wp-cli phar and make all following 
  //  wp commands use 'php wp-cli.phar ...'
  //  instead of 'wp ...' 
  // -------------------------------------------------
  
  const spinnerWpCli = ora('3. Checking if wp-cli works').start();
  let wpCli = 'wp';
  await exec('wp --info').then(() => {
    spinnerWpCli.succeed();
  }).catch( async() => {
    spinnerWpCli.text = '3. Installing wp-cli';
    await exec('curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && php wp-cli.phar --info').then(() => {
      spinnerWpCli.succeed();
      wpCli = 'php wp-cli.phar';
    }).catch((error) => {
      spinnerWpCli.fail(`${spinnerWpCli.text}\n${error}`);
      process.exit();
    });
  });
  
  // -----------------------------
  //  Install WP Core
  // -----------------------------

  const spinnerWpCore = ora('4. Installing WordPress Core').start();
  await exec(`${wpCli} core download --skip-content`).then(() => {
    spinnerWpCore.succeed();
  }).catch((error) => {
    spinnerWpCore.fail(`${spinnerWpCore.text}\n${error}`);
    process.exit();
  });
  
  // -----------------------------
  //  Prompt for local dev env.
  // -----------------------------

  wpInstaller.intro(newManifest.url);
  wpInstaller.selectEnv();
};
run();
