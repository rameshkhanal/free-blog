=== Free Blog ===

Contributors: akithemes
Theme URI: https://www.templatesell.com/item/free-blog-plus/
Author URI: https://www.templatesell.com/
Tags: blog, news, custom-background, custom-header, one-column, two-columns, three-columns, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready, post-formats
Requires at least: 6.0
Tested up to: 7.1
Stable tag: 1.1.1
Requires PHP: 7.4
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Free Blog is simple, clean and elegant Free WordPress Theme for your blog site. This theme comes with a slider, a masonry layout, a double column layout, copyright options, social options and many more features. In addition this theme has added custom widget for recent post, author and social menu. Use this awesome WordPress theme for your blog site, you will never look for alternative. Demo: http://demo.akithemes.com/free-blog

== Description ==

Free Blog is simple, clean and elegant Free WordPress Theme for your blog site. This theme comes with a slider, a masonry layout, a double column layout, copyright options, social options and many more features. In addition this theme has added custom widget for recent post, author and social menu. Use this awesome WordPress theme for your blog site, you will never look for alternative. Demo: http://demo.akithemes.com/free-blog

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload Theme and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= Does this theme support any plugins? =

Free Blog includes support for Infinite Scroll in Jetpack.

== Changelog ==
= 1.1.1 - August 21 2026 =

Design
* Refreshed the whole design: a cool off-white page, white panels with a hairline edge and a small radius, and one type scale from the kicker to the headline
* Body text is now 16px with a 1.75 line height; headings are set in a darker, higher-contrast navy
* A post's categories now appear as a coloured kicker above the headline instead of buried under the excerpt
* Post thumbnails are cropped to a single 16:9 ratio, so a portrait photograph and a landscape one make the same card
* Pagination is a row of circles with the current page filled in
* Sidebar and footer widgets sit in their own panels, with a shorter, wider-spaced heading rule
* The footer is no longer pure black under a pale page; it is the same family as everything above it
* The 404 page now uses the same panel and headings as the rest of the site instead of browser defaults
* Related posts are laid out as two equal columns with one image ratio
* The slider caption is legible whether or not the post has a featured image, and "Read More" is a button

Fixed
* The PHP 8.2 "Creation of dynamic property" deprecation that was logged on every single page view
* An unclosed div in the numeric pagination that nested the rest of the page inside it
* The thumbnail strip under the header slider, which was pushed off the left edge of the screen
* Related posts appeared or vanished according to an unrelated category count; the query decides now
* The sticky header class was never applied, because scrollTop was compared without being called
* Parent menu items could not be followed: their default was prevented on every screen size
* The excerpt filter returned nothing in the admin, leaving the editor with no ellipsis
* The tag and category counts in the sidebar, and the widget headings, had not been styled since WordPress moved widgets to blocks in 5.8

Performance
* Fonts are served from the theme instead of being fetched from Google on every page view
* The slider ran the same database query twice on every front page load; it runs once
* Registered the slider and related-post image sizes the templates were already asking for, instead of serving full-size originals
* The widget helper script and the whole media library modal no longer load on every admin screen
* Corrected the versions reported for Bootstrap, Font Awesome, Slick and Theia so caches bust when they should

Accessibility
* Submenus now open on keyboard focus, not on hover alone
* The menu toggles, the search toggle and "View More" are real buttons with names and states
* Visible keyboard focus, a working skip link, and a reduced-motion preference
* Post navigation links say which way they go
* Raised the contrast of every button and of the post meta, which failed at under 2:1

Editor
* Added editor styles so writing a post looks like reading one
* Added three block patterns and three block styles
* Added support for align-wide, responsive embeds and wp-block-styles

Other
* The Primary Color option now repaints every element that uses the accent, not a fifth of them
* Hardened the plugin-install AJAX handler: input is sanitised and the capability is checked first
* Added a languages directory and a POT file
* The default footer copyright no longer has a year baked into a translatable string
* Tested with WordPress 7.1 and PHP 8.3

= 1.1.0 - September 08 2022 =
* Fixed customizer issue

= 1.0.8 - December 22 2019 =
* TGM Plugin Recommendation Removed
* Aki Toolset Added for the demo
* Checked with Latest WP version

= 1.0.8 - August 27 2019 =
* Added Plugin Recommendation
* One Click Demo Import Added
* Delete unwanted file image.php
* Fixed single image php error

= 1.0.7 - August 18 2019 =
* Tested Skip Links
* wp_body_open function added
* Readme validate
* Checked with latest WP Version
* Tested with Gutenberg Editor

= 1.0.6 - January 04 2019 =
* Upgrade to pro added
* Checked on latest WP Version

= 1.0.5 - January 04 2019 =
* Theme URI Changed

= 1.0.4 - November 12 2018 =
* Theme uri and author uri added

= 1.0.3 - November 12 2018 =
* License of the images added

= 1.0.2 - November 11 2018 =
* Image url added for screenshot
* Screenshot image changed

= 1.0.1 - November 5 2018 =
* Image url added for screenshot

= 1.0.0 - August 27 2018 =
* Initial release

== Credits ==

Free Blog is free WordPress theme by, Aki Themes.
Free Blog is distributed under the terms of the GNU GPL v2 or later.


* Based on Underscores https://underscores.me/, (C) 2012-2017 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)
* BreadcrumbTrail, Copyright (c) 2008 - 2015, Justin Tadlock http://themehybrid.com/plugins/breadcrumb-trail
* Theia Sticky Sidebar https://github.com/WeCodePixels/theia-sticky-sidebar [MIT license]
* Slick Slider https://github.com/kenwheeler/slick/blob/master/LICENSE [The MIT License (MIT)]
* Bootstrap https://github.com/twbs/bootstrap Bootstrap 3.3.7, Copyright 2011-2016 Twitter, Inc., [MIT](https://opensource.org/licenses/MIT)
* Raleway, Italianno and Niconne webfonts, Copyright The Raleway Project Authors / Robert Leuschke, [SIL Open Font License 1.1](https://scripts.sil.org/OFL)
* Font-Awesome https://github.com/FortAwesome/Font-Awesome FontAwesome 4.6.3 Copyright 2012 Dave Gandy Font License: SIL OFL 1.1 Code License: MIT License http://fontawesome.io/license/

== Images Use in Screenshot ==
* CCO Images used