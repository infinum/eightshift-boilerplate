=== JSON post parser ===
Contributors: dingo_bastard
Tags: post, parser, content
Requires at least: 4.4
Tested up to: 4.8.3
Stable tag: 1.0.0
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

JSON Post Parser plugin parses your content and saves it as JSON available in REST posts and pages endpoints.

== Description ==

When working on decoupled WordPress, while using one of the popular frameworks or libraries such as React, post content in pure HTML can be a bit of a problem. Having absolute links that point to the on-site resource would cause a page refresh. Which defeats the purpose of building with, for instance, React, which uses Link component to handle routes.
This is where having post served as JSON simplifies things, in that you can find all the links, and then replace them with the appropriate router alternative.

When you create a post and then save it, the parser will go through your rendered post and parse it in JSON, which will then be saved in `post_content_json` table in the `posts` table.
Other than parsing the post, this plugin registers the additional REST field called `post_content_json` which you can fetch by going to `wp-json/wp/v2/posts/` or `wp-json/wp/v2/pages/`.

If you want to expose your own custom post types to the REST endpoint, use the filter `json_wp_post_parser_add_post_types`.

== Installation ==

1. Place `json-wp-post-parser` folder in the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Will all my posts automatically be parsed? =

No. Upon plugin activation, you will see a prompt that will ask you if you want to update all your posts, pages, custom post types.
If you say yes, you'll be sent to a page where you'll see all your posts being resaved using AJAX.
The reason for this is that someone can have 1000+ posts, and doing bulk upgrade would fail (exhausted memory, timeout etc.).
By using AJAX we can trigger post saving asynchronously, which doesn't overload the system.

= How can I add my custom post types, so that rest route has it as well? =

There is a built in filter hook which you can use called `json_wp_post_parser_add_post_types`. Say you have custom post type called `books`,
you'd add them like this:

```php
add_filter( 'json_wp_post_parser_add_post_types', 'my_slug_add_cpt_to_parser' );

function my_slug_add_cpt_to_parser( $post_types ) {
  // the $post_types parameter is an array of all post_types from the api_fields_init() method.
  $post_types[] = 'books';
  return $post_types;
}
```

== Possible issues ==

When using post update to update all your posts, the default number of posts that are queried is 5000. This is done to optimize query performance. Because you should never use `'posts_per_page' => -1`. If you have more than 5000 posts then open `class-json-wp-post-parser-admin.php` and change this number on line 84.

== Changelog ==

= 1.0 =
* Initial release

== Credits ==

JSON post parser  is maintained and sponsored by
[Infinum](https://www.infinum.co).

<img src="https://infinum.co/infinum.png" width="264">

== License ==

JSON post parser is Copyright © 2017 Infinum. It is free software, and may be redistributed under the terms specified in the LICENSE file.
