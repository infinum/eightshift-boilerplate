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
const { exec } = require('promisify-child-process');

const capCase = (string) => string.replace(/\W+/g, '_').split('_').map((item) => item[0].toUpperCase() + item.slice(1)).join('_');

const log = (msg) => console.log(msg);
const variable = (msg) => chalk.green(msg);
const label = (msg) => log(chalk.cyan(msg));
const error = (msg) => log(`${chalk.bgRed('Error')}${chalk.red(' - ')}${msg}`);
const success = (msg) => log(`${chalk.bgGreen(chalk.black(msg))}`);

let themeName = '';
let fullThemePath = '';

// Handle optional parameter args
const scriptArgs = require('minimist')(process.argv.slice(2));

/**
 * Performs a wide search & replace.
 *
 * @param {string} findString
 * @param {string} replaceString
 */
const findReplace = async (findString, replaceString) => {
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
const summary = (lines, noConfirm) => {
  success('');
  success('Your details will be:');
  lines.forEach((line) => log(`${chalk(line.label)}: ${chalk.green(line.variable)}`));
  success('');

  let confirm;
  if (noConfirm) {
    confirm = 'y';
  } else {
    confirm = prompt('Confirm (y/n)? ');
  }

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
const promptThemeDataShort = ({ devUrl, noConfirm }) => {
  let confirmed = 'n';
  const themeData = {};

  do {

    // Dev url
    if (!devUrl) {
      themeData.url = promptFor({
        label: `${emoji.get('earth_africa')} Please enter a theme development url (for local development with browsersync - no protocol):`,
        prompt: 'Dev url (e.g. dev.wordpress.com): ',
        error: 'Dev url is required and cannot be empty.',
      }).trim();
    } else {
      themeData.url = devUrl;
    }

    confirmed = summary([
      { label: `${emoji.get('earth_africa')} Dev url`, variable: themeData.url },
    ], noConfirm);
  } while (confirmed !== 'y');

  return themeData;
};

/**
 * Prompts the user for all theme data (doesn't assume almost anything)
 */
const promptThemeData = ({ themeName, devUrl, noConfirm }) => {
  let confirmed = 'n';
  const themeData = {};

  // -----------------------------
  //  Prompt for project info
  // -----------------------------

  do {
    themeData.name = themeName;

    if (!themeName) {
      themeData.name = promptFor({
        label: `${emoji.get('green_book')} Please enter your theme name (shown in WordPress admin):`,
        prompt: 'Theme name: ',
        error: 'Theme name field is required and cannot be empty.',
        minLength: 2,
      }).trim();
    }

    // Build package name from theme name
    themeData.package = themeData.name.toLowerCase().split(' ').join('_');
    themeData.folderName = themeData.name.toLowerCase().split(' ').join('-');

    // Build prefix from theme name using one of 2 methods...
    // 1. If theme name has 2 or more words, use first letters of each word
    themeData.prefix = '';
    const themeNameWords = themeData.name.split(' ');
    if (themeNameWords && themeNameWords.length >= 2) {
      for (const word of themeNameWords) {
        themeData.prefix += word.charAt(0).toUpperCase();
      }
    }

    // 2. If theme has only 1 word, use the first 3 letters of theme name
    if (themeData.prefix.length < 2 && themeData.name.length > 2) {
      themeData.prefix = (`${themeData.name.charAt(0)}${themeData.name.charAt(1)}${themeData.name.charAt(2)}`).toUpperCase();
    }

    themeData.env = `${themeData.prefix}_ENV`;
    themeData.assetManifest = `${themeData.prefix}_ASSETS_MANIFEST`;

    // Namespace
    themeData.namespace = capCase(themeData.package);

    // Dev url
    themeData.url = devUrl;
    if (!devUrl) {
      themeData.url = promptFor({
        label: `${emoji.get('earth_africa')} Please enter a theme development url (for local development with browsersync - no protocol):`,
        prompt: 'Dev url (e.g. dev.wordpress.com): ',
        error: 'Dev url is required and cannot be empty.',
      }).trim();
    }

    confirmed = summary([
      {label: `${emoji.get('green_book')} Theme name`, variable: themeData.name},
      {label: `${emoji.get('package')} Package`, variable: themeData.package},
      {label: `${emoji.get('sun_behind_cloud')}  Namespace`, variable: themeData.namespace},
      {label: `${emoji.get('bullettrain_front')} Theme prefix`, variable: themeData.prefix},
      {label: `${emoji.get('earth_africa')} Dev url`, variable: themeData.url},
    ], noConfirm);
  } while (confirmed !== 'y');

  return themeData;
};


const replaceThemeData = async (themeData, replaceAll = false) => {

  // Name
  if (replaceAll) {
    if (themeData.name) {
      await replace({
        files: path.join(fullThemePath, 'functions.php'),
        from: /^ \* Theme Name:.*$/m,
        to: ` * Theme Name: ${themeData.name}`,
      });
      await replace({
        files: path.join(fullThemePath, 'style.css'),
        from: /^Theme Name: .*$/m,
        to: `Theme Name: ${themeData.name}`,
      });
    }

    // Package
    if (themeData.package) {
      await findReplace('inf_theme', themeData.package);
    }

    // Namespace
    if (themeData.namespace) {
      await findReplace('Inf_Theme', themeData.namespace);
    }

    // env
    if (themeData.env) {
      await findReplace('INF_ENV', themeData.env);
    }

    // assetManifest
    if (themeData.manifest) {
      await findReplace('INF_ASSETS_MANIFEST', themeData.manifest);
    }
  }


  // BrowserSync proxy url.
  if (themeData.url) {
    await replace({
      files: path.join(fullThemePath, 'webpack', 'config.js'),
      from: /proxyUrl: .*$/m,
      to: `proxyUrl: '${themeData.url}',`,
    });
  }

  // Config data in webpack
  if (themeData.folderName) {
    await replace({
      files: path.join(fullThemePath, 'webpack', 'config.js'),
      from: 'wp-content/themes/wp-boilerplate',
      to: `wp-content/themes/${themeData.folderName}`,
    });
  }
};

/**
 * Runs before the setup for some sanity checks. (Are we in the right folder + is Composer
 * installed and available as `composer` command)
 */
const preFlightChecklist = async () => {

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

const run = async () => {

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
  let newThemeData;
  if (scriptArgs.replaceThemeInfo) {
    newThemeData = promptThemeData(scriptArgs);
  } else {
    newThemeData = promptThemeDataShort(scriptArgs);
  }

  // Globally save the package (because it's also our folder name)
  fullThemePath = path.join(process.cwd());
  themeName = path.basename(fullThemePath);

  log('Let\'s get started, it might take a while...');
  log('');

  // -----------------------------
  //  1. Preflight checklist
  // -----------------------------

  if (scriptArgs.skipChecklist) {
    ora('1. Skipping Pre-flight checklist').start().succeed();
  } else {
    const spinnerChecklist = ora('1. Pre-flight checklist').start();
    await preFlightChecklist().then(() => {
      spinnerChecklist.succeed();
    }).catch((exception) => {
      spinnerChecklist.fail();
      error(exception);
      process.exit();
    });
  }

  // -----------------------------
  //  2. Replace BrowserSync dev url
  // -----------------------------

  // If requested, replace all theme info. Otherwise just the BrowserSync proxyUrl
  if (scriptArgs.replaceThemeInfo) {
    const spinnerReplace = ora('2. Replacing theme info').start();
    await replaceThemeData(newThemeData, true).then(() => {
      spinnerReplace.succeed();
    }).catch((exception) => {
      spinnerReplace.fail();
      error(exception);
      process.exit();
    });
  } else {
    const spinnerReplace = ora('2. Replacing BrowserSync dev url').start();
    await replaceThemeData(newThemeData).then(() => {
      spinnerReplace.succeed();
    }).catch((exception) => {
      spinnerReplace.fail();
      error(exception);
      process.exit();
    });
  }

  // -----------------------------
  //  3. Update Composer dependencies
  // -----------------------------

  const spinnerComposer = ora('3. Installing Composer dependencies').start();
  await exec('composer install --ignore-platform-reqs').then(() => {
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
  await exec('composer -o dump-autoload').then(() => {
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
  //  6. Replace theme info (optional)
  // -----------------------------

  if (scriptArgs.replaceThemeInfo) {
    const spinnerReplace = ora('6. Replacing theme info').start();
    await replaceThemeData(newThemeData, true).then(() => {
      spinnerReplace.succeed();
    }).catch((exception) => {
      spinnerReplace.fail();
      error(exception);
      process.exit();
    });
  }

  // -----------------------------
  //  7. Success
  // -----------------------------

  log('');
  log(`${emoji.get('tada')}${emoji.get('tada')}${emoji.get('tada')} Your theme is now ready! ${emoji.get('tada')}${emoji.get('tada')}${emoji.get('tada')}`);
  log('');
  log(`Please run ${variable('npm start')} to start developing.`);
  log('');
  log(chalk.red('---------------------------------------------------------------'));
};
run();
