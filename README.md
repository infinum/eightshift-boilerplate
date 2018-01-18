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

Run bash script to setup your project and rename all files via wizard.
`You run this first and only once`
```
sh _rename.sh
```

## Development Pre Start
Run this to start with development or to setup WP on the server.
It will install npm and composer dependencies, install the latest version of WP and set the current theme as active.
```
sh _setup.sh
```

## Development Start
Builds assets in watch mode using Webpack.
```
npm start
```

## Browser sync
We are using BrowserSync to sync assets and enable easy cross-device testing. To set it up go to `webpack.config.js` and set `proxyUrl` variable to link of your local development.
It is tested on MAMP and Vagrant (VVV).

## Linting Assets (JS,SASS)
Lints JS and SASS using Webpack
```
npm run precommit
```

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
```
wpcs wp-content/themes/theme_name
```

Autofix theme for minor violations:
```
wpcbf wp-content/themes/theme_name
```

## Build
Build creates public folder in theme all the assets.

Check for errors js, css, php but not WP standards
```
sh _prebuild.sh
```

Builds production ready assets
```
sh _build.sh
```

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

