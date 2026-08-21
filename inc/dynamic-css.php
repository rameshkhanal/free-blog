<?php
/**
 * Dynamic css
 *
 * @since Free Blog 1.0.0
 *
 * @package Free_Blog
 */

if ( ! function_exists( 'free_blog_hex_to_rgba' ) ) :
	/**
	 * Turn a hex colour into an rgba() string.
	 *
	 * Used for the tints the accent needs - a focus ring, a soft fill - which
	 * would otherwise have to be hard-coded and so would stop following the
	 * colour the site owner picked.
	 *
	 * @param string $hex   Hex colour, with or without the leading hash.
	 * @param float  $alpha Opacity between 0 and 1.
	 * @return string An rgba() value, or an empty string if $hex is not a colour.
	 */
	function free_blog_hex_to_rgba( $hex, $alpha = 1 ) {

		$hex = ltrim( (string) $hex, '#' );

		if ( 3 === strlen( $hex ) ) {
			$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
		}

		if ( ! preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
			return '';
		}

		return sprintf(
			'rgba(%d, %d, %d, %s)',
			hexdec( substr( $hex, 0, 2 ) ),
			hexdec( substr( $hex, 2, 2 ) ),
			hexdec( substr( $hex, 4, 2 ) ),
			rtrim( rtrim( number_format( (float) $alpha, 2, '.', '' ), '0' ), '.' )
		);
	}
endif;

if ( ! function_exists( 'free_blog_shade' ) ) :
	/**
	 * Darken a hex colour by a proportion.
	 *
	 * Used for the hover state of the accent-filled controls, so that it
	 * follows the customizer rather than being fixed in the stylesheet.
	 *
	 * @param string $hex    Hex colour, with or without the leading hash.
	 * @param float  $amount How far to move toward black, between 0 and 1.
	 * @return string A hex colour, or an empty string if $hex is not one.
	 */
	function free_blog_shade( $hex, $amount = 0.18 ) {

		$hex = ltrim( (string) $hex, '#' );

		if ( 3 === strlen( $hex ) ) {
			$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
		}

		if ( ! preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
			return '';
		}

		$out = '#';

		foreach ( array( 0, 2, 4 ) as $offset ) {
			$channel = hexdec( substr( $hex, $offset, 2 ) );
			$out    .= str_pad( dechex( (int) round( $channel * ( 1 - $amount ) ) ), 2, '0', STR_PAD_LEFT );
		}

		return $out;
	}
endif;

if ( ! function_exists( 'free_blog_accent_selectors' ) ) :
	/**
	 * Every selector in style.css that is painted with the theme accent.
	 *
	 * The accent used to be repainted in twenty-two places while the stylesheet
	 * hard-codes it in fifty-eight, so changing the colour in the customizer
	 * left the menu, the site title, the pagination, the buttons, the mobile
	 * toggle, the slider dots and the blockquote rule all still green. The list
	 * below is that stylesheet audit, grouped by the property each rule uses.
	 *
	 * @return array Property name => array of selectors.
	 */
	function free_blog_accent_selectors() {

		$post_format_marks = array(
			'article.format-standard .entry-header::after',
			'article.format-image .entry-header::after',
			'article.hentry.sticky .entry-header::after',
			'article.format-video .entry-header::after',
			'article.format-gallery .entry-header::after',
			'article.format-audio .entry-header::after',
			'article.format-quote .entry-header::after',
			'article.format-chat .entry-header::after',
			'article.format-aside .entry-header::after',
			'article.format-link .entry-header::after',
		);

		$selectors = array(

			'color' => array_merge(
				array(
					'a',
					'a:hover',
					'a:focus',
					'a:active',
					'.site-title a',
					'.site-title a:hover',
					'.site-title a:focus',
					'.navbar-nav > li:hover > a',
					'.navbar-nav > li > a:focus',
					'.navbar-nav > li.current > a',
					'.navbar-nav > li.current_page_ancestor > a',
					'.navbar-nav > li.current-menu-item > a',
					'.navbar-nav > li.current-menu-ancestor > a',
					'.entry-footer .cat-links a',
					'.entry-footer .tags-links a',
					'.entry-footer .comments-link a',
					'.entry-footer .edit-link a',
					'.pagination .page-numbers',
					'.pagination .page-numbers:hover',
					'.pagination .page-numbers:focus',
					'.pagination .page-numbers.next',
					'.pagination .page-numbers.prev',
					'.author-profile ul li a:hover:before',
					'.author-profile ul li a:focus:before',
					'.entry-cats a',
					'.entry-cats a:hover',
					'.entry-cats a:focus',
					'.widget a:hover',
					'.widget a:focus',
					'.comment-metadata a:hover',
					'.comment-metadata a:focus',
					'.comment-reply-link',
					'.breadcrumbs a:hover',
					'.breadcrumbs a:focus',
				),
				$post_format_marks
			),

			'background-color' => array(
				'.show-more',
				'.button:hover',
				'.button:focus',
				'input[type="submit"]:hover',
				'input[type="submit"]:focus',
				'button[type="submit"]:hover',
				'button[type="submit"]:focus',
				'.read-more a:hover',
				'.read-more a:focus',
				'.nav-links .nav-previous > a:hover',
				'.nav-links .nav-previous > a:focus',
				'.nav-links .nav-next > a:hover',
				'.nav-links .nav-next > a:focus',
				'.navbar-toggle',
				'.main-menu .navbar-toggle',
				'.pagination .page-numbers.current',
				'.pagination .page-numbers.current:hover',
				'.pagination .page-numbers.current:focus',
				'.slick-dots li.slick-active button',
				'#secondary .widget.widget_search form input[type="submit"]',
				'#toTop',
				'.comment-form input[type="submit"]',
				'button.wp-block-search__button',

				// The short rule under every widget heading, in all three widget
				// areas and in both the classic and the block markup.
				'#secondary h2.widget-title:after',
				'#left-sidebar h2.widget-title:after',
				'.footer-top-box h2.widget-title:after',
				'#secondary .widget_block h2:after',
				'#left-sidebar .widget_block h2:after',
				'.footer-top-box .widget_block h2:after',
				'#secondary .wp-block-heading:after',
				'#left-sidebar .wp-block-heading:after',
				'.footer-top-box .wp-block-heading:after',
				'.error-404 .widget-title:after',
				'.related-pots-block .widget-title:after',
				'#comments #reply-title:after',
			),

			'border-color' => array_merge(
				array(
					'.main-menu .navbar-toggle',
					'#secondary .widget.widget_search form input[type="submit"]',
				),
				$post_format_marks
			),

			'border-left-color' => array(
				'blockquote',
				'.is-style-free-blog-boxed',
			),
		);

		/**
		 * Filter the selectors the accent colour is applied to.
		 *
		 * @since Free Blog 1.1.1
		 *
		 * @param array $selectors Property name => array of selectors.
		 */
		return apply_filters( 'free_blog_accent_selectors', $selectors );
	}
endif;

if ( ! function_exists( 'free_blog_dynamic_css' ) ) :

	/**
	 * Build the inline stylesheet from the customizer settings.
	 */
	function free_blog_dynamic_css() {

		global $free_blog_theme_options;

		$free_blog_font_family   = wp_kses_post( $free_blog_theme_options['free-blog-font-family-name'] );
		$free_blog_font_size     = absint( $free_blog_theme_options['free-blog-font-paragraph-font-size'] );

		// sanitize_hex_color() returns null for anything that is not a hex
		// colour, so a value stored by an older version falls back to the
		// theme default rather than dropping the accent altogether.
		$free_blog_primary_color = sanitize_hex_color( $free_blog_theme_options['free_blog_primary_color'] );

		if ( null === $free_blog_primary_color ) {
			$defaults                = free_blog_default_theme_options_values();
			$free_blog_primary_color = $defaults['free_blog_primary_color'];
		}

		$custom_css = '';

		/* Typography Section */
		if ( ! empty( $free_blog_font_family ) ) {
			$custom_css .= "body { font-family: {$free_blog_font_family}; }";
		}

		if ( ! empty( $free_blog_font_size ) ) {
			$custom_css .= "body { font-size: {$free_blog_font_size}px; }";
		}

		/* Primary Color Section */
		if ( ! empty( $free_blog_primary_color ) ) {

			foreach ( free_blog_accent_selectors() as $property => $selectors ) {
				$custom_css .= sprintf(
					'%1$s { %2$s: %3$s; }',
					implode( ', ', $selectors ),
					$property,
					$free_blog_primary_color
				);
			}

			// The accent-filled controls darken on hover, from the accent itself
			// rather than from a colour fixed in the stylesheet.
			$hover = free_blog_shade( $free_blog_primary_color );

			if ( '' !== $hover ) {
				$custom_css .= sprintf(
					'button.wp-block-search__button:hover, button.wp-block-search__button:focus, .comment-form input[type="submit"]:hover, .comment-form input[type="submit"]:focus, #toTop:hover, #toTop:focus { background-color: %1$s; }',
					$hover
				);
			}

			// A keyboard focus ring that stays visible on any accent, sitting on
			// top of the solid outline the stylesheet draws.
			$ring = free_blog_hex_to_rgba( $free_blog_primary_color, 0.35 );

			if ( '' !== $ring ) {
				$custom_css .= sprintf(
					'a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible, .navbar-toggle:focus-visible, #toTop:focus-visible { box-shadow: 0 0 0 4px %1$s; }',
					$ring
				);
			}
		}

		wp_add_inline_style( 'free-blog-style', $custom_css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'free_blog_dynamic_css', 99 );
