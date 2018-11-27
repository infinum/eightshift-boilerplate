const fs = require('fs');
const path = require('path');
const replace = require('replace-in-file');
const emoji = require('node-emoji');
const ora = require('ora');
const chalk = require('chalk');
const prompt = require('prompt-sync')();
const {exec} = require('promisify-child-process');

const rootDir = path.join(__dirname, '..');

// Define the theme.
const label = (msg) => console.log(chalk.cyan(msg));
const error = (msg) => console.log(`${chalk.bgRed('Error')}${chalk.red(' - ')}${chalk.red(msg)}`);
const log = (msg) => console.log(msg);
const logWithPadding = (msg) => console.log(`    ${msg}`);

/**
 * Replaces the Browser Sync dev url variable value.
 * 
 * @param {string} newDevUrl 
 */
const findReplace = async(newDevUrl) => {
  const options = {
    files: 'webpack.config.js',
    from: /^const proxyUrl = .*$/m,
    to: `const proxyUrl = '${newDevUrl}';`,
  };

  await replace(options);
};

/**
 * Prompts a user for something. 
 *
 * @param {object} settings 
 */
const promptFor = (settings) => {
  let userInput;
  label(settings.label);
  do {
    userInput = prompt(settings.prompt);

    if (userInput.length <= 0) {
      error(settings.error);
    }
  }
  while (userInput.length <= 0 && userInput !== 'exit');
  label('');
  if (userInput === 'exit') {
    log('Exiting script...');
    process.exit();
  }

  return userInput;
};

promptThemeData = () => {
  let confirmed = 'n';
  let newManifest = {};
  
  // -----------------------------
  //  Prompt for project info
  // -----------------------------
  
  do {
    newManifest.name = output.prompt({
      label: `${emoji.get('green_book')} Please enter your theme name (shown in WordPress admin):`,
      prompt: 'Theme name: ',
      error: 'Theme name field is required and cannot be empty.',
      required: true,
    }).trim();

    newManifest.package = output.prompt({
      label: `${emoji.get('package')} Please enter your package name (used in translations - lowercase, no special characters, '_' or '-' allowed for spaces):`,
      prompt: 'Package name: ',
      error: 'Package name field is required and cannot be empty.',
      required: true,
    }).replace(/\W+/g, '-').toLowerCase().trim();

    newManifest.prefix = output.prompt({
      label: `${emoji.get('bullettrain_front')} Please enter a theme prefix (used when defining constants - uppercase, no spaces, no special characters):`,
      prompt: 'Prefix (e.g. INF, ABRR): ',
      error: 'Prefix is required and cannot be empty.',
      required: true,
    }).toUpperCase().trim();

    newManifest.env = `${newManifest.prefix}_ENV`;
    newManifest.assetManifest = `${newManifest.prefix}_ASSETS_MANIFEST`;

    // Namespace
    newManifest.namespace = capCase(newManifest.package);

    // Dev url
    newManifest.url = output.prompt({
      label: `${emoji.get('earth_africa')} Please enter a theme development url (for local development with browsersync - no protocol):`,
      prompt: 'Dev url (e.g. dev.wordpress.com): ',
      error: 'Dev url is required and cannot be empty.',
      required: true,
    }).trim();

    // Theme description
    newManifest.description = output.prompt({
      label: `${emoji.get('spiral_note_pad')}  Please enter your theme description:`,
      prompt: 'Theme description: ',
      required: false,
    }).trim();

    // Author name
    newManifest.author = output.prompt({
      label: `${emoji.get('crab')} Please enter author name:`,
      prompt: 'Author name: ',
      required: false,
    }).trim();

    // Author email
    newManifest.email = output.prompt({
      label: `${emoji.get('email')}  Please enter author email:`,
      prompt: 'Author email: ',
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

  return newManifest;
};

replaceThemeData = async (themeData) => {
  
  // Name
  if (themeData.name) {
    await replace({
      files: 'functions.php',
      from: /^ * Theme Name: .*$/m,
      to: ` * Theme Name: '${themeData.name}';`,
    });
    await replace({
      files: 'style.css',
      from: /^Theme Name: .*$/m,
      to: `Theme Name: '${themeData.name}';`,
    });
  }

  // Description
  // Author
  // Package
  // Namespace
  // env
  // assetManifest
  // devUrl
  // email
}

const run = async() => {
  
  // Clear console
  process.stdout.write('\033c');

  // Write intro
  console.log(chalk.red('---------------------------------------------------------------'));
  console.log(chalk.red(''));
  console.log(chalk.red('    _ _ _ ___ '));
  console.log(chalk.red('    | | | |__| '));
  console.log(chalk.red('    |_|_| |   '));
  console.log(chalk.red('    ___  ____ _ _    ____ ____ ___       ____ ___ ____ '));
  console.log(chalk.red('    |__| |  | | |    |___ |__/ |__| |    |__|  |  |___ '));
  console.log(chalk.red('    |__| |__| | |___ |___ |  \\ |    |___ |  |  |  |___ '));
  console.log(chalk.red(''));
  console.log(chalk.red(''));
  console.log('    Welcome to Boilerplate setup script for your theme!');
  console.log(chalk.red(''));
  console.log('    This script will uniquely set up your theme.');
  console.log(chalk.red(''));
  console.log(chalk.red(''));

  // Prompt user for all user data.
  newThemeData = promptThemeData();

  // Prompt user for dev url (used for browsersync).
  // const devUrl = promptFor({
  //   label: `${emoji.get('earth_africa')} Please enter your development url, without protocol (for local development with browsersync):`,
  //   prompt: 'Dev url (e.g. dev.wordpress.com): ',
  //   error: 'Dev url is required and cannot be empty.',
  //   required: true,
  // }).trim();

  console.log('Let\'s get started...');
  console.log('');

  // -----------------------------
  //  1. Replace theme info
  // ----------------------------- 

  const spinnerReplace = ora('1. Replacing theme info').start();
  await replaceThemeData().then(() => {
    spinnerReplace.succeed();
  }).catch((error) => {
    spinnerReplace.fail(`${spinnerReplace.text}\n${error}`);
    process.exit();
  });

  // -----------------------------
  //  2. Update Composer dependencies
  // -----------------------------

  const spinnerComposer = ora('2. Installing composer dependencies').start();
  await exec('composer install').then(() => {
    spinnerComposer.succeed();
  }).catch((error) => {
    spinnerComposer.fail(`${spinnerComposer.text}\n${error}`);
    process.exit();
  });

  // -----------------------------
  //  3. Build assets
  // -----------------------------

  const spinnerBuilt = ora('3. Building assets').start();
  await exec('npm run build').then(() => {
    spinnerBuilt.succeed();
  }).catch((error) => {
    spinnerBuilt.fail(`${spinnerBuilt.text}\n${error}`);
    process.exit();
  });

  // -----------------------------
  //  4. Success
  // -----------------------------

  console.log('');
  console.log(`${emoji.get('tada')}${emoji.get('tada')}${emoji.get('tada')} Your theme is now ready! ${emoji.get('tada')}${emoji.get('tada')}${emoji.get('tada')}`);
  console.log('');
  console.log(`Please run ${chalk.green('npm start')} in current folder to start developing.`);
  console.log('');
  console.log(chalk.red('---------------------------------------------------------------'));
}
run();