<?php
/**
 * Block patterns and block styles.
 *
 * @package Free_Blog
 * @since   Free Blog 1.1.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'free_blog_register_block_patterns' ) ) :
	/**
	 * Register the theme's block patterns on init.
	 */
	function free_blog_register_block_patterns() {

		if ( ! function_exists( 'register_block_pattern' ) ) {
			return;
		}

		if ( function_exists( 'register_block_pattern_category' ) ) {
			register_block_pattern_category(
				'free-blog',
				array( 'label' => esc_html__( 'Free Blog', 'free-blog' ) )
			);
		}

		register_block_pattern(
			'free-blog/standfirst',
			array(
				'title'       => esc_html__( 'Standfirst and body', 'free-blog' ),
				'description' => esc_html__( 'An opening paragraph set larger than the body text, followed by the first section of the article.', 'free-blog' ),
				'categories'  => array( 'free-blog', 'text' ),
				'content'     => '<!-- wp:paragraph {"className":"is-style-free-blog-lead"} --><p class="is-style-free-blog-lead">'
					. esc_html__( 'Open with the sentence a reader would repeat to someone else. One or two lines, no throat-clearing, and the rest of the piece has somewhere to go.', 'free-blog' )
					. '</p><!-- /wp:paragraph -->'
					. '<!-- wp:paragraph --><p>'
					. esc_html__( 'Then the article proper begins. Keep paragraphs short enough to scan and long enough to say something.', 'free-blog' )
					. '</p><!-- /wp:paragraph -->',
			)
		);

		register_block_pattern(
			'free-blog/two-up',
			array(
				'title'       => esc_html__( 'Two columns with headings', 'free-blog' ),
				'description' => esc_html__( 'Two side-by-side columns, each with a subheading, for comparing two things.', 'free-blog' ),
				'categories'  => array( 'free-blog', 'columns' ),
				'content'     => '<!-- wp:columns --><div class="wp-block-columns">'
					. '<!-- wp:column --><div class="wp-block-column">'
					. '<!-- wp:heading {"level":3} --><h3 class="wp-block-heading">' . esc_html__( 'What it does well', 'free-blog' ) . '</h3><!-- /wp:heading -->'
					. '<!-- wp:paragraph --><p>' . esc_html__( 'Describe the first side here.', 'free-blog' ) . '</p><!-- /wp:paragraph -->'
					. '</div><!-- /wp:column -->'
					. '<!-- wp:column --><div class="wp-block-column">'
					. '<!-- wp:heading {"level":3} --><h3 class="wp-block-heading">' . esc_html__( 'Where it falls short', 'free-blog' ) . '</h3><!-- /wp:heading -->'
					. '<!-- wp:paragraph --><p>' . esc_html__( 'And the second side here.', 'free-blog' ) . '</p><!-- /wp:paragraph -->'
					. '</div><!-- /wp:column -->'
					. '</div><!-- /wp:columns -->',
			)
		);

		register_block_pattern(
			'free-blog/quote-break',
			array(
				'title'       => esc_html__( 'Quotation break', 'free-blog' ),
				'description' => esc_html__( 'A quotation with attribution, set between two sections of an article.', 'free-blog' ),
				'categories'  => array( 'free-blog', 'text' ),
				'content'     => '<!-- wp:quote --><blockquote class="wp-block-quote">'
					. '<!-- wp:paragraph --><p>'
					. esc_html__( 'A quotation earns its place by saying something in a voice the article cannot borrow.', 'free-blog' )
					. '</p><!-- /wp:paragraph -->'
					. '<cite>' . esc_html__( 'Name, role', 'free-blog' ) . '</cite>'
					. '</blockquote><!-- /wp:quote -->',
			)
		);
	}
endif;
add_action( 'init', 'free_blog_register_block_patterns' );

if ( ! function_exists( 'free_blog_register_block_styles' ) ) :
	/**
	 * Register the theme's block styles.
	 */
	function free_blog_register_block_styles() {

		if ( ! function_exists( 'register_block_style' ) ) {
			return;
		}

		register_block_style(
			'core/paragraph',
			array(
				'name'  => 'free-blog-lead',
				'label' => esc_html__( 'Lead paragraph', 'free-blog' ),
			)
		);

		register_block_style(
			'core/group',
			array(
				'name'  => 'free-blog-boxed',
				'label' => esc_html__( 'Boxed note', 'free-blog' ),
			)
		);

		register_block_style(
			'core/list',
			array(
				'name'  => 'free-blog-plain-list',
				'label' => esc_html__( 'Ruled list', 'free-blog' ),
			)
		);
	}
endif;
add_action( 'init', 'free_blog_register_block_styles' );
