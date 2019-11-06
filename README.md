<p align="center">
  <img alt="Eightshift Boilerplate" src="https://raw.githubusercontent.com/infinum/eightshift-frontend-libs/develop/package/logo.svg?raw=true&sanitize=true"/>
</p>

[![Travis](https://img.shields.io/travis/infinum/eightshift-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/eightshift-boilerplate)
[![GitHub tag](https://img.shields.io/github/tag/infinum/eightshift-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/eightshift-boilerplate)
[![GitHub stars](https://img.shields.io/github/stars/infinum/eightshift-boilerplate.svg?style=for-the-badge&label=Stars)](https://github.com/infinum/eightshift-boilerplate/)
[![license](https://img.shields.io/github/license/infinum/eightshift-boilerplate.svg?style=for-the-badge)](https://github.com/infinum/eightshift-boilerplate)

# Eightshift WordPress Boilerplate

This repository contains all the tools you need to start building a modern WordPress project, using all the latest front end development tools.

## :books: Table of contents
- [:mortar_board: Documentation](#mortar_board-documentation)
- [:tada: Awesome features](#tada-awesome-features)
- [:school_satchel: Requirements](#school_satchel-requirements)
- [:rocket: Quick start](#rocket-quick-start)
- [:interrobang: Plugin](#interrobang-plugin)
- [:mailbox: Who do I talk to?](#mailbox-who-do-i-talk-to)
- [:scroll: License](#scroll-license)

## :mortar_board: Documentation
For all documentation details please refere to [Wiki](https://github.com/infinum/eightshift-boilerplate/wiki)

## :tada: Awesome features

Here's why you should use Eightshift Boilerplate for your next project.

- **OOP** - All code is written following the latest object-oriented programming paradigms
- **[Webpack](https://webpack.js.org/)** - Modern bundling & build process
- **[SASS (scss)](https://sass-lang.com/)** - Easy to learn CSS on steroids
- **[Autoprefixing](https://autoprefixer.github.io/)** - Automatically adds vendors prefixes to your CSS
- **[JS Compiler (Babel)](https://babeljs.io/)** - Write JS using the latest features and let webpack worry about making it work accross all browsers
- **Minifying** - Automatically minifies your production assets (JS / CSS) during build process
- **Cache busting** - Each time you build assets, we generate a new URL for each asset file. This means you'll never see the old cached version while developing or after pushing your code to production.
- **[Lazyloading](https://github.com/verlok/lazyload)** - Easily lazyload images / videos / iframes
- **[Synchronised browser testing](https://www.browsersync.io/)**
- **Helps you write better code (automatic code linting)**
  - [phpcs](https://github.com/squizlabs/PHP_CodeSniffer)
  - [eslint](https://eslint.org/)
  - [stylelint](https://stylelint.io/)
- **[Easy font management](https://github.com/jonathantneal/postcss-font-magician)**
- **[Easy SASS media queries](https://github.com/infinum/media-blender)**
2. **[Eightshift Libs](https://github.com/infinum/eightshift-libs)** - Library aimed at bringing the modern development tools to your project.
3. **[Eightshift Blocks](https://github.com/infinum/eightshift-blocks)** - This repository contains all the tools you need to start building a modern Gutenberg dynamic blocks.
4. **[Eightshift Frontend Libs](https://github.com/infinum/eightshift-frontend-libs)** - A collection of useful frontend utility modules.

## :school_satchel: Requirements

1. [Node.js](https://nodejs.org/en/)
2. [Composer](https://getcomposer.org/)

## :rocket: Quick start 

Let's create a new project!

Navigate to your WordPress theme/plugin folder and run the following command:

```
npx create-wp-project
```

Script will prompt you for theme name and local development url (used for BrowserSync) and install a new theme:

![](https://raw.githubusercontent.com/infinum/eightshift-frontend-libs/develop/package/setup.gif)

After the script is finished, you can activate the theme through WP Admin Dashboard. 

To start developing run this command from projects root folder:
```
npm start
```

## :mailbox: Who do I talk to?

If you have any questions or problems, please [open an issue](https://github.com/infinum/eightshift-boilerplate/issues) on github and we will do our best to give you a timely answer.

Eightshift WordPress Boilerplate is maintained and sponsored by
[Eightshift](https://eightshift.com) and [Infinum](https://infinum.co).

## :scroll: License

Infinum WordPress Boilerplate is Copyright ©2019 Infinum. It is free software, and may be redistributed under the terms specified in the LICENSE file.
