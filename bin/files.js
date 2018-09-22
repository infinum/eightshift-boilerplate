const fs = require('fs');
const path = require('path');
const replace = require('replace-in-file');
const output = require('./output');

// Helpers
const fgRed = '\x1b[31m';
const fgGreen = '\x1b[32m';
const fgBlue = '\x1b[34m';
const fgMagenta = '\x1b[35m';
const fgCyan = '\x1b[36m';
const has = Object.prototype.hasOwnProperty;

// Functions
const consoleOutput = (color, text) => {
  console.log(color, text);
};

exports.rootDir = path.join(__dirname, '..');
exports.manifest = path.join(`${exports.rootDir}/theme-manifest.json`);
exports.wpContentFolder = path.join(`${exports.rootDir}/wp-content`);
exports.themeFolder = path.join(`${exports.wpContentFolder}/themes`);

exports.readManifest = (key) => {
  if (!fs.existsSync(exports.manifest)) {
    throw new Error('Unable to find the manifest file!');
  }

  const manifest = JSON.parse(fs.readFileSync(exports.manifest, 'utf8'));

  if (!has.call(manifest, key)) {
    throw new Error(`Unable to find value for: ${key}`);
  }

  return manifest[key];
};

exports.findReplace = async(findString, replaceString) => {
  const regex = new RegExp(findString, 'g');
  const options = {
    files: `${exports.rootDir}/**/*`,
    from: regex,
    to: replaceString,
    ignore: [
      path.join(`${exports.rootDir}/node_modules/**/*`),
      path.join(`${exports.rootDir}/.git/**/*`),
      path.join(`${exports.rootDir}/.github/**/*`),
      path.join(`${exports.rootDir}/vendor/**/*`),
      path.join(`${exports.rootDir}/wp-admin/**/*`),
      path.join(`${exports.rootDir}/wp-includes/**/*`),
      path.join(`${exports.rootDir}/_rename.sh`),
      path.join(`${exports.rootDir}/bin/rename.js`),
      path.join(`${exports.rootDir}/bin/setup-wp.js`),
      path.join(`${exports.rootDir}/bin/output.js`),
      path.join(`${exports.rootDir}/bin/files.js`),
      path.join(`${exports.rootDir}/theme-manifest.js`),
    ],
  };

  return new Promise((resolve) => {

    // No need to search if the values are the same.
    if (findString === replaceString) {
      resolve(true);
    }

    replace(options)
      .then(() => {
        resolve(true);
      })
      .catch((error) => {
        output.error(error);
        resolve(true);
      });
  });
};

exports.renameAllFiles = async(oldManifest, newManifest) => {
  await exports.findReplace(oldManifest.name, newManifest.name);
  await exports.findReplace(oldManifest.description, newManifest.description);
  await exports.findReplace(oldManifest.author, newManifest.author);
  await exports.findReplace(oldManifest.package, newManifest.package);
  await exports.findReplace(oldManifest.namespace, newManifest.namespace);
  await exports.findReplace(oldManifest.env, newManifest.env);
  await exports.findReplace(oldManifest.assetManifest, newManifest.assetManifest);
  await exports.findReplace(oldManifest.url, newManifest.url);

  return new Promise((resolve) => {

    // Do all search / replaces in paralel


    // Promise.all([
    //   exports.findReplace(oldManifest.name, newManifest.name),
    //   exports.findReplace(oldManifest.description, newManifest.description),
    //   exports.findReplace(oldManifest.author, newManifest.author),
    //   exports.findReplace(oldManifest.package, newManifest.package),
    //   exports.findReplace(oldManifest.namespace, newManifest.namespace),
    //   exports.findReplace(oldManifest.env, newManifest.env),
    //   exports.findReplace(oldManifest.assetManifest, newManifest.assetManifest),
    //   exports.findReplace(oldManifest.url, newManifest.url),
    // ]).then(() => {

      // Rename theme folder
      if (newManifest.package !== oldManifest.package) {
        if (fs.existsSync(path.join(`${exports.themeFolder}/${oldManifest.package}/`))) {
          fs.renameSync(path.join(`${exports.themeFolder}/${oldManifest.package}/`), path.join(`${exports.themeFolder}/${newManifest.package}/`), (err) => {
            if (err) {
              throw err;
            }
            fs.statSync(`${exports.wpContentFolder}/${newManifest.package}/`, (error) => {
              if (error) {
                throw error;
              }
            });
          });
        }
      }

      resolve(true);
    // });
  });
};

