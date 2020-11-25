=== WP Slideshow Posts ===
Contributors: Bobjmp
Tags: WP Slideshow Posts, slides, slideshow, responsive slideshow, wp slideshow, slideshow posts, image gallery, images, gallery, featured content, content gallery, slideshow gallery
Requires at least: 3.0
Tested up to: 3.8
Stable tag: 1.0
License: GPLv2 or later

Show your posts on a responsive slideshow

== Description ==

WP Slideshow Post uses the title, abstract and images of posts on wordpress blog and turns into a responsive slideshow.

After inserting the piece of code in your template you can on/off in the setting page.

You can also choose colors, number of posts and which show posts (recent posts, popular posts, a category, by ID or pages).

= Full slideshow = 

Uses the featured image or the first image of the post along with the title and abstract.

* To do this simply insert a small piece of code in your template

`<Php if (function_exists ('wpsp_Slideshow')) {wpsp_Slideshow();}?>`

* You can also insert shortcodes within your posts

`[WPSP-slideshow]`

= Small slideshow = 

A small bar titles without images, without abstract with only the title of the latest posts in each category, style breaking news.

* insert preferably at the top of your template.

`<Php if (function_exists ('wpsp_breakingnews')) {wpsp_breakingnews ();}?>`

== Installation ==

1. Unpack to obtain the 'wp-slideshow-posts' folder
2. Upload 'wp-slideshow-posts' to the '/wp-content/plugins/' directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Configure the settings according to your needs on menu 'Settings > WP Slideshow Posts'

= Use one of three options to add full slideshow in blog =

* Insert code in template place display:

`<?Php if ( function_exists( 'wpsp_Slideshow' ) ) { wpsp_Slideshow(); } ?>`

* Or insert shortcodes in template place display:

`<?php do_shortcode( '[slideshow-wpsp]' ); ?>`

* Add shortcodes into the post:

`[slideshow-wpsp]`

= Use the code below to show a small slide with recent posts by category =

`<?Php if ( function_exists( 'wpsp_breakingnews' ) ) { wpsp_breakingnews(); } ?>`

== Frequently Asked Questions ==

= I use multiple slideshow in my blog? =

_ Yes, but only one per page.

= I use full slideshow and small slideshow together on the same page? =

_ yes

== Screenshots ==

1. Small slide title bar

2. Full slide with image and summary

== Changelog ==

= 1.0 =
* Initial release of the WP Slideshow Posts.
