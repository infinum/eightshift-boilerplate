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

  const newManifest = rename.promptThemeData();

  // Read info from the old manifest (needles we're replacing in haystack)
  let oldManifest;
  if (fs.existsSync(files.manifest)) {
    oldManifest = JSON.parse(fs.readFileSync(files.manifest, 'utf8'));
  }

  output.dim('--------------------------------------------------');
  output.dim('');
  output.dim('    Great! We have everything we need for now,    ');
  output.dim('    we\'ll start setting up your project...       ');
  output.dim('');
  output.dim('--------------------------------------------------');
  output.dim('');

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
  
  // -----------------------------
  //  Install WP Core
  // -----------------------------

  const spinnerWpCore = ora('3. Installing WP Core').start();
  await exec('wp core download --skip-content').then(() => {
    spinnerWpCore.succeed();
  }).catch((error) => {
    spinnerWpCore.fail(`${spinnerWpCore.text}\n${error}`);
    process.exit();
  });
  
  // -----------------------------
  //  Prompt for local dev env.
  // -----------------------------

  console.log('');
  console.log(chalk.red('-----------------------------------------------------------------'));
  console.log('');
  console.log(chalk.dim('    Congratulations!'));
  console.log('');
  console.log(chalk.dim('    Your project is setup and ALMOST ready to use,'));
  console.log(chalk.dim(`    all we need to do now is ${chalk.bgGreen.black('setup WordPress')}.`));
  console.log('');
  console.log(chalk.dim('    You can set it up manually with the usual WP'));
  console.log(chalk.dim('    setup configuration wizard by going to your local'));
  console.log(`    ${chalk.dim('dev url:')} ${chalk.green(newManifest.url)}`);
  console.log('');
  console.log(chalk.dim('    However, we might be able to do it for you'));
  console.log(chalk.dim('    depending on your local dev environment...'));
  console.log('');
  console.log(chalk.cyan('    Options:'));
  console.log('    1) Varying Vagrant Vagrants');
  console.log('    2) Anything else');
  console.log('    3) Thx but no thx, I\'ll setup WP manually');
  console.log('');

  // Verify option
  let isValid = true;
  do {
    const selectedDevEnv = prompt('    Select option: ');
    console.log('');
    switch (selectedDevEnv) {
      case '1':
        isValid = true;
        wpInstaller.vvv();
        break;
      case '2':
        isValid = true;
        wpInstaller.manual();
        break;
      case '3':
        isValid = true;
        wpInstaller.manual();
        break;
      case 'exit':
        process.exit();
        break;
      default:
        isValid = false;
        output.error('Please input the number corresponding to your desired choice.');
    }
  } while (!isValid);
};
run();
