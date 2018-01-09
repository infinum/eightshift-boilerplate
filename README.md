# Development and deployment

## Database
We are using Custom build script for search and replace.
Before start developing ask a lead developer to export you the latest version of database.
Use `_db-*` scripts to export latest database and uploads folder.

## Development environment
  * Feature branch
  * Development is done localy on your computer
  * Create Feature branch from Master and create pull request to Staging branch
  ```
  http://dev.boilerplate.com/
  ```
## Staging server
  * Staging branch
  * QA testing and client tests and approvals
  * Never merge Staging to Master branch.
  ```
  https://staging.boilerplate.com
  ```
## Production server
  * Master branch
  * Create pull request from Feature branch to Master when it is production ready
  * **NO OVERRIDING THE DATABASE**
  ```
  https://boilerplate.com
  ```

## wp-config.php
add this to your `wp-config.php`

```
// Config
define( 'AUTOSAVE_INTERVAL', 240 );
define( 'DISALLOW_FILE_EDIT', true );
define( 'COMPRESS_CSS', true );
define( 'COMPRESS_SCRIPTS', true );
define( 'CONCATENATE_SCRIPTS', true );
define( 'ENFORCE_GZIP', true );
define( 'AUTOMATIC_UPDATER_DISABLED', true );
define( 'WP_POST_REVISIONS', 3 );

define('FORCE_SSL_LOGIN', false); // local false, Staging and production true

// Development
define('FS_METHOD', 'direct');
define('WP_DEBUG', true );
@ini_set('log_errors','On');
@ini_set('display_errors','Off');
@ini_set('error_log','error_log.txt');
```

------------------------------------
