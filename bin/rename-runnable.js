const chalk = require('chalk');
const fs = require('fs');
const files = require('./files');
const output = require('./output');
const ora = require('ora');
const rename = require('./rename');
const {exec} = require('promisify-child-process');


const run = async() => {
  console.log(chalk.red('--------------------------------------------------'));
  output.dim('');
  output.dim('    Starting the renaming script...');
  output.normal('    ');
  console.log(`${chalk.red('    !WARNING')}`);
  output.dim('    This script won\'t work if you\'ve renamed');
  output.dim('    or edited your theme info manually.');
  output.dim('');
  console.log(`    ${chalk.dim('Please review')} ${chalk.green('theme-manifest.json')} ${chalk.dim(' which contains the')} `);
  output.dim('     old info (needles in haystack) and update if needed.');
  output.dim('');

  const newManifest = rename.promptThemeData();

  // Read info from the old manifest (needles we're replacing in haystack)
  let oldManifest;
  if (fs.existsSync(files.manifest)) {
    oldManifest = JSON.parse(fs.readFileSync(files.manifest, 'utf8'));
  }
  
  output.dim('--------------------------------------------------');
  output.dim('');
  output.dim('    Great! We have everything we need for now,    ');
  output.dim('    we\'ll start setting up your project...       ');
  output.dim('');
  output.dim('--------------------------------------------------');
  output.dim('');
  
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

  output.dim('');
  output.success('    We have successfully renamed your files!    ');
  output.dim('');
  output.dim('--------------------------------------------------');
  output.dim('');

};
run();
