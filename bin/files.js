const fs = require('fs');
const path = require('path');
const replace = require('replace-in-file');

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

exports.findReplace = (findString, replaceString) => {
  const regex = new RegExp(findString, 'g');
  const options = {
    files: `${exports.rootDir}/**/*`,
    from: regex,
    to: replaceString,
    ignore: [
      `${exports.rootDir}/node_modules/**/*`,
      `${exports.rootDir}/.git/**/*`,
      `${exports.rootDir}/.github/**/*`,
      `${exports.rootDir}/vendor/**/*`,
      `${exports.rootDir}/_rename.sh`,
      `${exports.rootDir}/bin/rename.js`,
      `${exports.rootDir}/bin/setup-wp.js`,
      `${exports.rootDir}/theme-manifest.js`,
    ],
  };

  try {
    const changes = replace.sync(options);

    consoleOutput(fgGreen, '');
    consoleOutput(fgGreen, '------------');
    consoleOutput(fgGreen, `${findString}-> ${replaceString}. Modified files: ${changes.length}`);
  } catch (error) {

    consoleOutput(fgMagenta, '');
    consoleOutput(fgMagenta, '------------');
    console.error('Error occurred:', error);
  }
};

