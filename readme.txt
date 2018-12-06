=== Eightshift WordPress Boilerplate ===
Contributors: mustra, dingo_bastard, ivangrginov
Tags: custom-menu, editor-style, featured-images, one-column, theme-options	, translation-ready
Requires at least: 4.4
Requires PHP: 7
Tested up to: 4.9.8
Stable tag: 1.0.0
License: MIT
License URI: https://opensource.org/licenses/MIT

Eightshift WordPress Boilerplate contains all the tools you need to start building a modern WordPress theme, using all the latest front end development tools.

== Description ==

= What is Eightshift WordPress Boilerplate? =

This is an open-source modern boilerplate / starter theme with all the latest dev goodies such as webpack, scss, babel, browsersync, etc.

It is intended for users with at least some dev experience (php and js) and it's a great starting point if you want to build a theme for your own or client's project, to release a theme on WordPress.org or to sell it.

It is NOT an out of the box solution and won't look pretty after your run it the first time. That's not the point. The point is to give you a clean slate to build your own modern theme with no bloat and no unnecessary features that you won't use and will end up slowing your site down. 

= What can you do with it? =

NOTE: This list may look intimidating if you're not familiar with these things but you don't have to worry about most of these things, they're done automatically.

1. [Webpack](https://webpack.js.org/) - Automate all the things and used to power almost everything below.
2. Autoloading using Composer
3. Cache busting - Each time you change an asset file, it's name will be slightly different meaning browsers will always load the latest file version.
4. [Lazy loading](https://github.com/callmecavs/layzr.js) - Just add image URLs as data-normal html attribute instead of of background-image and they will be lazy loaded just before the element enters viewport.
5. [SASS](https://sass-lang.com/) - You will never be able to go back to vanialla CSS again.
6. Minifying - Automatically minifies asset fiels as part of the build process
7. [Autoprefixing](https://github.com/postcss/autoprefixer) - No need to write CSS prefixes for old browsers in SASS, they will automatically be generated as part of the build process.
8. [Browsersync](https://www.browsersync.io/) - Automatically refreshes your page on asset file changes on one or more browsers.
9. [Babel JS transpiling](https://babeljs.io/) - No more googling "is X JS feature supported by Y browser". Write the latest code and Babel will automatically generate browser-compatible JS as part of the build process.
10. Code linting - Easily check your PHP / JS / SCSS code for errors from your code editor. 
11. Font magician / Web Font Loader - Easily load specific local / web fonts. 
Media blender
12. CI build / deploy scripts - Wanna use CI (Continous Integration)? We got you covered.
13. Import / Export scripts

= More Info =

For more information about the Eightshift WordPress Boilerplate and the development process, please visit these links: 

1. Github page - https://github.com/infinum/wp-boilerplate
2. Wiki - https://github.com/infinum/wp-boilerplate/wiki

== Installation ==

= Install & Activate =

Installing the theme is easy. Just follow these steps:

**Installing from WordPress repository:**

After installing the theme (but before activating it), you need to navigate to the theme folder in your terminal and run:

1. From the dashboard of your site, navigate to Themes --> Add New.
2. In the Search type Eightshift WordPress Boilerplate
3. Click Install Now
4. BEFORE activating, you need to run a script that will setup everything. Navigate to the theme's folder using terminal and run 'npm run theme-setup'.
5. After the setup script is finished, activate theme.

**Uploading the .zip file:**

1. From the dashboard of your site, navigate to Themes --> Add New.
2. Select the Upload option and hit "Choose File."
3. When the popup appears select the theme's .zip file from your desktop.
4. Follow the on-screen instructions and wait as the upload completes.
4. BEFORE activating, you need to run a script that will setup everything. Navigate to the theme's folder using terminal and run 'npm run theme-setup'.
5. After the setup script is finished, activate theme.

**From terminal**
1. Open your terminal
2. Navigate to your website's themes folder (wp-content/themes)
3. Run 'npx create-wp-theme'
4. Follow the script instructions
5. After the setup script is finished, activate theme from WordPress Dashboard.

= Requirements =

* PHP 7 or greater (recommended: PHP 7.2 or greater)
* WordPress 4.4 or above (because of the built in REST interface)
* NodeJS
* Composer

== Frequently Asked Questions ==

= I get an error after activating the theme! =
 
Please see the install instructions, you need to run a setup script 'npm run theme-setup' before activating the theme.
 
= How do I do X? =
 
Please check our [wiki on github](https://github.com/infinum/wp-boilerplate/wiki).

== Screenshots ==

1. This is how frontpage looks after theme setup (index page). It's not much but give you a canvas to do anything you want.

== Changelog ==

= 1.0.0 =

Added theme to repository.