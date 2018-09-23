#!/usr/bin/env node

const chalk = require('chalk');
const output = require('./output');
const emoji = require('node-emoji');
const {exec} = require('promisify-child-process');
const {execSync} = require('child_process');
const files = require('./files');

const createDatabase = async(options) => {
  const create = `mysql -u ${options.dbRootUser} --password=${options.dbRootPass} -e "CREATE DATABASE IF NOT EXISTS ${options.dbName}"`;
  const grant = `mysql -u ${options.dbRootUser} --password=${options.dbRootPass} -e "GRANT ALL PRIVILEGES ON ${options.dbName}.* TO ${options.dbUser}@localhost IDENTIFIED BY 'wp';"`;

  return new Promise((resolve, reject) => {
    exec(create).then(() => {
      exec(grant).then(() => {
        resolve(true);
      }).catch((errGrant) => {
        reject(errGrant);
      });
    }).catch((errCreate) => {
      reject(errCreate);
    });
  });
};

/**
 * Outputs WP login info.
 *
 * @param string url   Website's local URL.
 * @param string user  WP user.
 * @param string pass  WP user's pass.
 */
const outputWPLoginInfo = (url, user, pass) => {
  console.log('Your login info:');
  console.log('-------------------');
  console.log(`Login: ${chalk.green(url)}${chalk.green('/wp-admin')}`);
  console.log(`User: ${chalk.green(user)}`);
  console.log(`Pass: ${chalk.green(pass)}`);
};

/**
 * Prompts the user for database name and returns it
 *
 * @return string
 */
const promptDatabase = () => {
  let dbName;
  dbName = output.prompt({
    label: 'Please enter database name:',
    prompt: `${emoji.get('school_satchel')} Database name: `,
    error: 'Database name cannot be empty',
    required: true,
  }).trim();
  return dbName;
};

/**
 * Setup WP for users using Varying Vagrant Vagrants
 */
exports.vvv = () => {

  // ------------------------------
  // Prompting
  // ------------------------------

  console.log(chalk.red('---------------------------------------------------------------'));
  console.log('');
  console.log('Let\'s setup your WordPress installation for');
  console.log(`${chalk.bgGreen.black('Varying Vagrant Vagrants')}...`);
  console.log('');
  const vmdir = output.prompt({
    label: '1. Please enter your project\'s \'vm_dir\' VVV path:',
    prompt: `${emoji.get('trolleybus')} Path (by default it's /srv/PROJECTNAME/): `,
    error: 'vm_dir cannot be empty.',
    required: true,
  }).trim();

  const wpInfo = {
    dbName: promptDatabase(),
    dbUser: 'wp',
    dbPass: 'wp',
    siteUrl: files.readManifest('url'),
    siteName: 'WP_Boilerplate',
    user: 'Admin',
    pass: 'abcegrtertetertert',
    email: files.readManifest('email'),
    themePackage: files.readManifest('package'),
  };

  // ------------------------------
  // Installation
  // ------------------------------

  try {

    // Try installing the WP core (if needed)
    console.log('');
    console.log('Great, let\'s get started...');
    console.log('');
    execSync(`
    vagrant ssh -- -t 'cd ${vmdir}/public_html;
      wp config create --dbname=${wpInfo.dbName} --dbuser=${wpInfo.dbUser} --dbpass=${wpInfo.dbPass};
      wp core install --url=${wpInfo.siteUrl} --title=${wpInfo.siteName} --admin_user=${wpInfo.user} --admin_pass=${wpInfo.pass} --admin_email=${wpInfo.email};
      wp theme activate ${wpInfo.themePackage};'
    `, (error, stdout, stderr) => {
      output.success('Done!');
    });
  } catch (err) {
    output.error(err);
  }

  outputWPLoginInfo(wpInfo.siteUrl, wpInfo.user, wpInfo.pass);
};

/**
 * Message for users using something other than provided options.
 */
exports.else = () => {
  console.log('    In order to finish the installation manually,');
  console.log('    please go to your website\'s local dev url.');
};

/**
 * Message for users wanting to setup WP manually.
 */
exports.manual = () => {
  console.log('    In order to finish the installation manually,');
  console.log('    please go to your website\'s local dev url.');
};
