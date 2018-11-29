#!/usr/bin/env node
/**
 * Run the entire program.
 */

const path = require('path');
const replace = require('replace-in-file');
const emoji = require('node-emoji');
const ora = require('ora');
const chalk = require('chalk');
const prompt = require('prompt-sync')();
const {exec} = require('promisify-child-process');

const log = (msg) => console.log(msg);
const variable = (msg) => chalk.green(msg);
const label = (msg) => log(chalk.cyan(msg));
const error = (msg) => log(`${chalk.bgRed('Error')}${chalk.red(' - ')}${msg}`);
const success = (msg) => log(`${chalk.bgGreen(chalk.black(msg))}`);

let themeName = '';
let fullThemePath = '';

/**
 * Performs a wide search & replace.
 *
 * @param {string} findString
 * @param {string} replaceString
 */
const findReplace = async(findString, replaceString) => {
  const regex = new RegExp(findString, 'g');
  const options = {
    files: `${fullThemePath}/**/*`,
    from: regex,
    to: replaceString,
    ignore: [
      path.join(`${fullThemePath}/node_modules/**/*`),
      path.join(`${fullThemePath}/.git/**/*`),
      path.join(`${fullThemePath}/.github/**/*`),
      path.join(`${fullThemePath}/vendor/**/*`),
      path.join(`${fullThemePath}/packages/**/*`),
      path.join(`${fullThemePath}/bin/rename.js`),
      path.join(`${fullThemePath}/bin/rename-runnable.js`),
      path.join(`${fullThemePath}/bin/setup.js`),
      path.join(`${fullThemePath}/bin/setup-wp.js`),
      path.join(`${fullThemePath}/bin/output.js`),
      path.join(`${fullThemePath}/bin/files.js`),
      path.join(`${fullThemePath}/bin/theme-setup.js`),
      path.join(`${fullThemePath}/bin/test.js`),
    ],
  };

  if (findString !== replaceString) {
    await replace(options);
  }
};

/**
 * Writes a summary of selected values and asks for user confirmation that info is ok
 *
 * @param array lines
 */
const summary = (lines) => {
  success('');
  success('Your details will be:');
  lines.forEach((line) => log(`${chalk(line.label)}: ${chalk.green(line.variable)}`));
  success('');
  const confirm = prompt('Confirm (y/n)? ');
  success('');

  if (confirm === 'exit') {
    process.exit();
  }

  return confirm;
};

/**
 * Prompts a user for something
 *
 * @param {object} settings
 */
const promptFor = (settings) => {
  settings.minLength = settings.minLength || 0;
  let userInput;
  label(settings.label);
  do {
    userInput = prompt(settings.prompt);

    if (userInput.length <= settings.minLength) {
      error(settings.error);
    }
  }
  while (userInput.length <= settings.minLength && userInput !== 'exit');
  label('');
  if (userInput === 'exit') {
    log('Exiting script...');
    process.exit();
  }

  return userInput;
};

/**
 * Prompts the user only for theme name, Author name and dev URL, assume or ommit the rest
 */
const promptThemeDataShort = () => {
  let confirmed = 'n';
  const themeData = {};
  
  do {

    // Dev url
    themeData.url = promptFor({
      label: `${emoji.get('earth_africa')} Please enter a theme development url (for local development with browsersync - no protocol):`,
      prompt: 'Dev url (e.g. dev.wordpress.com): ',
      error: 'Dev url is required and cannot be empty.',
    }).trim();

    confirmed = summary([
      {label: `${emoji.get('earth_africa')} Dev url`, variable: themeData.url},
    ]);
  } while (confirmed !== 'y');

  return themeData;
};

const replaceThemeData = async(themeData) => {

  // BrowserSync proxy url.
  if (themeData.url) {
    await replace({
      files: path.join(fullThemePath, 'webpack.config.js'),
      from: /^const proxyUrl = .*$/m,
      to: `const proxyUrl = '${themeData.url}';`,
    });
  }
};

/**
 * Runs before the setup for some sanity checks. (Are we in the right folder + is Composer
 * installed and available as `composer` command)
 */
const preFlightChecklist = async() => {

  // Make sure the user has called the script from wp-content/themes folder.
  if (path.basename(process.cwd()) !== themeName) {
    throw new Error(`Expected script to be called from theme's folder "wp-content/themes/${themeName}"`);
  }

  // Make sure this is in fact a WordPress install
  if (
    path.basename(path.join(process.cwd(), '..')) !== 'themes' ||
    path.basename(path.join(process.cwd(), '..', '..')) !== 'wp-content'
  ) {
    throw new Error('This doesn\'t seem to be a WordPress install. Please call the script from "wp-content/themes" folder.');
  }

  // WARNING - Check if composer is installed.
  await exec('composer --version').then(() => {

    // all good.

  }).catch(() => {
    throw new Error('Unable to check Composer\'s version ("composer --version"), please make sure Composer is installed and globally available before running this script.');
  });
};

const run = async() => {
  
  // Clear console
  // process.stdout.write('\033c'); // eslint-disable-line

  // Write intro
  log(chalk.red('---------------------------------------------------------------'));
  log(chalk.red(''));
  log(chalk.red('    _ _ _ ___ '));
  log(chalk.red('    | | | |__| '));
  log(chalk.red('    |_|_| |   '));
  log(chalk.red('    ___  ____ _ _    ____ ____ ___       ____ ___ ____ '));
  log(chalk.red('    |__| |  | | |    |___ |__/ |__| |    |__|  |  |___ '));
  log(chalk.red('    |__| |__| | |___ |___ |  \\ |    |___ |  |  |  |___ '));
  log(chalk.red(''));
  log(chalk.red(''));
  log('    Welcome to Boilerplate setup script for your theme!');
  log(chalk.red(''));
  log('    This script will uniquely set up your theme.');
  log(chalk.red(''));
  log(chalk.red(''));

  // Prompt user for all user data.
  const newThemeData = promptThemeDataShort();

  // Globally save the package (because it's also our folder name)
  fullThemePath = path.join(process.cwd());
  themeName = path.basename(fullThemePath);

  log('Let\'s get started, it might take a while...');
  log('');

  // -----------------------------
  //  1. Preflight checklist
  // -----------------------------

  const spinnerChecklist = ora('1. Pre-flight checklist').start();
  await preFlightChecklist().then(() => {
    spinnerChecklist.succeed();
  }).catch((exception) => {
    spinnerChecklist.fail();
    error(exception);
    process.exit();
  });

  // -----------------------------
  //  2. Replace BrowserSync dev url
  // -----------------------------

  const spinnerReplace = ora('2. Replacing BrowserSync dev url').start();
  await replaceThemeData(newThemeData).then(() => {
    spinnerReplace.succeed();
  }).catch((exception) => {
    spinnerReplace.fail();
    error(exception);
    process.exit();
  });

  // -----------------------------
  //  3. Update Composer dependencies
  // -----------------------------

  const spinnerComposer = ora('3. Installing Composer dependencies').start();
  await exec('composer install').then(() => {
    spinnerComposer.succeed();
  }).catch((exception) => {
    spinnerComposer.fail();
    error(exception);
    process.exit();
  });

  // -----------------------------
  //  4. Update autoloader
  // -----------------------------

  const spinnerAutoloader = ora('4. Updating composer autoloader').start();
  await exec(`composer -o dump-autoload`).then(() => {
    spinnerAutoloader.succeed();
  }).catch((exception) => {
    spinnerAutoloader.fail();
    error(exception);
    process.exit();
  });

  // -----------------------------
  //  5. Build assets
  // -----------------------------

  const spinnerBuilt = ora('5. Building assets').start();
  await exec('npm run build').then(() => {
    spinnerBuilt.succeed();
  }).catch((exception) => {
    spinnerBuilt.fail();
    error(exception);
    process.exit();
  });

  // -----------------------------
  //  5. Success
  // -----------------------------

  log('');
  log(`${emoji.get('tada')}${emoji.get('tada')}${emoji.get('tada')} Your theme is now ready! ${emoji.get('tada')}${emoji.get('tada')}${emoji.get('tada')}`);
  log('');
  log(`Please run ${variable('npm start')} to start developing.`);
  log('');
  log(chalk.red('---------------------------------------------------------------'));
};
run();
