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

## Development Using Docker

For development we are using docker

* Install docker `https://docs.docker.com/docker-for-mac/install/`
* `docker-compose.yml` - Config file
  * Update database name
* Run `docker-compose up -d`
  * This will build docker container and image for you to work with
* Run Optional `docker-compose up -d && docker-compose logs -f wordpress`
  * This will build docker container and image for you to work with with WP log output

## Development Start
* `npm start`
  * Builds assets in watch mode using Webpack

## Linting Assets (JS,SASS)
* `npm run precommit`
  * Lints JS and SASS using Webpack

## Linting PHP ##
We are using [WordPress coding standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards) to check php files.

To install it, you need to install [Composer](https://getcomposer.org/) first.

* Open terminal
* `curl -sS http://getcomposer.org/installer | php -- --filename=composer`
* `chmod a+x composer`
* `sudo mv composer /usr/local/bin/composer`

To test if the composer is added succesfully type

`composer --version`

Then install the coding standards in your home folder

`composer create-project wp-coding-standards/wpcs --no-dev`

and add the `wpcs/vendor/bin` to your `PATH` enviroment variable

`export PATH=$PATH:~/wpcs/vendor/bin`

Add this aliases to you bash config:
* `alias wpcs='phpcs --standard=WordPress';`
* `alias wpcbf='phpcbf --standard=WordPress';`
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

## Docker usefull commands ##
* `docker ps -as`
  * List all containers
* `docker stop $(docker ps -aq)`
  * Stop all running containers
* `docker rm $(docker ps -aq)`
  * Remove all containers
* `docker rmi $(docker images -q)`
  * Remove all images
