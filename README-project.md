# Development and deployment

## Database
Before you start developing ask a lead developer to export you the latest version of the database.

## Development environment
  * `feature` branch
  * Development is done localy on your computer
  * Create `feature/feature-name` branch from `master` and create pull request to `staging` branch
  ```
  http://dev.boilerplate.com/
  ```

## Staging server
  * `staging` branch
  * QA testing and client tests and approvals
  * Never merge `staging` to `master` branch.
  ```
  https://staging.boilerplate.com
  ```

## Production server
  * `master` branch
  * Create pull request from `feature` branch to `master` when it is production ready
  * **NO OVERRIDING THE DATABASE**
  ```
  https://boilerplate.com
  ```

## Import & Export
For syncing the production server with staging and development you have 3 shell scripts.
The use [`WP-CLI`](https://wp-cli.org/) so be sure that your server has this module installed.

#### Export:
Once you run this script it will export your database and uploads folder. Everything is compressed and exported in `latest_dump.tar.gz` file in the root of your project.

```bash
bash bin/_db-export.sh
```

#### Import
Once you run this script it will  **delete the current database** and import the new one from `latest_dump.tar.gz` file that must be located in the root of the project.

Uploads folder must be manually moved to the `wp-content` folder.

```bash
bash bin/_db-import-production-to-dev.sh
bash bin/_db-import-production-to-staging.sh
```

## wp-config.php
This is project specific configuration that you can tailor according to your project needs.
At the bottom of the `wp-config.php` file before `require_once ABSPATH . 'wp-settings.php';` add this part:

```php
// Include wp config for your project.
require_once( ABSPATH . 'wp-config-project.php' );
```

And this global variable somewhere before wp-settings and wp-config-project.php. Set what instance you are using.
```php
// Must be set.
// Possible options are develop, staging and production.
define( 'INF_ENV', 'develop' );
```
