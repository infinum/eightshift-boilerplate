const output = require('./output');
const emoji = require('node-emoji');
const ora = require('ora');
const inquirer = require('inquirer');
const chalk = require('chalk');

const capCase = (string) => string.replace(/\W+/g, '_').split('_').map((item) => item[0].toUpperCase() + item.slice(1)).join('_');

exports.promptThemeData = () => {
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
  
 /*
  do {
    const questions = [
      {
        type: 'input',
        name: 'name',
        message: '1. Please enter your theme name (shown in WordPress admin)*:\nTheme name:',
        filter: (val) => val.trim(),
        transformer: (value) => chalk.green(value),
        suffix: '\n',
      },
      {
        type: 'input',
        name: 'package',
        message: '2. Please enter your package name (used in translations - ' +
        'lowercase, no special characters, \'_\' or \'-\' allowed for spaces)*:\nPackage name:',
        filter: (val) => val.replace(/\W+/g, '-').toLowerCase().trim(),
        transformer: (value) => chalk.green(value),
        suffix: '\n',
      },
      {
        type: 'input',
        name: 'prefix',
        message: '3. Please enter a theme prefix (used when defining constants - ' +
        'uppercase, no spaces, no special characters)*:\nTheme prefix:',
        filter: (val) => val.toUpperCase().trim(),
        transformer: (value) => chalk.green(value),
        suffix: '\n',
      },
      {
        type: 'input',
        name: 'url',
        message: '4. Please enter a theme development url (for local development with browsersync -  ' +
        'no protocol)*:\nTheme dev url:',
        filter: (val) => val.trim(),
        transformer: (value) => chalk.green(value),
        suffix: '\n',
      },
      {
        type: 'input',
        name: 'description',
        message: '5. Please enter your theme description:\nTheme description:',
        filter: (val) => val.trim(),
        transformer: (value) => chalk.green(value),
      },
      {
        type: 'input',
        name: 'author',
        message: '6. Please enter author name:\nAuthor name:',
        filter: (val) => val.trim(),
        transformer: (value) => chalk.green(value),
      },
      {
        type: 'input',
        name: 'email',
        message: '7. Please enter author email:\nAuthor email:',
        filter: (val) => val.trim(),
        transformer: (value) => chalk.green(value),
      },
    ];

    await inquirer.prompt(questions).then((answers) => {
      newManifest = answers;
      newManifest.env = `${answers.prefix}_ENV`;
      newManifest.assetManifest = `${answers.prefix}_ASSETS_MANIFEST`;
      console.log('\nOrder receipt:');
      console.log(JSON.stringify(answers, null, '  '));
    });

  } while (confirmed !== 'y');

  return newManifest;
  */
};
