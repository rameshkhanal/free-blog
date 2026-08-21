<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Free_Blog
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

global $free_blog_theme_options;
$sidebar_layout = esc_attr($free_blog_theme_options['free-blog-sidebar-blog-page']);
if( $sidebar_layout == "both-sidebar"  ) : ?>
	<aside id="left-sidebar" class="widget-area">
		<div class="sidebar-area">
			<?php dynamic_sidebar( 'left-sidebar' ); ?>
		</div>
	</aside><!-- #secondary -->
<?php endif; 