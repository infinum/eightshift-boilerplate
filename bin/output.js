const chalk = require('chalk');
const readline = require('readline');
const prompt = require('prompt-sync')();

exports.write = (color, msg) => console.log(chalk[color](msg));
exports.normal = (msg) => console.log(msg);
exports.error = (msg) => console.log(chalk.red(msg));
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
  lines.forEach((line) => console.log(`  - ${chalk(line.label)}: ${chalk.green(line.variable)}`));
  exports.success('');
  const confirm = prompt('Confirm (y/n)? ');
  exports.success('');

  if (confirm === 'exit') {
    process.exit();
  }

  return confirm;
};

exports.writeProcess = (startMsg, finishMsg, errorMsg) => {
  process.stdout.write(`waiting 2 ...`);
  readline.cursorTo(process.stdout, 0);
  process.stdout.write(`waiting 2 ...`);
  readline.cursorTo(process.stdout, 0);
  process.stdout.write(`waiting 3 ...%`);
  readline.cursorTo(process.stdout, 0);
  process.stdout.write(`waiting 4 ...`);
};

exports.writeIntro = () => {
  console.log(chalk.red('##############################################################'));
  console.log(chalk.red('                                                         '));
  console.log(chalk.red('     _ _ _ ___    _____      _  _ ____ _ _  _               '));
  console.log(chalk.red('     | | | |__|    |__| |    |  | | __ | |\\ |               '));
  console.log(chalk.red('     |_|_| |       |    |___ |__| |__| | | \\|               '));
  console.log(chalk.red('                                                               '));
  console.log(chalk.red('     ___  ____ _ _    ____ ____ ___       ____ ___ ____     '));
  console.log(chalk.red('     |__| |  | | |    |___ |__/ |__| |    |__|  |  |___     '));
  console.log(chalk.red('     |__| |__| | |___ |___ |  \\ |    |___ |  |  |  |___     '));
  console.log(chalk.red('                                                            '));
  console.log(chalk.red('                                                            '));
  console.log(chalk('     Welcome to Boilerplate setup script!                   '));
  console.log(chalk.red('                                                            '));
  console.log(chalk('     This scripts will uniquely set up your theme.          '));
  console.log(chalk.red('                                                         '));
  console.log(chalk.red('                                                         '));
};

