=== WAJ Links ===
Contributors: waughjai
Tags: link, html, auto-generate
Requires at least: 4.9.8
Tested up to: 5.0.3
Stable tag: 1.1.1
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Way to mo'-easily create links o' various types in content through PHP & shortcodes.


== Description ==

This plugin includes 6 types o' shortcodes / PHP classes:

=== Link ===

Shortcode: [link href="url"]content[/link]
PHP Class: new WaughJ\HTMLLink\HTMLLink( $href, $content, $other_attributes );

General link where the link href given is used directly as the href. The backbone o' all the other link types.

Content, when put 'tween opening & closing tags, can be a shortcode o' its own, which will be interpreted, too. When used as a PHP class, you can push any object that can be used as a string as content, including other HTML generators.

Valid attributes include all valid HTML5 attributes for the a tag, as well as...
* an "anchor" attribute that adds an anchor to the href ( the part after the # ).
* a "parameters" attribute that adds GET parameters to the href ( i.e. ?first_parameter=second_value&second_parameter=second_value )
* an "external" attribute, which, when set to "true", automatically adds HTML to make the link open in a new tab & protect it from hacking. ( See https://www.jitbit.com/alexblog/256-targetblank---the-most-underestimated-vulnerability-ever/ for mo' info on security concerns ).


=== Mail-Link ===

Shortcode: [mail-link]email[/mail-link] or [mail-link email="email"]Email Me.[/mail-link]
PHP Class: new WaughJ\HTMLMailLink\HTMLMailLink( $email, $other_attributes );

Generates mailto link. If just email given, content automatically set to email.

Valid attributes include "value" for content ( for the direct PHP use ). all valid HTML5 attributes for the a tag, as well as the external attribute mentioned under Link.


=== Phone-Link ===

Shortcode: [phone-link]phone number[/phone-link] or [phone-link tel="phone"]Call us now![/phone-link]
PHP Class: new WaughJ\HTMLPhoneLink\HTMLPhoneLink( $phone_number, $other_attributes );

Generates tel link. If just phone # is given, content automatically set to phone #.

Valid attributes include "value" for content ( for the direct PHP use ). all valid HTML5 attributes for the a tag, as well as the external attribute mentioned under Link.


=== Post-Link ===

Shortcode: [post-link slug="post-slug"] or [post-link slug="post-slug" post_type="specific-post-type"] [post-link post_id="post-id"]Read this post[/post-link]
PHP Class: new WaughJ\WPPostLink\WPPostLink( $attributes );

Generates a link to a post, based on slug or post_id, or, if using the PHP class, the post object itself under "post".

In addition, you can add all the attributes you can for the regular Link class & shortcode.


=== Home-Link ===

Shortcode: [home-link] or [home-link]Visit our home page.[/home-link]
PHP Class: new WaughJ\WPHomeLink\WPHomeLink( $attributes );

Automatically generates link to WordPress front page. Content that represents link defaults to name o' front page. All alternative attributes done the same as regular Link class & shortcode.


=== Category Link ===

Shortcode: [category-link slug="category-slug"] or [category-link category_id="category-id"]Link content[/category-link]
PHP Class: new WaughJ\WPCategoryLink\WPCategoryLink( $attributes );

Automatically generates link to category page. Use slug or category_id attributes to get category. Content & optional attributes added the same way as regular Link class.


=== Tag Link ===

Shortcode: [tag-link slug="category-slug"] or [tag-link slug="category-slug"]Link content[/tag-link]
PHP Class: new WaughJ\WPTagLink\WPTagLink( $attributes );

Automatically generates link to tag page. Use slug to get tag. Content & optional attributes added the same way as regular Link class.


== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Links can be added using shortcode in WordPress editors or directly in PHP by using instances o' classes. Instances o' classes can be automatically casted into strings & used as strings, or you can call getHTML() to get HTML code as string.


== Changelog ==

= 1.1.1 =
* Test up to WordPress 5.0.

= 1.1 =
* Add phone link.

= 1.0 =
* Initial stable version.
