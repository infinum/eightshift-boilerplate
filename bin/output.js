const chalk = require('chalk');
const readline = require('readline');
const prompt = require('prompt-sync')();
const emoji = require('node-emoji');

exports.write = (color, msg) => console.log(chalk[color](msg));
exports.normal = (msg) => console.log(msg);
exports.error = (msg) => console.log(`${chalk.bgRed('Error')}${chalk.red(' - ')}${chalk.red(msg)}`);
exports.success = (msg) => console.log(chalk.bgGreen.black(msg));
exports.variable = (msg) => console.log(chalk.green(msg));
exports.label = (msg) => console.log(chalk.cyan(msg));

/**
 * Prompts a user for a value and returns it.
 *
 * @param object settings
 */
exports.prompt = (settings) => {
  let userInput;
  exports.label(settings.label);
  do {
    userInput = prompt(settings.prompt);
  
    if (userInput.length <= 0) {
      exports.error(settings.error);
    }
  }
  while (userInput.length <= 0 && userInput !== 'exit');
  exports.label('');
  if (userInput === 'exit') {
    process.exit();
  }

  return userInput;
};

/**
 * Writes a summary of selected values and asks for user confirmation that info is ok
 *
 * @param array lines
 */
exports.summary = (lines) => {
  exports.success('');
  exports.success('Your details will be:');
  lines.forEach((line) => console.log(`${chalk(line.label)}: ${chalk.green(line.variable)}`));
  exports.success('');
  const confirm = prompt('Confirm (y/n)? ');
  exports.success('');

  if (confirm === 'exit') {
    process.exit();
  }

  return confirm;
};

exports.startLoader = (originalText) => {
  let i = 0;
  process.stdout.write(originalText);
  const interval = setInterval(() => {
    process.stdout.clearLine();
    process.stdout.cursorTo(0);
    i = (i + 1) % 4;
    const dots = new Array(i + 1).join('.');
    const text = `${originalText}${dots}`;
    process.stdout.write(text);
  }, 500);
  return {
    interval,
    text: originalText,
  };
};

exports.stopLoader = (loaderObject) => {
  clearInterval(loaderObject.interval);
  process.stdout.clearLine();
  process.stdout.cursorTo(0);
  process.stdout.write(`${emoji.get('heavy_check_mark')}${loaderObject.text}`);
};

exports.writeIntro = () => {
  console.log(chalk.red('###############################################################'));
  console.log(chalk.red('                                                               '));
  console.log(chalk.red('    _ _ _ ___                                                  '));
  console.log(chalk.red('    | | | |__|                                                 '));
  console.log(chalk.red('    |_|_| |                                                    '));
  console.log(chalk.red('    ___  ____ _ _    ____ ____ ___       ____ ___ ____     '));
  console.log(chalk.red('    |__| |  | | |    |___ |__/ |__| |    |__|  |  |___     '));
  console.log(chalk.red('    |__| |__| | |___ |___ |  \\ |    |___ |  |  |  |___     '));
  console.log(chalk.red('                                                            '));
  console.log(chalk.red('                                                            '));
  console.log(chalk.dim('    Welcome to Boilerplate setup script!                     '));
  console.log(chalk.red('                                                             '));
  console.log(chalk.dim('    This script will uniquely set up your theme.            '));
  console.log(chalk.red('                                                         '));
  console.log(chalk.red('                                                         '));
};
