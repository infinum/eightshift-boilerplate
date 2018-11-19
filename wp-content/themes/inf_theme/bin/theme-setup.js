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
  writeIntro();

  // Prompt user for dev url (used for browsersync).
  const devUrl = promptFor({
    label: `${emoji.get('earth_africa')} Please enter your development url, without protocol (for local development with browsersync):`,
    prompt: 'Dev url (e.g. dev.wordpress.com): ',
    error: 'Dev url is required and cannot be empty.',
    required: true,
  }).trim();

  console.log('Let\'s get started...');
  console.log('');

  // -----------------------------
  //  1. Rename dev url
  // ----------------------------- 

  const spinnerRename = ora('1. Renaming dev url').start();
  await findReplace('one.wordpress.test').then(() => {
    spinnerRename.succeed();
  }).catch((error) => {
    spinnerRename.fail(`${spinnerRename.text}\n${error}`);
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