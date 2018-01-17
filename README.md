# Infinum WordPress Boilerplate

This repository contains all the tools you need to start building a modern WordPress theme, using all the latest front end development tools.

## Who do I talk to?

For questions talk to:

* [ivan.ruzevic@infinum.hr](ivan.ruzevic@infinum.hr)
* [denis.zoljom@infinum.hr](denis.zoljom@infinum.hr)
* [team@eightshift.com](team@eightshift.com)

## It contains:

* Webpack3 config and build
* ES Linting
* Style Linting
* PHP Error Check
* WPCS Style Guide
* BrowserSync
* PostCSS with plugins
* Build and Prebuild Bash Script
* .gitignore
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

* `theme_name` - theme folder, in documentation and localization
* `webpack.config.js` - in `themeName` variable
* `postcss.config.js` - in `themeName` variable
* `.gitignore`
* `.eslintignore`
* `package.json` - project name
* `_setup.sh`

## Development Pre Start
* `sh _setup.sh` - run script

## Development Start
* `npm start`
  * Builds assets in watch mode using Webpack

## Browser sync
We are using BrowserSync to sync assets and enable easy cross-device testing. To set it up go to `webpack.config.js` and set `proxyUrl` variable to link of your local development.
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

Autofix theme for minor violations:
* `wpcbf wp-content/themes/theme_name`

## Build
Build creates public folder in theme with js, css, images and fonts

* `sh _prebuild.sh`
  * Check for errors js, css, php but not WP standards
* `sh _build.sh`
  * Builds production ready assets

## Import & Export
Details are located in the `README-project.md` file. Be sure to change the URL according to your project.

## Note
* This theme uses OOP with namespaces and autoloader. Also we have included `ci-exclude.txt` file, to point what files to exclude when deploying using continuous integration.

## Recommended plugins

Some functionality will work with ACF plugin, they are usually easily noticed in the files, so you can remove them and the boilerplate will work. Also the boilerplate contains few browsecap specific pages that will work only if you include [browsecap](https://browscap.org/) on your server, or use [browsecap utility for VVV](https://github.com/dingo-d/browscap-vvv-utility) locally. These are also optional, and can be removed.

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
  * WPML Multilingual CMS
  * WPML String Translation
  * WPML Translation Management
  * Advanced Custom Fields Multilingual

* Other:
  * WordPress Importer
  * Mailgun

## Plugin
Since the core theme is built with OOP principles, and it is assumed that you'll be using it for one client, every custom functionality should be contained within the theme. If you need to expose certain functionality across the multisite you can create a plugin.

Plugins should be created using plugin boilerplate, with addition of namespaces and autoloader.

`https://wppb.me/`

## Credits

Infinum WordPress Boilerplate is maintained and sponsored by
[Infinum](https://www.infinum.co).

<img src="https://infinum.co/infinum.png" width="264">

## License

Infinum WordPress Boilerplate is Copyright © 2017 Infinum. It is free software, and may be redistributed under the terms specified in the LICENSE file.

