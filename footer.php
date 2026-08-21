<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Free_Blog
 */
global $free_blog_theme_options;
$copyright = wp_kses_post($free_blog_theme_options['free-blog-footer-copyright']);
if ( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') ) {
	    $count = 0;
	    for ( $i = 1; $i <= 4; $i++ )
        {
          if ( is_active_sidebar( 'footer-' . $i ) )
            {
                $count++;
            }
        }

        $footer_col = $count > 0 ? $count : 4;
      }

?>
</div><!-- #content -->
<div class="footer-wrap">
	<div class="container">
		<div class="row">
			<?php
			for ( $i = 1; $i <= 4 ; $i++ ){
				if ( is_active_sidebar( 'footer-' . $i ) )
					{
						?>
						<div class="footer-col-<?php echo absint( $footer_col ); ?>">
							<div class="footer-top-box wow fadeInUp">
								<?php dynamic_sidebar( 'footer-' . $i ); ?>
							</div>
						</div>
						<?php
					}
				}
			?>
		</div>
		<footer id="colophon" class="site-footer">
			<div class="copyright">
				<?php echo wp_kses_post( $copyright ); ?>
			</div>
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'free-blog' ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'free-blog' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
				<?php
				printf(
					/* translators: 1: Theme name, 2: Theme author. */
					esc_html__( 'Theme: %1$s by %2$s.', 'free-blog' ),
					'Free Blog',
					'<a href="' . esc_url( 'https://www.templatesell.com/' ) . '">Template Sell</a>'
				);
				?>
			</div>
		</footer>
		<?php do_action('free_blog_go_to_top_hook'); ?>
		</div><!-- .container -->
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>