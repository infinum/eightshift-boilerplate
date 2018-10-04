# Eightshift WordPress Boilerplate

[![Travis](https://img.shields.io/travis/infinum/wp-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/wp-boilerplate)
[![GitHub tag](https://img.shields.io/github/tag/infinum/wp-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/wp-boilerplate)
[![GitHub stars](https://img.shields.io/github/stars/infinum/wp-boilerplate.svg?style=for-the-badge&label=Stars)](https://github.com/infinum/wp-boilerplate/)
[![license](https://img.shields.io/github/license/infinum/wp-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/wp-boilerplate)


This repository contains all the tools you need to start building a modern WordPress theme, using all the latest front end development tools.

Infinum WordPress Boilerplate is maintained and sponsored by
[Infinum](https://infinum.co) and [Eightshift](https://eightshift.com).

---
## What is WP Boilerplate?


* Starter theme
* Framework
* Boilerplate
* ...and much more

It gives you all the tools to build a modern, fast and beautiful WordPress website. 

---

## Quick start

Note regarding `Windows` - If you're installing this on `Windows` and you're using `XAMPP`, use `XAMPP` shell (Control Panel -> Shell) rather than `cmd`

1. To start, fork this repository to your own, and then clone it. If you are using VVV clone it in the `public_html` folder:

    ```bash
    git clone git@github.com:your-name/wp-boilerplate.git
    ```

2. Install latest version of [Node.js](https://nodejs.org/en/)

3. Install latest version of [Composer](https://getcomposer.org/)

4. Install latest version of [WP-CLI](https://wp-cli.org).

5. Run setup script

    ```
    npm run setup
    ```

6. Once the project is setup and **WordPress is installed** (you might need to do this step manually depending on your dev environment), run this to initially build all assets and start developing:

    ```
    npm start
    ```

7. Enjoy WP Boilerplate!

---

## Setup script details

This script will install `npm` and `composer` dependencies, install WordPress core files and rename all files via wizard. Renaming will make changes to theme name, description, author, text domain, package, namespace, and constants (this is important when specifying environment variable)

After this, the script will try to install WordPress automaticlly (setup `wp-config.php` and create all database tables).

### Automatic WP Install

Automatic installation is currently only supported for the following dev environments:

* [Varying Vagrant Vagrants](https://varyingvagrantvagrants.org)

If you're using something else (XAMPP, MAMP, Docker, etc), you need to install WordPress manually.

### Manual WP Install

Visit the url of your website and you should see the WordPress's 5-min installation wizard. Follow the steps and you will have a working default WP install.

Once you're finished, log-in to WordPress Dashboard, go to `Themes` and activate your new theme.

Once the theme is activated, make sure to run `npm start` in your `public_html` folder to initially build the assets. 

---

## Start developing

1. Builds assets in watch/development mode using Webpack (you need to do this after installing WordPress) :

    ```bash
    npm start
    ```

2. Update your `wp-config.php` file with project specific configuration that you can tailor according to your project needs. Compare your `wp-config.php` file with this example and update accordingly:

    ```php
    // Must be set.
    // Possible options are develop, staging and production.
    define( 'SF_ENV', 'develop' );

    /* That's all, stop editing! Happy blogging. */

    /** Absolute path to the WordPress directory. */
    if ( !defined('ABSPATH') )
      define('ABSPATH', dirname(__FILE__) . '/');

    // Include wp config for your project.
    require_once(ABSPATH . 'wp-config-project.php');

    /** Sets up WordPress vars and included files. */
    require_once(ABSPATH . 'wp-settings.php');
    ```

    * Remove `define( 'WP_DEBUG', false );`. This is defined in the `wp-config-project.php` file.

    * Set `SF_ENV` variable to correspond with your environment. That will add global setup for logging errors, disabling auto-update, some optimizations and it will change the color of admin so it is easier for you to know on what environment you are editing.


3. You have BrowserSync to sync assets and enable easy cross-device testing. Once BrowserSync is active you will get url in the terminal. Usualy it is `localhost:3000`.

---

## Liniting Files

1. **Linting assets** - JS and SASS using Webpack:

    ```bash
    npm run precommit
    ```

2. **Linting PHP** - We are using [Infinum coding standards for WordPress](https://github.com/infinum/coding-standards-wp) to check php files. To install it, you need to install [Composer](https://getcomposer.org/) from initial setup step. 

3. **Linting PHP** - If you have composer installed you can add these aliases to your bash/zsh config for easier usage:

    ```bash
    alias phpcs='vendor/bin/phpcs';
    alias phpcbf='vendor/bin/phpcbf';
    ```

4. **Linting PHP** - Here are available scripts to run in your terminal to lint your PHP files:
    
    Checking theme for possible violations:

    ```bash
    wpcs wp-content/themes/f
    ```

    Autofix theme for minor violations:

    ```bash
    wpcbf wp-content/themes/f
    ```

---

## Goint to Production

You can do it manualy using the command from package.json but we prefere using continious integration and we have 2 scripts to help you.

1. Run build script to build production version of assets and composer, run linting and tests:

    ```bash
    bash bin/build.sh
    ```

2. Run build script to build production version of assets and composer.
Builds production ready assets

    ```bash
    bash bin/build.sh
    ```

3. For deployment, we are using [rsync](https://rsync.samba.org/) and [semaphoreci](https://semaphoreci.com/) in our continuous deployment setup. Whatever deployment system you are using you should never copy unnecessary data to the server. We added file `ci-exclude.txt` to exclude unnecessary folders and files on deployment.

---

## Import & Export

Details are located in the `README-project.md` file. Be sure to change the URL according to your project.

---

## Important Notes

This theme uses OOP with namespaces and autoloader. When you add new class in your theme, be sure to run this command to rebuild the composer's autoload class map. The reason why this isn't automatic is that we are folowing modified WordPress coding standards, and not PSR standards, so this has to be done manually.

```bash
composer -o dump-autoload
```

---

## Plugin

When working for a client it may be easier to add every additional functionality to the theme. Since you are using namespaces, this contains all the necessary logic in the theme. You can use plugins of course, but be careful how you are adding extra functionality, so that you don't run in the dependency hell.
If you need to expose certain functionality across the multisite we recommend that you create a plugin.

Plugins should be created using plugin boilerplate, with addition of namespaces and autoloader. We have that also prepared so please check our [Plugin Boilerplate](https://github.com/infinum/wp-boilerplate-plugin).

---

## Who do I talk to?

For questions talk to:

* [ivan.ruzevic@infinum.hr](ivan.ruzevic@infinum.hr)
* [denis.zoljom@infinum.hr](denis.zoljom@infinum.hr)
* [team@eightshift.com](team@eightshift.com)

Infinum WordPress Boilerplate is maintained and sponsored by Infinum and Eightshift.

<img src="https://infinum.co/infinum.png" width="264" height>

---

## License

Infinum WordPress Boilerplate is Copyright ©2018 Infinum. It is free software, and may be redistributed under the terms specified in the LICENSE file.
