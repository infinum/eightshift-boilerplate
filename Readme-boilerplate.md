# Infinum WordPress Boilerplate

This repository contains all the tools you need to start building a modern WordPress theme, using all the latest front end development tools.

## Who do I talk to?
For questions talk to:
* ivan.ruzevic@infinum.hr
* denis.zoljom@infinum.hr
* team@eightshift.com

## It contains:

* Webpack3 config and build
* ES Linting
* Style Linting
* PHP Error Check
* WPCS Style Guide
* BrowserSync
* PostCSS with plugins
* Build and Prebuild Bash Script
* GitIgnore
* Sass files based on Infinum Handbook
* Precreated template files and helpers
* BEM menues
* Google rich snippets
* Object oriented codebase
* ...

## Getting started

First you need to install WordPress locally, using any of the local development environment you prefer. You can use XAMPP, MAMP, WAMP, VVV, Docker or Laravel Valet.

We recommend that you search and replace `theme_name` with your desired theme name.
Change the theme name in these files:

* `theme_name` - theme folder
* `webpack.config.js` - in `themeName` variable
* `postcss.config.js` - in `themeName` variable
* `.gitignore`
* `.eslintignore`
* `package.json` - project name

## Development Pre Start
* `sh _setup.sh` - run script

## Development Start
* `npm start`
  * Builds assets in watch mode using Webpack

## Browser sync
We are using BrowserSync to sync assets cross-device to setup got to `webpack.config.js` and set `proxyUrl` variable to service you are using to show WordPress.
It is tested on MAMP and Vagrant (VVV).

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
* This theme uses OOP with name spaces and autoloader.

## Recommended plugins

* Content:
  * Advanced Custom Fields PRO
  * Category Order and Taxonomy Terms Order
  * Post Duplicator
  * Nested Pages
  * TinyMCE Advanced
  * Regenerate Thumbnails

* Develop:
  * Debug Bar
  * Query Monitor

* Seo:
  * Yoast SEO
  * ACF Content Analysis for Yoast SEO

* Optimizations:
  * Autoptimize
  * Nginx Helper or WP Fastest Cache
  * WP-Optimize
  * Redirection
  * Transients Manager
  * Wordfence Security

* Multilanguage:
  * Advanced Custom Fields Multilingual
  * WPML Multilingual CMS
  * WPML String Translation
  * WPML Translation Management

* Other:
  * WordPress Importer
  * Mailgun

## Plugin
We don't recomment creating custom plugins rather then put every functionality in side of the theme. If you need functionality to be shared accross multisite then it is ok to create a plugin.
If you are creating a plugin use this link:

`https://wppb.me/`

## Credits

Infinum WordPress Boilerplate is maintained and sponsored by
[Infinum](https://www.infinum.co).

<img src="https://infinum.co/infinum.png" width="264">

## License

Infinum WordPress Boilerplate is Copyright © 2017 Infinum. It is free software, and may be redistributed under the terms specified in the LICENSE file.

