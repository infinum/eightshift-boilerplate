
# Change Log for the Eightshift Boilerplate
All notable changes to this project will be documented in this file.

This projects adheres to [Semantic Versioning](https://semver.org/) and [Keep a CHANGELOG](https://keepachangelog.com/).

## [12.0.0]

### Update
- Boilerplate is clean and is using only temporary files used for the initial setup. After running the setup, the temporary files are removed and replaced with the actual files.

## [11.0.0]

This is a major release that includes PHP8+ support. We tested it on the PHP 8.2.12 version.

### Updated
- Composer packages.
- Npm packages.
- Composer command names.

### Changed
- PHP version requirement.

## [10.0.0]

### Changed
- updated default 404 a bit (might make a component for it, though).
- cleaned up header and footer, replaced with new reusable components.

## [9.0.0]

- Full change log can be checked on Github [frontend-libs release](https://github.com/infinum/eightshift-frontend-libs/releases/tag/8.0.0) and [libs release](https://github.com/infinum/eightshift-libs/releases/tag/6.4.0).

### Fixed
- Fixes the BrowserslistError thrown on the npm start command.

## [8.0.0]

- Updating packages.
- Full change log can be checked on Github [frontend-libs release](https://github.com/infinum/eightshift-frontend-libs/releases/tag/7.0.0) and [libs release](https://github.com/infinum/eightshift-libs/releases/tag/6.0.0).

## [7.0.0]

- Major braking changes do to updates on css variables, and helpers and updating min PHP version to 7.4.
- Full change log can be checked on Github [releases](https://github.com/infinum/eightshift-frontend-libs/releases/tag/6.0.0).

## [6.0.0]

- Major braking changes do to updates on css variables, and helpers.

## [5.0.1]

### Removed
- Removed package-lock.json
- Removed composer.lock
- Removed version number from composer.json

## [5.0.0]

MAYOR BREAKING CHANGES

- You should not try to update from version 4 to 5 because they are not compatible.

## [4.3.0]

### Changed
- `Eightshift-frontend-libs` update.
- `Eightshift-libs` update.
- `composer.json` updated packages, fixing scripts names.

## [4.2.2]

### Changed
- `Eightshift-frontend-libs` update.
- `Eightshift-libs` update.

## [4.2.1]

### Changed
- `Eightshift-frontend-libs` update.
- `Eightshift-libs` update.
* Modified const name in wp-config-project.php from ES_ENV to EB_ENV to be consistent with the rest of the project.
* Added eslint rule to ignore external dependencies from @eightshift/frontend-libs.

## [4.2.0]

### Removed
- Removed `Config` dependency from enqueue classes.
- Removed .babelrc file.

### Added
- Added babel.config.js

**BRAKING CHANGES:**
- Please replace you old .babelrc file with the new one babel.config.js and convert it from .json to .js format.

## [4.1.0]

### Changed
- Eightshift-frontend-libs update.
- Eightshift-libs update.
- Changing header.php for now libs layout.
- Changing footer.php for now libs layout.

## [4.0.7]

### Changed
- Eightshift-frontend-libs update
- Eightshift-libs update

## [4.0.6]

### Changed
- Eightshift-frontend-libs update
- Eightshift-libs update
- Fixing readme.

## [4.0.5]

### Changed
- Readme Fix

## [4.0.4]

### Changed
- Corrections due to movement all src/blocks/layout/... to src/blocks/components in eightshift-frontend-libs
- Updating composer to latest version of eightshift-libs
- class-modify-admin-appearance.php fixed a typo

## [4.0.3]

### Changed
- Updated eightshift-libs to version 2.0.4
- Updated eightshift-frontend-libs to version 3.0.3
- Updated Webpack
- Updated PostCss
- Updated @eightshift/frontend-libs

## [4.0.1]

### Removed
- postcss-font-magician from package.json

### Changed
- Postcss config from object to array

### Updated
- package.json - @eightshift/frontend-libs to 2.0.4
- composer.json - infinum/eightshift-libs to 2.0.2

## [4.0.0]

### Added
- Implementing Eightshift-libs
- Implementing Eightshift-frontend-libs
- Updating docs
- Adding type hinting
- Updating npm packages
- Global folder structure refactor
- New file for shortcodes
- New file for manifest
- Small changes on project name and description for easy project setup.
- Readme file.
- Versioning.
- package.lock and composer.lock

### Changed
- Complete webpack config refactoring

## [3.0.1]

### Added

- Added code of conduct
- Minor phpcs fixes
- Added changelog
- Added widget class
- Minor updates to setup script
- Added flex grid mixin

### Changed

- phpcs.xml.dist rules name change
- Refactored scss assets
- Minor refactor in excerpt class

### Removed

- Remove jQuery override so that the theme obey wordpress.org rules

### Fixed

- Minor webpack config fix

## [3.0.0]

### Added

- Added setup wizard guide for easier theme setup

### Changed

- Travis update
- phpcs fixes
- Renamed Infinum -> Eightshift, since that is our new brand
- Updates in package.json and composer.json
- phpcs.xml.dist updates
- Added husky for precommit scripts
- Added object helper
- Cleaned assets

### Deprecated

- Boilerplate acts as a standalone theme now

### Removed

- Replaced `file_get_contents` with `file` (for support)

## [2.1.1]

### Added

- Travis integration
- Issue and contributing template
- Change color admin based on the environment (dev, staging, production)
- Added phpcs.xml.dist for the project
- Added validate xml helper for svg uploads
- Added lazy loading images feature

### Changed

- License update
- Small codebase changes
- Changes in @since tags

### Removed

- ACF functionality from the boilerplate
- jQuery webpack exposing due to admin issues

### Fixed

- Autoloader path fix
- Fixed setup script
- Fixed rename script
- Minor phpcs fixes

### Security

## [2.0.1]

### Added

- Locale class for translation handling
- Assets cache busting

### Changed

- Updated readme
- Updated eslintrc
- Updated stylelint
- Updated .gitignore
- Updated coding standards, added composer scripts

### Removed

- Removed ACF class from the boilerplate
- Removed unnecessary register_global_theme_options_variable method that set global variable

## [2.0.0]

This build is a breaking change in comparison to v1.0.0 (procedural -> OOP)

### Added

- Added namespaces, autoloader, webpack 3+
- Added import/export scripts
- Added project setup script
- Added util class
- Added ACF class
- Added theme options and helpers

### Changed

- Changed codebase to OOP
- Readme update
- Updated documentation
- .gitignore file update
- Asset update

### Deprecated

- Removed procedural code and updated the codebase to OOP

### Removed

- Removed jQuery from WP (used webpack to bundle it)

### Fixed

- Rename scripts minor fix with theme package name (shell script)
- Indentation fix

## [1.0.0]

Initial tagged release.

[Unreleased]: https://github.com/infinum/eightshift-boilerplate/compare/master...HEAD

[12.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/11.0.0...12.0.0
[11.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/10.0.0...11.0.0
[10.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/9.0.0...10.0.0
[9.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/8.0.0...9.0.0
[8.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/7.0.0...8.0.0
[7.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/6.0.0...7.0.0
[6.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/5.0.1...6.0.0
[5.0.1]: https://github.com/infinum/eightshift-boilerplate/compare/5.0.0...5.0.1
[5.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/4.3.0...5.0.0
[4.3.0]: https://github.com/infinum/eightshift-boilerplate/compare/4.2.2...v4.3.0
[4.2.2]: https://github.com/infinum/eightshift-boilerplate/compare/4.2.1...v4.2.2
[4.2.1]: https://github.com/infinum/eightshift-boilerplate/compare/4.2.0...v4.2.1
[4.2.0]: https://github.com/infinum/eightshift-boilerplate/compare/4.1.0...v4.2.0
[4.1.0]: https://github.com/infinum/eightshift-boilerplate/compare/4.0.7...v4.1.0
[4.0.7]: https://github.com/infinum/eightshift-boilerplate/compare/4.0.6...v4.0.7
[4.0.6]: https://github.com/infinum/eightshift-boilerplate/compare/4.0.5...v4.0.6
[4.0.5]: https://github.com/infinum/eightshift-boilerplate/compare/4.0.4...v4.0.5
[4.0.4]: https://github.com/infinum/eightshift-boilerplate/compare/4.0.3...v4.0.4
[4.0.3]: https://github.com/infinum/eightshift-boilerplate/compare/4.0.2...v4.0.3
[4.0.2]: https://github.com/infinum/eightshift-boilerplate/compare/4.0.1...v4.0.2
[4.0.1]: https://github.com/infinum/eightshift-boilerplate/compare/4.0.0...v4.0.1
[4.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/3.0.1...v4.0.0
[4.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/3.0.1...v4.0.0
[3.0.1]: https://github.com/infinum/eightshift-boilerplate/compare/3.0.0...3.0.1
[3.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/2.1.1...3.0.0
[2.1.1]: https://github.com/infinum/eightshift-boilerplate/compare/2.0.1...2.1.1
[2.0.1]: https://github.com/infinum/eightshift-boilerplate/compare/2.0.0...2.0.1
[2.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/1.0.0...2.0.0
[1.0.0]: https://github.com/infinum/eightshift-boilerplate/compare/26115acf804876208a03dc39298b70476dcc780f...1.0.0
