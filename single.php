<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Free_Blog
 */
get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="breadcrumbs">
			<?php 

			//Breadcrumb hook
			 do_action('free_blog_breadcrumb_options_hook'); 
			?>
		</div>
		
			<?php

			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'single' );

				the_post_navigation();

			/**
             * free_blog_related_posts hook
             * @since Free Blog 1.0.0
             *
             * @hooked free_blog_related_posts -  10
             */
			do_action( 'free_blog_related_posts' ,get_the_ID() );

			// If comments are open or we have at least one comment, load up the comment template.

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
</main><!-- #main -->
</div><!-- #primary -->

<?php

get_sidebar( 'left' );
get_sidebar();
get_footer();

