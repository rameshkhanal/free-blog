<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Free_Blog
 */
global $free_blog_theme_options;
$show_content_from = esc_attr($free_blog_theme_options['free-blog-content-show-from']);
$read_more = esc_html($free_blog_theme_options['free-blog-read-more-text']);
$masonry = esc_attr($free_blog_theme_options['free-blog-column-blog-page']);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($masonry); ?>>
	<div class="content-area">
		<?php free_blog_post_thumbnail(); ?>
		<header class="entry-header">
			<?php

			if ( is_singular() ) :

				the_title( '<h1 class="entry-title">', '</h1>' );

			else :

				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					free_blog_posted_on();
					free_blog_posted_by();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
	            <?php
	            if (is_singular()) {
	                the_content();
	            }
	            elseif( $show_content_from == 'hide' ) {
	                wp_trim_words(get_the_content(), 0 );
	            }else{
	            	if ( $show_content_from == 'excerpt' ) {
	                    the_excerpt();
	                } else {
	                    the_content();
	                }
	            }
	            wp_link_pages(array(
	                'before' => '<div class="page-links">' . esc_html__('Pages:', 'free-blog'),
	                'after' => '</div>',
	            ));
	            ?>
	        </div>
	        <!-- .entry-content -->

	        <?php if( !empty( $read_more ) && $show_content_from == 'excerpt' ): ?>
		        <div class="read-more">
		        	<a href="<?php the_permalink(); ?>"><?php echo esc_html($read_more); ?></a>
		        </div>
	    	<?php endif; ?>
		<footer class="entry-footer">
			<?php free_blog_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->