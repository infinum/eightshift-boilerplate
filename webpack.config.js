const config = require('./webpack/config');

module.exports = (env, argv) => {
  const {mode} = argv;
  config.env = mode;

  return require(`./webpack/${mode}.js`); // eslint-disable-line import/no-dynamic-require, global-require
};
