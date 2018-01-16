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
on the bottom of the `wp-config.php` befor wp-settings require add this part:
```
// Include wp config for your project.
require_once(ABSPATH . 'wp-config-project.php');
```
This is project specific configuration that you can tailor to your projects needs.

------------------------------------
