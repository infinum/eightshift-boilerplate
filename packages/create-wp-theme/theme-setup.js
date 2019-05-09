#!/usr/bin/env node
/**
 * Run the entire program.
 */

const fs = require('fs-extra');
const path = require('path');
const replace = require('replace-in-file');
const emoji = require('node-emoji');
const ora = require('ora');
const chalk = require('chalk');
const prompt = require('prompt-sync')();
const {exec} = require('promisify-child-process');

const capCase = (string) => string.replace(/\W+/g, '_').split('_').map((item) => item[0].toUpperCase() + item.slice(1)).join('_');

const log = (msg) => console.log(msg);
const variable = (msg) => chalk.green(msg);
const label = (msg) => log(chalk.cyan(msg));
const error = (msg) => log(`${chalk.bgRed('Error')}${chalk.red(' - ')}${msg}`);
const success = (msg) => log(`${chalk.bgGreen(chalk.black(msg))}`);

let fullThemePath = '';

// Handle optional parameter args
const scriptArgs = require('minimist')(process.argv.slice(2));

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
 * Prompts the user for all theme data (doesn't assume almost anything)
 */
const promptThemeData = () => {
  let confirmed = 'n';
  const themeData = {};
  
  // -----------------------------
  //  Prompt for project info
  // -----------------------------

  do {
    themeData.name = promptFor({
      label: `${emoji.get('green_book')} Please enter your theme name (shown in WordPress admin):`,
      prompt: 'Theme name: ',
      error: 'Theme name field is required and cannot be empty.',
    }).trim();

    themeData.package = promptFor({
      label: `${emoji.get('package')} Please enter your package name (used in translations - lowercase, no special characters, '_' or '-' allowed for spaces):`,
      prompt: 'Package name: ',
      error: 'Package name field is required and cannot be empty.',
    }).replace(/\W+/g, '-').toLowerCase().trim();

    themeData.prefix = promptFor({
      label: `${emoji.get('bullettrain_front')} Please enter a theme prefix (used when defining constants - uppercase, no spaces, no special characters):`,
      prompt: 'Prefix (e.g. INF, ABRR): ',
      error: 'Prefix is required and cannot be empty.',
    }).toUpperCase().trim();

    themeData.env = `${themeData.prefix}_ENV`;
    themeData.assetManifest = `${themeData.prefix}_ASSETS_MANIFEST`;

    // Namespace
    themeData.namespace = capCase(themeData.package);
  
    // Dev url
    themeData.url = promptFor({
      label: `${emoji.get('earth_africa')} Please enter a theme development url (for local development with browsersync - no protocol):`,
      prompt: 'Dev url (e.g. dev.wordpress.com): ',
      error: 'Dev url is required and cannot be empty.',
    }).trim();

    
    // Theme description
    themeData.description = promptFor({
      label: `${emoji.get('spiral_note_pad')}  Please enter your theme description:`,
      prompt: 'Theme description: ',
      required: false,
    }).trim();

    // Author name
    themeData.author = promptFor({
      label: `${emoji.get('crab')} Please enter author name:`,
      prompt: 'Author name: ',
    }).trim();

    confirmed = summary([
      {label: `${emoji.get('green_book')} Theme name`, variable: themeData.name},
      {label: `${emoji.get('spiral_note_pad')}  Theme description`, variable: themeData.description},
      {label: `${emoji.get('crab')} Author`, variable: `${themeData.author}`},
      {label: `${emoji.get('package')} Package`, variable: themeData.package},
      {label: `${emoji.get('sun_behind_cloud')}  Namespace`, variable: themeData.namespace},
      {label: `${emoji.get('bullettrain_front')} Theme prefix`, variable: themeData.prefix},
      {label: `${emoji.get('earth_africa')} Dev url`, variable: themeData.url},
    ]);
  } while (confirmed !== 'y');

  return themeData;
};

/**
 * Prompts the user only for theme name, Author name and dev URL, assume or ommit the rest
 */
const promptThemeDataShort = ( {themeName, devUrl, noConfirm} ) => {
  let confirmed = 'n';
  const themeData = {};

  // -----------------------------
  //  Prompt for project info
  // -----------------------------

  do {
    if (!themeName) {
      themeData.name = promptFor({
        label: `${emoji.get('green_book')} Please enter your theme name (shown in WordPress admin):`,
        prompt: 'Theme name: ',
        error: 'Theme name field is required and cannot be empty.',
        minLength: 2,
      }).trim();
    } else {
      themeData.name = themeName;
    }

    // Build package name from theme name
    themeData.package = themeData.name.toLowerCase().split(' ').join('_');

    // Build prefix from theme name using one of 2 methods.
    // 1. If theme name has 2 or mor more words, use first letters of each word
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
      {label: `${emoji.get('green_book')} Theme name`, variable: themeData.name},
      {label: `${emoji.get('package')} Package`, variable: themeData.package},
      {label: `${emoji.get('sun_behind_cloud')}  Namespace`, variable: themeData.namespace},
      {label: `${emoji.get('bullettrain_front')} Theme prefix`, variable: themeData.prefix},
      {label: `${emoji.get('earth_africa')} Dev url`, variable: themeData.url},
    ], noConfirm);
  } while (confirmed !== 'y');

  return themeData;
};

const replaceThemeData = async(themeData) => {
  
  // Name
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

  // Description
  if (themeData.description) {
    await replace({
      files: path.join(fullThemePath, 'functions.php'),
      from: /^ \* Description:.*$/m,
      to: ` * Description: ${themeData.description}`,
    });
    await replace({
      files: path.join(fullThemePath, 'style.css'),
      from: /^Description: .*$/m,
      to: `Description: ${themeData.description}`,
    });
  }

  // Author
  if (themeData.author) {
    await replace({
      files: path.join(fullThemePath, 'functions.php'),
      from: /^ \* Author:.*$/m,
      to: ` * Author: ${themeData.author}`,
    });
    await replace({
      files: path.join(fullThemePath, 'style.css'),
      from: /^Author: .*$/m,
      to: `Author: ${themeData.author}`,
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
  if (path.basename(process.cwd()) !== 'themes') {
    throw new Error('Expected script to be called from WordPress\'s "themes" folder.');
  }

  // Make sure this is in fact a WordPress install
  if (path.basename(path.join(process.cwd(), '..')) !== 'wp-content') {
    throw new Error('This doesn\'t seem to be a WordPress install. Please call the script from "wp-content/themes" folder.');
  }

  // WARNING - Check if composer is installed.
  await exec('composer --version').then(() => {

    // all good.

  }).catch(() => {
    throw new Error('Unable to check Composer\'s version ("composer --version"), please make sure Composer is installed and globally available before running this script.');
  });
};

/**
 * Performns a cleanup after a successfull install.
 */
const cleanup = async() => {
  const packagesPath = path.join(fullThemePath, 'packages');
  const hiddenGitPath = path.join(fullThemePath, '.git');
  const hiddenGithubPath = path.join(fullThemePath, '.github');
  await fs.remove(packagesPath);
  await fs.remove(hiddenGitPath);
  await fs.remove(hiddenGithubPath);
};

const run = async() => {
  
  // Clear console
  process.stdout.write('\033c'); // eslint-disable-line

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
  const newThemeData = promptThemeDataShort(scriptArgs);

  // Globally save the package (because it's also our folder name)
  fullThemePath = path.join(process.cwd(), newThemeData.package);

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
  //  2. Clone repo
  // -----------------------------

  const gitUrl = 'https://github.com/infinum/wp-boilerplate.git';
  let base = 'git clone';

  // Pull from a different branch if specified in parameters
  if (scriptArgs.branch) {
    base += ` -b ${scriptArgs.branch}`;
  }

  const gitClone = `${base} ${gitUrl} "${newThemeData.package}"`;

  const spinnerClone = ora('2. Cloning theme repo').start();
  await exec(`${gitClone} && cd "${fullThemePath}"`).then(() => {
    spinnerClone.succeed();
  }).catch((exception) => {
    spinnerClone.fail();
    error(exception);
    process.exit();
  });

  // -----------------------------
  //  3. Update node dependencies
  // -----------------------------

  const spinnerNode = ora('3. Installing Node dependencies').start();
  await exec(`cd "${fullThemePath}" && npm install`).then(() => {
    spinnerNode.succeed();
  }).catch((exception) => {
    spinnerNode.fail();
    error(exception);
    process.exit();
  });

  // -----------------------------
  //  4. Update Composer dependencies
  // -----------------------------

  const spinnerComposer = ora('4. Installing Composer dependencies').start();
  await exec(`cd "${fullThemePath}" && composer install`).then(() => {
    spinnerComposer.succeed();
  }).catch((exception) => {
    spinnerComposer.fail();
    error(exception);
    process.exit();
  });
  
  // -----------------------------
  //  5. Replace theme info
  // -----------------------------

  const spinnerReplace = ora('5. Replacing theme info').start();
  await replaceThemeData(newThemeData).then(() => {
    spinnerReplace.succeed();
  }).catch((exception) => {
    spinnerReplace.fail();
    error(exception);
    process.exit();
  });

  // -----------------------------
  //  6. Update autoloader
  // -----------------------------

  const spinnerAutoloader = ora('6. Updating composer autoloader').start();
  await exec(`cd "${fullThemePath}" && composer -o dump-autoload`).then(() => {
    spinnerAutoloader.succeed();
  }).catch((exception) => {
    spinnerAutoloader.fail();
    error(exception);
    process.exit();
  });

  // -----------------------------
  //  7. Build assets
  // -----------------------------

  const spinnerBuilt = ora('7. Building assets').start();
  await exec(`cd "${fullThemePath}" && npm run build`).then(() => {
    spinnerBuilt.succeed();
  }).catch((exception) => {
    spinnerBuilt.fail();
    error(exception);
    process.exit();
  });

  // -----------------------------
  //  8. Cleanup
  // -----------------------------

  const spinnerCleanup = ora('8. Cleaning up').start();
  await cleanup().then(() => {
    spinnerCleanup.succeed();
  }).catch((exception) => {
    spinnerCleanup.fail();
    error(exception);
    process.exit();
  });

  // -----------------------------
  //  9. Success
  // -----------------------------

  log('');
  log(`${emoji.get('tada')}${emoji.get('tada')}${emoji.get('tada')} Your theme is now ready! ${emoji.get('tada')}${emoji.get('tada')}${emoji.get('tada')}`);
  log('');
  log(`Please go to theme's folder (${variable(`cd ${newThemeData.package}`)}) and run ${variable('npm start')} to start developing.`);
  log('');
  log(chalk.red('---------------------------------------------------------------'));
};
run();
