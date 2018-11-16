const fs = require('fs');
const path = require('path');
const replace = require('replace-in-file');
const emoji = require('node-emoji');
const ora = require('ora');
const chalk = require('chalk');

const rootDir = path.join(__dirname, '..');
const manifest = path.join(`${rootDir}/theme-manifest.json`);


const readManifestFull = () => {
  let oldManifest = '';
  if (fs.existsSync(manifest)) {
    oldManifest = JSON.parse(fs.readFileSync(manifest, 'utf8'));
  }
  return oldManifest;
}

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
      path.join(`${rootDir}/wp-admin/**/*`),
      path.join(`${rootDir}/wp-includes/**/*`),
      path.join(`${rootDir}/bin/rename.js`),
      path.join(`${rootDir}/bin/rename-runnable.js`),
      path.join(`${rootDir}/bin/setup.js`),
      path.join(`${rootDir}/bin/setup-wp.js`),
      path.join(`${rootDir}/bin/output.js`),
      path.join(`${rootDir}/bin/files.js`),
      path.join(`${rootDir}/theme-manifest.js`),
    ],
  };

  if (findString !== replaceString) {
    await replace(options);
  }
};

const run = async() => {

  const oldManifest = readManifestFull();
  const newManifest = oldManifest;
  
  // -----------------------------
  //  1. Rename dev url
  // ----------------------------- 

  const spinnerRename = ora('1. Renaming dev url').start();
  await findReplace(oldManifest.url, 'one.wordpress.test').then(() => {
    spinnerRename.succeed();
  }).catch((error) => {
    spinnerRename.fail(`${spinnerRename.text}\n${error}`);
    process.exit();
  });

  // Write the new manifest only after we've replaced everything.
  fs.writeFile(manifest, JSON.stringify(newManifest, null, 2), 'utf8', () => {});

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

}
run();