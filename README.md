# Wordpress Boilerplate

This repo is used to start with your Wordpress project.

## Who do I talk to? ##
For questions talk to:
* ivan.ruzevic@infinum.hr
* denis.zoljom@infinum.hr

## It contains:

* Webpack3 config and build
* ES Linting
* Style Linting
* PHP Error Check
* WPCS Style Guide
* BrowserSync
* PostCSS with:
  * Autoprefixer
  * Postcss-font-magician
  * Css-mqpacker
  * Cssnano
* Build and Prebuild Bash Script
* GitIgnore
* Sass files based on Infinum Handbook
* Precreated template files nad helpers
* Bem menues
* Google rich snippets
* ...

## Getting started

We recommend search and replace `theme_name` with your theme name.
Change theme name in files:

* `theme_name` - theme folder
* `webpack.config.js` - in `themeName` variable
* `postcss.config.js` - in `themeName` variable
* `.gitignore`
* `.eslintignore`
* `package.json` - project name

## Development Pre Start
* `sh _setup.sh` - run script
* Setup docker or any other local environment

## Development Start
* `npm start`
  * Builds assets in watch mode using Webpack

## Browser sync
We are using BrowserSync to sync assets cross-device to setup got to `webpack.config.js` and set `proxyUrl` variable to service you are using to show Wordpress.
It is tested on MAMP and Vagrant.

## Linting Assets (JS,SASS)
* `npm run precommit`
  * Lints JS and SASS using Webpack

## Linting PHP ##
We are using [Infinum coding standards for WordPress](https://github.com/infinum/coding-standards-wp) to check php files.

To install it, you need to install [Composer](https://getcomposer.org/) first.

* Add this aliases to you bash config:
```
alias phpcs='vendor/bin/phpcs';
alias phpcbf='vendor/bin/phpcbf';
alias wpcs='phpcs --standard=vendor/infinum/coding-standards-wp/Infinum';
alias wpcbf='phpcbf --standard=vendor/infinum/coding-standards-wp/Infinum';
```
* Reload terminal

Checking theme for possible violations:
* `wpcs wp-content/themes/theme_name`

AutoFix theme for minor violations:
* `wpcbf wp-content/themes/theme_name`

## Build
Build creates public folder in theme with js, css, images and fonts

* `sh _prebuild.sh`
  * Check for errors js, css, php but not WP standards
* `sh _build.sh`
  * Builds production ready assets

## Note
* ALWAYS prefix custom function. We used `inf_`.

## Recommended plugins

* Advanced Custom Fields PRO
* All-in-One WP Migration
* Better Search Replace
* Contact Form 7
* EWWW Image Optimizer
* Post Duplicator
* Post Type Switcher
* Redirection
* Taxonomy Switcher
* TinyMCE Advanced
* WordPress Importer
* WP Fastest Cache
* WP-Optimize
* WPML
* Yoast SEO

## Plugin
If you are creating custom plugin, the use of Wp Plugin Boilerplate is mandatory.

`https://wppb.me/`
