const fs = require('fs');
const path = require('path');
const replace = require('replace-in-file');
const emoji = require('node-emoji');
const ora = require('ora');
const chalk = require('chalk');
const prompt = require('prompt-sync')();
const {exec} = require('promisify-child-process');

const output = require('./setup/output');

const rootDir = path.join(__dirname, '..');
const capCase = (string) => string.replace(/\W+/g, '_').split('_').map((item) => item[0].toUpperCase() + item.slice(1)).join('_');

const label = (msg) => console.log(chalk.cyan(msg));
const error = (msg) => console.log(`${chalk.bgRed('Error')}${chalk.red(' - ')}${chalk.red(msg)}`);
const log = (msg) => console.log(msg);
const logWithPadding = (msg) => console.log(`    ${msg}`);

/**
 * Performs a wide search & replace. 
 *
 * @param {string} findString 
 * @param {string} replaceString 
 */
const findReplace = async(findString, replaceString) => {
  const regex = new RegExp(findString, 'g');
  const options = {
    files: `${rootDir}/**/*`,
    from: regex,
    to: replaceString,
    ignore: [
      path.join(`${rootDir}/node_modules/**/*`),
      path.join(`${rootDir}/.git/**/*`),
      path.join(`${rootDir}/.github/**/*`),
      path.join(`${rootDir}/vendor/**/*`),
      path.join(`${rootDir}/bin/rename.js`),
      path.join(`${rootDir}/bin/rename-runnable.js`),
      path.join(`${rootDir}/bin/setup.js`),
      path.join(`${rootDir}/bin/setup-wp.js`),
      path.join(`${rootDir}/bin/output.js`),
      path.join(`${rootDir}/bin/files.js`),
    ],
  };

  if (findString !== replaceString) {
    await replace(options);
  }
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

const promptThemeData = () => {
  let confirmed = 'n';
  let newManifest = {};
  
  // -----------------------------
  //  Prompt for project info
  // -----------------------------

  do {
    newManifest.name = promptFor({
      label: `${emoji.get('green_book')} Please enter your theme name (shown in WordPress admin):`,
      prompt: 'Theme name: ',
      error: 'Theme name field is required and cannot be empty.',
      required: true,
    }).trim();

    newManifest.package = promptFor({
      label: `${emoji.get('package')} Please enter your package name (used in translations - lowercase, no special characters, '_' or '-' allowed for spaces):`,
      prompt: 'Package name: ',
      error: 'Package name field is required and cannot be empty.',
      required: true,
    }).replace(/\W+/g, '-').toLowerCase().trim();

    newManifest.prefix = promptFor({
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
    newManifest.url = promptFor({
      label: `${emoji.get('earth_africa')} Please enter a theme development url (for local development with browsersync - no protocol):`,
      prompt: 'Dev url (e.g. dev.wordpress.com): ',
      error: 'Dev url is required and cannot be empty.',
      required: true,
    }).trim();

    
    // Theme description
    newManifest.description = promptFor({
      label: `${emoji.get('spiral_note_pad')}  Please enter your theme description:`,
      prompt: 'Theme description: ',
      required: false,
    }).trim();

    // Author name
    newManifest.author = promptFor({
      label: `${emoji.get('crab')} Please enter author name:`,
      prompt: 'Author name: ',
      required: false,
    }).trim();

    confirmed = output.summary([
      {label: `${emoji.get('green_book')} Theme name`, variable: newManifest.name},
      {label: `${emoji.get('spiral_note_pad')}  Theme description`, variable: newManifest.description},
      {label: `${emoji.get('crab')} Author`, variable: `${newManifest.author}`},
      {label: `${emoji.get('package')} Package`, variable: newManifest.package},
      {label: `${emoji.get('sun_behind_cloud')}  Namespace`, variable: newManifest.namespace},
      {label: `${emoji.get('bullettrain_front')} Theme prefix`, variable: newManifest.prefix},
      {label: `${emoji.get('earth_africa')} Dev url`, variable: newManifest.url},
    ]);
  } while (confirmed !== 'y');

  return newManifest;
};

const replaceThemeData = async (themeData) => {
  
  // Name
  if (themeData.name) {
    await replace({
      files: 'functions.php',
      from: /^ \* Theme Name:.*$/m,
      to: ` * Theme Name: ${themeData.name}`,
    });
    await replace({
      files: 'style.css',
      from: /^Theme Name: .*$/m,
      to: `Theme Name: ${themeData.name}`,
    });
  }

  // Description
  if (themeData.description) {
    await replace({
      files: 'functions.php',
      from: /^ \* Description:.*$/m,
      to: ` * Description: ${themeData.description}`,
    });
    await replace({
      files: 'style.css',
      from: /^Description: .*$/m,
      to: `Description: ${themeData.description}`,
    });
  }

  // Author
  if (themeData.author) {
    await replace({
      files: 'functions.php',
      from: /^ \* Author:.*$/m,
      to: ` * Author: ${themeData.author}`,
    });
    await replace({
      files: 'style.css',
      from: /^Author: .*$/m,
      to: `Author: ${themeData.author}`,
    });
  }

  // Package
  if (themeData.package) {
    await findReplace('ime-teme', themeData.package);
  }

  // Namespace
  if (themeData.namespace) {
    await findReplace('Ime_Teme', themeData.namespace);
  }

  // env
  if (themeData.env) {
    await findReplace('IT_ENV', themeData.env);
  }

  // assetManifest
  if (themeData.manifest) {
    await findReplace('INF_ASSETS_MANIFEST', themeData.manifest);
  }

  // devUrl
  if (themeData.devUrl) {
    await replace({
      files: 'webpack.config.js',
      from: /^const proxyUrl = .*$/m,
      to: `const proxyUrl = '${themeData.devUrl}';`,  
    });
  }
}

run = async() => {

  const themeData = promptThemeData();

  // -----------------------------
  //  1. Replace theme info
  // ----------------------------- 

  const spinnerReplace = ora('1. Replacing theme info').start();
  await replaceThemeData(themeData).then(() => {
    spinnerReplace.succeed();
  }).catch((error) => {
    spinnerReplace.fail(`${spinnerReplace.text}\n${error}`);
    process.exit();
  });

}
run();