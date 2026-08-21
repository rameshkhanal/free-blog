<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Free_Blog
*/
global $free_blog_theme_options;
$enable_header = absint($free_blog_theme_options['free_blog_enable_top_header']);
$enable_menu = absint($free_blog_theme_options['free_blog_enable_top_header_menu']);
$enable_social = absint($free_blog_theme_options['free_blog_enable_top_header_social']);
$enable_search = absint($free_blog_theme_options['free_blog_enable_top_header_search']);
$enable_slider = absint($free_blog_theme_options['free_blog_enable_slider']);

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'free-blog' ); ?></a>
	<?php if( $enable_header == 1 ){ ?>
		<div class="header-top-section">
			<div class="container">
				<?php if( $enable_menu == 1 ) { ?>
					<nav id="top-nav" class="main-navigation top-nav" aria-label="<?php esc_attr_e( 'Secondary menu', 'free-blog' ); ?>">
						<div class="navbar-header">
							<!-- Toggle Button -->
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".collapse-top-menu" aria-expanded="false" aria-controls="header-menu"><span class="screen-reader-text"><?php esc_html_e( 'Menu', 'free-blog' ); ?></span>
								<span class="icon-bar" aria-hidden="true"></span>
								<span class="icon-bar" aria-hidden="true"></span>
								<span class="icon-bar" aria-hidden="true"></span>
							</button>
						</div>
						<div class="navbar-collapse collapse collapse-top-menu">
							<?php
							if (has_nav_menu('top'))
							{
								wp_nav_menu( array(
									'theme_location' => 'top',
									'menu_id'        => 'header-menu',
									'container' => 'ul',
									'menu_class'      => 'nav navbar-nav'
								) );
							}
							?>
						</div>
					</nav><!-- .top-nav -->
				<?php } ?>
				<?php if( $enable_search == 1 ){ ?>
					<div class="search-wrapper">
						<button type="button" class="search-toggle" aria-expanded="false">
								<i class="fa fa-search" aria-hidden="true"></i>
								<span class="screen-reader-text"><?php esc_html_e( 'Search', 'free-blog' ); ?></span>
							</button>
						<div class="search-form-wrapper">
							<?php
							echo get_search_form();
							?>
						</div>
					</div>
				<?php } ?>
				<?php if( $enable_social == 1 ){ ?>
					<span class="social-icons">
						<?php
						if (has_nav_menu('social'))
						{
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_id'        => 'social-menu',
								'menu_class'     => 'free-blog-social-menu',
							) );
						}
						?>
					</span>
				<?php } ?>

			</div>
		</div>
	<?php } ?>
	<header id="masthead" class="site-header">
		<div class="container">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$free_blog_description = get_bloginfo( 'description', 'display' );
			if ( $free_blog_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo wp_kses_post( $free_blog_description ); ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->
	</div>
</header><!-- #masthead -->
<div class="main-menu">
	<div class="container">
		<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'free-blog' ); ?>">
			<div class="navbar-header">
				<!-- Toggle Button -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".collapse-main-menu" aria-expanded="false" aria-controls="primary-menu"><span class="screen-reader-text"><?php esc_html_e( 'Menu', 'free-blog' ); ?></span>
					<span class="icon-bar" aria-hidden="true"></span>
					<span class="icon-bar" aria-hidden="true"></span>
					<span class="icon-bar" aria-hidden="true"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse collapse-main-menu">
				<?php
				if (has_nav_menu('menu-1'))
				{
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container' => 'ul',
						'menu_class'      => 'nav navbar-nav'
					));
				}
				?>
			</div>
		</nav><!-- #site-navigation -->
	</div>
</div>
<section class="banner-slider">
	<div class="header-image">
		<?php if( has_header_image() ){ ?>
			<img src="<?php echo esc_url( get_header_image() ); ?>" alt="" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" />
		<?php }
		else{
			// hook to display the slider - custom functions file
			if( $enable_slider == 1 && (is_home() || is_front_page()) ){
				do_action('free_blog_slider_hook');
			}
		}
		?>
	</div><!-- .header-image -->
</section>


<div id="content" class="site-content">
	<div class="container">
