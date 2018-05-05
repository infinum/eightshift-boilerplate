#!/usr/bin/env node

const fs = require('fs');
const path = require('path');
// const prompt = require('prompt');

const rootDir = path.join( __dirname, '..' );

const reset = '\x1b[0m';
const bright = '\x1b[1m';
const dim = '\x1b[2m';
const underscore = '\x1b[4m';


const fgBlack = '\x1b[30m';
const fgRed = '\x1b[31m';
const fgGreen = '\x1b[32m';
const fgYellow = '\x1b[33m';
const fgBlue = '\x1b[34m';
const fgMagenta = '\x1b[35m';
const fgCyan = '\x1b[36m';
const fgWhite = '\x1b[37m';

const bgBlack = '\x1b[40m';
const bgRed = '\x1b[41m';
const bgGreen = '\x1b[42m';
const bgYellow = '\x1b[43m';
const bgBlue = '\x1b[44m';
const bgMagenta = '\x1b[45m';
const bgCyan = '\x1b[46m';
const bgWhite = '\x1b[47m';


console.log(fgGreen, 'The script will uniquely set up your theme.');
// console.log(fgBlue, 'Please enter your theme name (shown in WordPress admin):');
// console.log(fgBlue, 'Please enter your package name (used in translations - ' +
//   'lowercase with no special characters, \'_\' or \'-\' allowed for spaces):');
// console.log(fgBlue, 'Please enter a theme prefix (used when defining constants):');
// console.log(fgBlue, 'Please enter a theme development url ' +
//   '(for local development with browsersync):');




// const onErr = (err) => {
//   console.log(err);
//   return 1;
// };

// const themeNameProps = [
//   {
//     name: 'themeName',
//     validator: /^[a-zA-Z\s-]+$/ || null,
//     warning: 'Theme name must be only letters, spaces, or dashes and is required',
//   },
// ];

// prompt.start();

// console.log(fgBlue, 'Please enter your theme name (shown in WordPress admin):');

// const themeName = prompt.get(themeNameProps, (err, result) => {
//   if (err) {
//     return onErr(err);
//   }

//   // console.log(fgCyan, result.themeName);
//   return result.themeName;
// });

//   console.log(fgMagenta, themeName);






let themeName;



function prompt(question, callback) {
    var stdin = process.stdin,
        stdout = process.stdout;

    stdin.resume();
    stdout.write(question);

    stdin.once('data', function (data) {
        callback(data.toString().trim());
    });
}

prompt('Whats your name?', function (input) {
    themeName =input;
    process.exit();
});

console.log(themeName);
