# Wordpress Boilerplate

This repo is used to start with your Wordpress project. 

It contains:

* Webpack2 config and build 
* ES Linting
* Style Linting
* PHP Error Check
* PostCSS with:
  * Autoprefixer
  * Postcss-font-magician
  * Css-mqpacker
  * Cssnano
* Build and Prebuild Bash Script
* GitIgnore
* Separate builds for plugin(admin and public section) and theme
* Sass files based on Infinum Handbook
* Precreated template files nad helpers
* Bem menues
* Google rich snippets
* ...

## Plugin
Use of Wp Plugin Boilerplate is mandatory.

`https://wppb.me/`


## Install
* Add to the project and run in terminal:
  * `npm install`
  * `composer install`
* `theme_name` - change folder name
* `plugin_name` - change folder name - if used
* `webpack.config.js` - change theme name and plugin name in variables
  * If plugin is not user remove the section for plugins build
* `postcss.config.js` - add fonts and change theme name
* `.gitignore` - change theme and plugin name
* `.eslintignore` - change theme and plugin name
* `package.json` - change project name

## Develop
* `npm start`

## Linting
* `npm run precommit`

## Build
Build creates public folder in theme and plugin with js, css, images and fonts

* `sh _prebuild.sh` - Check for errors js, css, php
* `sh _build.sh`

