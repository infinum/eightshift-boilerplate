<p align="center">
  <img alt="Eightshift WordPress Boilerplate Creative" src="packages/create-wp-theme/logo.svg"/>
</p>

[![Travis](https://img.shields.io/travis/infinum/wp-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/wp-boilerplate)
[![npm version](https://img.shields.io/npm/v/create-wp-theme.svg?style=for-the-badge)](https://www.npmjs.com/package/create-wp-theme)
[![GitHub tag](https://img.shields.io/github/tag/infinum/wp-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/wp-boilerplate)
[![GitHub stars](https://img.shields.io/github/stars/infinum/wp-boilerplate.svg?style=for-the-badge&label=Stars)](https://github.com/infinum/wp-boilerplate/)
[![license](https://img.shields.io/github/license/infinum/wp-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/wp-boilerplate)

# Eightshift WordPress Boilerplate

This repository contains all the tools you need to start building a modern WordPress theme, using all the latest front end development tools.

Eightshift WordPress Boilerplate is maintained and sponsored by
[Eightshift](https://eightshift.com) and [Infinum](https://infinum.co).

## :books: Table of contents
- [:school_satchel: Requirements](#school_satchel-requirements)
- [:rocket: Quick start](#rocket-quick-start)
- [:mortar_board: How to develop using WP Boilerplate](#mortar_board-how-to-develop-using-wp-boilerplate)
- [:rotating_light: Liniting Files](#rotating_light-liniting-files)
- [:factory: Going to Production](#factory-going-to-production)
- [:truck: Import & Export](#truck-import--export)
- [:interrobang: Plugin](#interrobang-plugin)
- [:mailbox: Who do I talk to?](#mailbox-who-do-i-talk-to)
- [:scroll: License](#scroll-license)

## :school_satchel: Requirements

1. [Node.js](https://nodejs.org/en/)
2. [Composer](https://getcomposer.org/)

## :rocket: Quick start 

Let's create a new theme!

Navigate to your WordPress install's `wp-content/themes` folder and run the following command:

```
npx create-wp-theme
```

Script will prompt you for theme name and local development url (used for BrowserSync) and install a new theme:

![](packages/create-wp-theme/setup.gif)

After the script is finished, you can activate the theme through WP Admin Dashboard. 

To start developing navigate to your theme's folder (`cd theme_name`) and run:
```
npm start
```

## :mortar_board: How to develop using WP Boilerplate

1. **Automatic building of assets**

    This will build production ready assets (in watch/development mode using Webpack) after each modification to your files in `skin/assets` (compile `SCSS` to `CSS`, transpile `JS`, add hashes to files for cache busting purposes, etc):

    Generally speaking, you should have this script active all the time while you're developing. 

    ```bash
    npm start
    ```

    _You need to run this in your theme's folder._

2. **BrowserSync**

    You have BrowserSync to sync assets and enable easy cross-device testing. Once BrowserSync is active you will get url in the terminal. Usualy it is `localhost:3000`.

    [What is BrowserSync?](https://www.browsersync.io/)

3. **IMPORTANT - Adding new .php classes (or renaming exsiting ones)**

    This theme uses OOP with namespaces and autoloader. When you add new class in your theme, be sure to run this command to rebuild the composer's autoload class map. The reason why this isn't automatic is that we are folowing modified WordPress coding standards, and not PSR standards, so this has to be done manually.

    _In short, run this after adding a new class:_

    ```bash
    composer -o dump-autoload
    ```

## :rotating_light: Liniting Files

### Automatic

You can have editors lint your files as you type, here's how to set it up:
* [Visual Studio Code](https://github.com/infinum/wp-boilerplate/wiki/Visual-Studio-Code)

### Manual

1. **Linting assets** - JS and SASS using Webpack:

    ```bash
    npm run lint
    ```

2. **Linting PHP** - We are using [Infinum coding standards for WordPress](https://github.com/infinum/coding-standards-wp) to check php files. To install it, you need to install [Composer](https://getcomposer.org/) from initial setup step.

    Here are available scripts to run in your terminal to lint your PHP files (you need to run them from inside the theme's folder):

    Checking theme for possible violations:

    ```bash
    composer check-cs .
    ```

    Autofix theme for minor violations:

    ```bash
    composer fix-cs .
    ```

## :factory: Going to Production

You can do it manualy using the command from package.json but we prefere using continious integration and we have 2 scripts to help you.

1. Run build script to build production version of assets and composer, run linting and tests:

    ```bash
    bash bin/build.sh
    ```

2. Run build script to build production version of assets and composer.
Builds production ready assets

    ```bash
    bash bin/deploy.sh
    ```

3. For deployment, we are using [rsync](https://rsync.samba.org/) and [semaphoreci](https://semaphoreci.com/) in our continuous deployment setup. Whatever deployment system you are using you should never copy unnecessary data to the server. We added file `ci-exclude.txt` to exclude unnecessary folders and files on deployment.

## :truck: Import & Export

1. Export

    You can run this script from your theme folder which will give you a `.zip` of your theme you can add to any project.

    ```
    npm run export
    ```

2. Import

    After importing the theme to a different website (through WordPress admin dashboard), you need to run this script (from the theme's folder) before activating it.

    ```
    npm run setup
    ```

## :interrobang: Plugin

When working for a client it may be easier to add every additional functionality to the theme. Since you are using namespaces, this contains all the necessary logic in the theme. You can use plugins of course, but be careful how you are adding extra functionality, so that you don't run in the dependency hell.
If you need to expose certain functionality across the multisite we recommend that you create a plugin.

Plugins should be created using plugin boilerplate, with addition of namespaces and autoloader. We have that also prepared so please check our [Plugin Boilerplate](https://github.com/infinum/wp-boilerplate-plugin).

## :mailbox: Who do I talk to?

For questions talk to:

* [ivan.ruzevic@infinum.hr](ivan.ruzevic@infinum.hr)
* [denis.zoljom@infinum.hr](denis.zoljom@infinum.hr)
* [ivan.grginov@infinum.hr](ivan.grginov@infinum.hr)
* [team@eightshift.com](team@eightshift.com)

Eightshift WordPress Boilerplate is maintained and sponsored by Eightshift and Infinum.

## :scroll: License

Infinum WordPress Boilerplate is Copyright ©2018 Infinum. It is free software, and may be redistributed under the terms specified in the LICENSE file.
