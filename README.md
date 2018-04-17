# Infinum WordPress Boilerplate

[![Travis](https://img.shields.io/travis/infinum/wp-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/wp-boilerplate)
[![GitHub tag](https://img.shields.io/github/tag/infinum/wp-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/wp-boilerplate)
[![GitHub stars](https://img.shields.io/github/stars/infinum/wp-boilerplate.svg?style=for-the-badge&label=Stars)](https://github.com/infinum/wp-boilerplate/)
[![license](https://img.shields.io/github/license/infinum/wp-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/wp-boilerplate)



This repository contains all the tools you need to start building a modern WordPress theme, using all the latest front end development tools.

## Who do I talk to?

For questions talk to:

* [ivan.ruzevic@infinum.hr](ivan.ruzevic@infinum.hr)
* [denis.zoljom@infinum.hr](denis.zoljom@infinum.hr)
* [team@eightshift.com](team@eightshift.com)

## It contains:

* Webpack4+ config and build
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
* Namespacing
* Autoloader
* Project-specific wp-config
* Import / export scripts
* Project setup wizard
* ...

## Getting started

First you need to install WordPress locally, using any of the local development environment you prefer. You can use XAMPP, MAMP, WAMP, VVV, Docker or Laravel Valet. You'll also need to have [Node.js](https://nodejs.org/en/), [Composer](https://getcomposer.org/) and [WP-CLI](https://wp-cli.org/) installed.

To start, fork this repository to your own, and then clone it

```sh
git clone git@github.com:your-name/wp-boilerplate.git
```

If you are using VVV clone it in the `public_html` folder

```sh
git clone git@github.com:your-name/wp-boilerplate.git public_html
```

Run bash script to setup your project and rename all files via wizard.
**Run this first and only once**

```sh
sh _rename.sh
```

**Note:** If you get `sed: RE error: illegal byte sequence`, this is just a shell quirk, and should not worry you, the replace will work fine.

This will make changes to theme name, description, author, text domain, package, namespace, and constants (this is important when specifying environment variable).

## Development Pre Start

Run this to setup WordPress on the server.
The script will install `npm` and `composer` dependencies, install the latest version of WordPress.

```sh
sh _setup.sh
```

After running setup script, you'll need to create `wp-config.php`. You can do that manually, or use WP-CLI

```sh
wp config create --dbname={DBNAME} --dbuser={DBUSER} --dbpass={DBPASS}
wp core install --url={dev.boilerplate.com} --title={THEMENAME} --admin_user={ADMINUSER} --admin_email={ADMINMAIL}
wp theme activate {THEMENAME}
```

## Development Start

Builds assets in watch mode using Webpack.

```sh
npm start
```

## Browser sync

We are using BrowserSync to sync assets and enable easy cross-device testing.
To set it up go to `webpack.config.js` and set `proxyUrl` variable to link of your local development.
It is tested on MAMP and Vagrant (VVV).

## Linting Assets (JS,SASS)

Lints JS and SASS using Webpack

```sh
npm run precommit
```

## Linting PHP ##

We are using [Infinum coding standards for WordPress](https://github.com/infinum/coding-standards-wp) to check php files.

To install it, you need to install [Composer](https://getcomposer.org/) first.

* Add this aliases to you bash config:

```sh
alias phpcs='vendor/bin/phpcs';
alias phpcbf='vendor/bin/phpcbf';
alias wpcs='phpcs --standard=vendor/infinum/coding-standards-wp/Infinum';
alias wpcbf='phpcbf --standard=vendor/infinum/coding-standards-wp/Infinum';
```
* Reload terminal

Checking theme for possible violations:

```sh
wpcs wp-content/themes/init_theme_name
```

Autofix theme for minor violations:

```sh
wpcbf wp-content/themes/init_theme_name
```

## Build

Build creates public folder in theme all the assets.

Check for errors js, css, php but not WP standards

```sh
sh _prebuild.sh
```

Builds production ready assets

```sh
sh _build.sh
```

## Import & Export

Details are located in the `README-project.md` file. Be sure to change the URL according to your project.

## Note

This theme uses OOP with namespaces and autoloader. We have also included `ci-exclude.txt` file, to point what files to exclude when deploying using continuous integration.

When you add new class in your theme, be sure to run

```sh
composer -o dump-autoload
```

to rebuild the composer's autoload class map. The reason why this isn't automatic is that we are folowing modified WordPress coding standards, and not PSR standards, so this has to be done manually.

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
