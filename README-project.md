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

## wp-config.php
At the bottom of the `wp-config.php` file before `require_once ABSPATH . 'wp-settings.php';` add this part:

```php
// Include wp config for your project.
require_once( ABSPATH . 'wp-config-project.php' );
```
This is project specific configuration that you can tailor to your project needs.

------------------------------------
