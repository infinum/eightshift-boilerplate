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



const capCase = (string) => string.replace(/\W+/g, '_').split('_').map((item) => item[0].toUpperCase() + item.slice(1)).join('_');

const run = async() => {

  // Main script
  output.writeIntro();

  let confirmed = 'n';
  const newManifest = {};
  
  // -----------------------------
  //  Prompt for project info
  // -----------------------------
  
  do {
    newManifest.name = output.prompt({
      label: '1. Please enter your theme name (shown in WordPress admin)*:',
      prompt: `${emoji.get('green_book')} Theme name: `,
      error: 'Theme name field is required and cannot be empty.',
      required: true,
    }).trim();

    newManifest.package = output.prompt({
      label: '2. Please enter your package name (used in translations - ' +
      'lowercase, no special characters, \'_\' or \'-\' allowed for spaces)*:',
      prompt: `${emoji.get('package')} Package name: `,
      error: 'Package name field is required and cannot be empty.',
      required: true,
    }).replace(/\W+/g, '-').toLowerCase().trim();

    newManifest.prefix = output.prompt({
      label: '3. Please enter a theme prefix (used when defining constants - ' +
      'uppercase, no spaces, no special characters)*:',
      prompt: `${emoji.get('bullettrain_front')} Prefix (e.g. INF, ABRR): `,
      error: 'Prefix is required and cannot be empty.',
      required: true,
    }).toUpperCase().trim();

    newManifest.env = `${newManifest.prefix}_ENV`;
    newManifest.assetManifest = `${newManifest.prefix}_ASSETS_MANIFEST`;

    // Namespace
    newManifest.namespace = capCase(newManifest.package);

    // Dev url
    newManifest.url = output.prompt({
      label: '4. Please enter a theme development url (for local development with browsersync -  ' +
      'no protocol)*:',
      prompt: `${emoji.get('earth_africa')} Dev url (e.g. dev.wordpress.com): `,
      error: 'Dev url is required and cannot be empty.',
      required: true,
    }).trim();

    // Theme description
    newManifest.description = output.prompt({
      label: '5. Please enter your theme description:',
      prompt: `${emoji.get('spiral_note_pad')}  Theme description: `,
      required: false,
    }).trim();

    // Author name
    newManifest.author = output.prompt({
      label: '6. Please enter author name:',
      prompt: `${emoji.get('crab')} Author name: `,
      required: false,
    }).trim();

    // Author email
    newManifest.email = output.prompt({
      label: '7. Please enter author email:',
      prompt: `${emoji.get('email')}  Author email: `,
      required: false,
    }).trim();

    confirmed = output.summary([
      {label: `${emoji.get('green_book')} Theme name`, variable: newManifest.name},
      {label: `${emoji.get('spiral_note_pad')}  Theme description`, variable: newManifest.description},
      {label: `${emoji.get('crab')} Author`, variable: `${newManifest.author} <${newManifest.email}>`},
      {label: `${emoji.get('package')} Package`, variable: newManifest.package},
      {label: `${emoji.get('sun_behind_cloud')}  Namespace`, variable: newManifest.namespace},
      {label: `${emoji.get('bullettrain_front')} Theme prefix`, variable: newManifest.prefix},
      {label: `${emoji.get('earth_africa')} Dev url`, variable: newManifest.url},
    ]);
  } while (confirmed !== 'y');

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

  const spinnerRename = ora('1. Replacing files (this might take some time)').start();
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
