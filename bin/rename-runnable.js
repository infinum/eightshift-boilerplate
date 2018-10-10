const chalk = require('chalk');
const fs = require('fs');
const files = require('./files');
const output = require('./output');
const ora = require('ora');
const rename = require('./rename');
const {exec} = require('promisify-child-process');

const run = async() => {
  console.log(chalk.red('--------------------------------------------------'));
  output.normal('');
  output.normal('    Starting the rename script...');
  output.normal('    ');
  console.log(`${chalk.red('    !WARNING')}`);
  output.normal('    This script won\'t work if you\'ve renamed');
  output.normal('    or edited your theme info manually.');
  output.normal('');
  console.log(`    ${chalk.dim('Please review')} ${chalk.green('theme-manifest.json')} ${chalk.dim(' which contains the')} `);
  output.normal('     old info (needles in haystack) and update if needed.');
  output.normal('');

  const newManifest = rename.promptThemeData();

  // Read info from the old manifest (needles we're replacing in haystack)
  let oldManifest;
  if (fs.existsSync(files.manifest)) {
    oldManifest = JSON.parse(fs.readFileSync(files.manifest, 'utf8'));
  }
  
  output.normal('--------------------------------------------------');
  output.normal('');
  output.normal('    Great! We have everything we need for now,    ');
  output.normal('    we\'ll start setting up your project...       ');
  output.normal('');
  output.normal('--------------------------------------------------');
  output.normal('');
  
  // -----------------------------
  //  Rename files
  // -----------------------------
  
  const spinnerRename = ora('1. Renaming files (this might take some time)').start();
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

  const spinnerComposer = ora('2. Composer dump-autoload').start();
  await exec('npx composer -o dump-autoload').then(() => {
    spinnerComposer.succeed();
  }).catch((error) => {
    spinnerComposer.fail(`${spinnerComposer.text}\n${error}`);
    process.exit();
  });

  // -----------------------------
  //  Building assets
  // -----------------------------

  const spinnerBuildAssets = ora('3. Building assets').start();
  await exec('npm run build').then(() => {
    spinnerBuildAssets.succeed();
  }).catch((error) => {
    spinnerBuildAssets.fail(`${spinnerBuildAssets.text}\n\n${error}`);
    process.exit();
  });

  output.normal('');
  output.success('    We have successfully renamed your files!    ');
  output.normal('');
  output.normal('--------------------------------------------------');
  output.normal('');

};
run();
