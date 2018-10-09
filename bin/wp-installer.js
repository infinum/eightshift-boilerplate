#!/usr/bin/env node

const chalk = require('chalk');
const output = require('./output');
const emoji = require('node-emoji');
const {exec} = require('promisify-child-process');
const {execSync} = require('child_process');
const files = require('./files');
const ora = require('ora');

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
const promptDatabase = () => output.prompt({
  label: 'Please enter database name (make sure it exists and is empty):',
  prompt: `${emoji.get('school_satchel')} Database name: `,
  error: 'Database name cannot be empty',
  required: true,
}).trim();

/**
 * Prompts the user for database name and returns it
 *
 * @return string
 */
const promptVmDir = () => output.prompt({
  label: '1. Please enter your project\'s \'vm_dir\' VVV path (by default it\'s /srv/www/PROJECTNAME):',
  prompt: `${emoji.get('trolleybus')} Path: `,
  error: 'vm_dir cannot be empty.',
  required: true,
}).trim().replace(/\/+$/, '');

/**
 * DELETEME
 */
exports.test = async() => {
  console.log(chalk.red('---------------------------------------------------------------'));
  console.log('');
  console.log('Testing:');

  // ------------------------------
  //  Verify vm_dir
  // ------------------------------

  const vmdir = promptVmDir();
  const spinner = ora('1. Testing if folder exists').start();
  await exec(`vagrant ssh -- -t 'cd ${vmdir}/public_html/;'`).then(() => {
    spinner.succeed();
  }).catch((error) => {
    spinner.fail(`${spinner.text}\n${error}`);
    process.exit();
  });

  
  // try {
  //   await exec(`vagrant ssh -- -t 'cd ${vmdir}/public_html/;'`, (error, stdout, stderr) => {
  //   });
  // } catch (err) {
  //   console.log(`Caught error: ${err}`);
  // }

};


/**
 * Setup WP for users using Varying Vagrant Vagrants
 */
exports.vvv = async() => {

  // ------------------------------
  // Prompting
  // ------------------------------

  console.log(chalk.red('---------------------------------------------------------------'));
  console.log('');
  output.dim('    Let\'s setup your WordPress installation for');
  console.log(`   ${chalk.bgGreen.black('Varying Vagrant Vagrants')}...`);

  const vmdir = promptVmDir();
  const wpInfo = {
    dbName: promptDatabase(),
    dbUser: 'wp',
    dbPass: 'wp',
    siteUrl: files.readManifest('url'),
    siteName: 'WP_Boilerplate',
    user: 'Admin',
    pass: Math.random().toString(36).slice(-14),
    email: files.readManifest('email'),
    themePackage: files.readManifest('package'),
  };

  // ==============================
  //
  //  Verify everything
  //
  // ==============================

  output.dim('');
  output.dim('    Great, let\'s get started...');
  output.dim('');

  // ------------------------------
  //  1. Verify vm_dir
  // ------------------------------

  const spinnerTestFolder = ora('1. Verifying vm_dir path').start();
  await exec(`vagrant ssh -- -t 'cd ${vmdir}/public_html/;'`).then(() => {
  }).catch((error) => {
    spinnerTestFolder.fail(`${spinnerTestFolder.text} - Unable to find vm_dir ${vmdir}\n\n${error}`);
    process.exit();
  });

  await exec(`vagrant ssh -- -t '
    cd ${vmdir}/public_html/;
    tail theme-manifest.json
  '`).then(() => {
    spinnerTestFolder.succeed();
  }).catch((error) => {
    spinnerTestFolder.fail(`${spinnerTestFolder.text} - Unable to verify wp-boilerplate installation in ${vmdir}\n\n${error}`);
    process.exit();
  });

  // -----------------
  //  2. Verify wp-cli
  // -----------------

  const spinnerWPCLI = ora('2. Checking if wp-cli works').start();
  await exec(`vagrant ssh -- -t '
      cd ${vmdir}/public_html/;
      wp --info
    '`).then(() => {
    spinnerWPCLI.succeed();
  }).catch((error) => {
    spinnerWPCLI.fail(`${spinnerWPCLI.text}\n\n${error}`);
    process.exit();
  });

  // -----------------
  //  3. Create wp-config
  // -----------------

  const spinnerWpConfig = ora('3. Creating wp-config.php').start();
  await exec(`vagrant ssh -- -t '
      cd ${vmdir}/public_html/;
      wp config create --dbname=${wpInfo.dbName} --dbuser=${wpInfo.dbUser} --dbpass=${wpInfo.dbPass};
    '`).then(() => {
    spinnerWpConfig.succeed();
  }).catch((error) => {
    spinnerWpConfig.fail(`${spinnerWpConfig.text}\n\n${error}`);
    process.exit();
  });

  // ------------------------------
  //  4. Verify MySQL connection
  // ------------------------------

  const spinnerTestWPB = ora('4. Check MySQL database connection').start();
  await exec(`vagrant ssh -- -t '
    cd ${vmdir}/public_html/;
    wp db create;
    '`).then(() => {
    spinnerTestWPB.succeed();
  }).catch((error) => {
    spinnerTestWPB.fail(`${spinnerTestWPB.text}\n\n${error}`);
    process.exit();
  });

  // ------------------------------
  //  5. Install WordPress
  // ------------------------------

  const spinnerInstallWP = ora('5. Installing WP Core').start();
  await exec(`vagrant ssh -- -t '
    cd ${vmdir}/public_html/;
    wp core install --url=${wpInfo.siteUrl} --title=${wpInfo.siteName} --admin_user=${wpInfo.user} --admin_password=${wpInfo.pass} --admin_email=${wpInfo.email};
    '`).then(() => {
    spinnerInstallWP.succeed();
  }).catch((error) => {
    spinnerInstallWP.fail(`${spinnerInstallWP.text}\n\n${error}`);
    process.exit();
  });

  //

  // ------------------------------
  //  6. Building Assets
  // ------------------------------

  const spinnerBuildAssets = ora('6. Building assets').start();
  await exec('npm run build').then(() => {
    spinnerBuildAssets.succeed();
  }).catch((error) => {
    spinnerBuildAssets.fail(`${spinnerBuildAssets.text}\n\n${error}`);
    process.exit();
  });

  // ------------------------------
  //  7. Activate Theme
  // ------------------------------

  const spinnerActivateTheme = ora('7. Activating theme').start();
  await exec(`vagrant ssh -- -t '
    cd ${vmdir}/public_html/;
    wp theme activate ${wpInfo.themePackage};
    '`).then(() => {
    spinnerActivateTheme.succeed();
    console.log('');
    output.success('Done! ');
    console.log('');
    outputWPLoginInfo(wpInfo.siteUrl, wpInfo.user, wpInfo.pass);
  }).catch((error) => {
    spinnerActivateTheme.fail(`${spinnerActivateTheme.text}\n\n${error}`);
    outputWPLoginInfo(wpInfo.siteUrl, wpInfo.user, wpInfo.pass);
    process.exit();
  });
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
