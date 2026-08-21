<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Free_Blog
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php 			 
				//Breadcrumb hook
			 	do_action('free_blog_breadcrumb_options_hook'); 
			?>
			

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php

			/* Masonry Start Section */
			do_action('free_blog_masonry_start_hook'); 

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			/* Masonry end Section */
			do_action('free_blog_masonry_end_hook');

			/**
             * free_blog_action_navigation hook
             * @since Free Blog 1.0.0
             *
             * @hooked free_blog_action_navigation -  10
             */
            do_action( 'free_blog_action_navigation');

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar( 'left' );
get_sidebar();
get_footer();
