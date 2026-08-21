<?php 
/**
 * Free Blog Slider Function
 * @since Free Blog 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('free_blog_slider') ) :
	function free_blog_slider() {
		global $free_blog_theme_options;
		$cat_id = absint($free_blog_theme_options['free-blog-select-category']);
		$slider_num = absint($free_blog_theme_options['free-blog-slider-number']);
		$read_more = esc_html($free_blog_theme_options['free-blog-slider-read-more']);
		$slider_suggest = absint($free_blog_theme_options['free-blog-slider-suggestions']);

		$args = array(
			'posts_per_page' => $slider_num,
			'paged' => 1,
			'cat' => $cat_id,
			'post_type' => 'post'
		);
		$slider_query = new WP_Query($args);
		if ($slider_query->have_posts()):

			?>
			<div class="header-slider">
				<?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
					<div class="slider-items">
						<div class="caption">
							<span><?php echo get_the_date(); ?></span>
							<h2><?php the_title(); ?></h2>
							<?php if( !empty( $read_more ) ): ?>
								<a href="<?php the_permalink(); ?>"><?php echo $read_more; ?></a>
							<?php endif; ?>
						</div>

						<div class="img-holder"><a href="<?php the_permalink(); ?>">
							<?php
							if (has_post_thumbnail()) {
								the_post_thumbnail('free-blog-slider-image');
							}
							?>
						</a>
					</div>

				</div>
			<?php endwhile;
			wp_reset_postdata(); ?>
		</div>
	<?php endif; ?>

	<?php
	$args = array(
		'posts_per_page' => $slider_num,
		'paged' => 1,
		'cat' => $cat_id,
		'post_type' => 'post'
	);
	$slider_query = new WP_Query($args);
	if ($slider_query->have_posts() ):
		?>
        <div class="header-slider-thumbnail">
            <?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
                <?php if( $slider_suggest == 1 ) { ?>
                <div class="slider-items">
                   <?php
                   $categories = get_the_category();
                   if ( ! empty( $categories ) ) {
                      echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'" title="Lifestyle">'.esc_html( $categories[0]->name ).'</a>';
                  }                                 
                  ?>
                  <h4><?php the_title(); ?></h4>
              </div>
              <?php } ?>
          <?php endwhile;
          wp_reset_postdata(); ?>
      </div>
  <?php endif; ?>
  <?php 
} 
endif;
add_action( 'free_blog_slider_hook', 'free_blog_slider', 10 );

/**
 * Add sidebar class in body
 *
 * @since Free Blog 1.0.0
 *
 */

add_filter('body_class', 'free_blog_body_class');
function free_blog_body_class($classes)
{
    $classes[] = 'pt-sticky-sidebar';
    global $free_blog_theme_options;
    $sidebar = esc_attr($free_blog_theme_options['free-blog-sidebar-blog-page']);
    //$layout = esc_attr($free_blog_theme_options['free-blog-column-blog-page']);
    if ($sidebar == 'no-sidebar') {
        $classes[] = 'no-sidebar';
    } elseif ($sidebar == 'left-sidebar') {
        $classes[] = 'left-sidebar';
    } elseif ($sidebar == 'middle-column') {
        $classes[] = 'middle-column';
    } elseif ($sidebar == 'both-sidebar') {
        $classes[] = 'both-sidebar';
    }elseif ($sidebar == 'both-sidebar-content') {
        $classes[] = 'both-sidebar-content';
    }elseif ($sidebar == 'content-both-sidebar') {
        $classes[] = 'content-both-sidebar';
    } else {
        $classes[] = 'right-sidebar';
    }
    return $classes;
}

/**
 * Add layout class in body
 *
 * @since Free Blog 1.0.0
 *
 */

add_filter('body_class', 'free_blog_layout_body_class');
function free_blog_layout_body_class($classes)
{
    global $free_blog_theme_options;
    $layout = esc_attr($free_blog_theme_options['free-blog-column-blog-page']);
    if ($layout == 'masonry-post') {
        $classes[] = 'masonry-post';
    }else {
        $classes[] = 'one-column';
    }
    return $classes;
}

/**
 * Remove ... From Excerpt
 *
 * @since 1.0.0
 */
if ( !function_exists('free_blog_excerpt_more') ) :
    function free_blog_excerpt_more( $more ) {
        if(!is_admin() ){
            return '';
        }
    }
endif;
add_filter('excerpt_more', 'free_blog_excerpt_more');

/**
 * Filter to change excerpt lenght size
 *
 * @since 1.0.0
 */
if ( !function_exists('free_blog_alter_excerpt') ) :
    function free_blog_alter_excerpt( $length ){
        if(is_admin() ){
            return $length;
        }
        global $free_blog_theme_options;
        $excerpt_length = absint($free_blog_theme_options['free-blog-excerpt-length']);
        if( !empty( $excerpt_length ) ){
            return $excerpt_length;
        }
        return 50;
    }
endif;
add_filter('excerpt_length', 'free_blog_alter_excerpt');


/**
 * Post Navigation Function
 *
 * @since Free Blog 1.0.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('free_blog_posts_navigation') ) :
    function free_blog_posts_navigation() {
        global $free_blog_theme_options;
        $free_blog_pagination_option = $free_blog_theme_options['free-blog-pagination-options'];
        if( 'default' == $free_blog_pagination_option ){
            the_posts_navigation();
        }elseif('numeric' == $free_blog_pagination_option){
            echo"<div class='pagination'>";
            global $wp_query;
            $big = 999999999; // need an unlikely integer
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'prev_text' => __('&laquo; Prev', 'free-blog'),
                'next_text' => __('Next &raquo;', 'free-blog'),
            ));
            echo "<div>";
        }
        elseif('ajax' == $free_blog_pagination_option){
        	$page_number = get_query_var('paged');
            if( $page_number == 0 ){
                $output_page = 2;
            }
            else{
                $output_page = $page_number + 1;
            }
            echo "<div class='show-more' data-number='$output_page'><i class='fa fa-refresh'></i>".__('View More','free-blog')."</div><div id='free-temp-post'></div>"; 
        }else{
            return false;
        }
    }
endif;
add_action( 'free_blog_action_navigation', 'free_blog_posts_navigation', 10 );

/**
 * Display related posts from same category
 *
 * @since Free Blog 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if ( !function_exists('free_blog_related_post') ) :

    function free_blog_related_post( $post_id ) {

        global $free_blog_theme_options;
        $title = esc_html( $free_blog_theme_options['free-blog-single-page-related-posts-title']); 
        if( 0 == $free_blog_theme_options['free-blog-single-page-related-posts'] ){
            return;
        }
        $categories = get_the_category( $post_id );
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
             $category_ids = array();
             $category = get_category($category_ids);
             $categories  = get_the_category( $post_id );
	            foreach ( $categories as $category ){
	                $category_ids[]  = $category->term_id;			              
	            }
            $count = $category->category_count;
            if($count > 1 ){
            ?>
            <div class="related-pots-block">
                <h2 class="widget-title">
                    <?php echo $title; ?>
                </h2>
                <ul class="related-post-entries clear">
                    <?php
                    $free_blog_cat_post_args = array(
                        'category__in'       => $category_ids,
                        'post__not_in'       => array($post_id),
                        'post_type'          => 'post',
                        'posts_per_page'     => 2,
                        'post_status'        => 'publish',
                        'ignore_sticky_posts'=> true
                    );
                    $free_blog_featured_query = new WP_Query( $free_blog_cat_post_args );

                    while ( $free_blog_featured_query->have_posts() ) : $free_blog_featured_query->the_post();
                        ?>
                        <li>
                            <div class="related-col">
                                <?php
                                if ( has_post_thumbnail() ):
                                    ?>
                                    <figure class="widget-image">
                                        <a href="<?php the_permalink()?>">
                                            <?php the_post_thumbnail('full'); ?>
                                        </a>
                                    </figure>
                                    <?php
                                endif;
                                ?>
                                <div class="featured-desc">
                                    <a href="<?php the_permalink()?>">
                                        <h2 class="title"> <?php the_title(); ?></h2>
                                    </a>
                                </div>
                                <div class="related-date">
                                    <?php echo get_the_date(); ?>
                                </div>
                            </div>
                        </li>
                         <?php
                    endwhile;
                 wp_reset_postdata();
                 ?>
             </ul>
         </div> <!-- .related-post-block -->
         <?php
            }
     }
 }
endif;
add_action( 'free_blog_related_posts', 'free_blog_related_post', 10, 1 );


/**
 * Goto Top functions
 *
 * @since Free Blog 1.0.0
 *
 */

if (!function_exists('free_blog_go_to_top')) :
    function free_blog_go_to_top()
    {
        global $free_blog_theme_options;
        $to_top = $free_blog_theme_options['free-blog-go-to-top'];
        if( $to_top == 1 ){ 
            ?>
            <a id="toTop" class="go-to-top" href="#" title="<?php esc_attr_e('Go to Top', 'free-blog'); ?>">
                <i class="fa fa-angle-up"></i>
            </a>
            <?php } else{
                return false;
            }
    } endif;
add_action( 'free_blog_go_to_top_hook', 'free_blog_go_to_top', 10, 1 );

/**
 * Masonry Start Class and Id functions
 *
 * @since Free Blog 1.0.0
 *
 */
if (!function_exists('free_blog_masonry_start')) :
    function free_blog_masonry_start()
    { ?>
        <div class="masonry-start"><div id="masonry-loop">

<?php 
}
endif;
add_action( 'free_blog_masonry_start_hook', 'free_blog_masonry_start', 10, 1 );

/**
 * Masonry end Div
 *
 * @since Free Blog 1.0.0
 *
 */
if (!function_exists('free_blog_masonry_end')) :
    function free_blog_masonry_end()
    { ?>
        </div>
    </div>

<?php 
}
endif;
add_action( 'free_blog_masonry_end_hook', 'free_blog_masonry_end', 10, 1 );


/**
 * Functions to manage breadcrumbs
*/
if (!function_exists('free_blog_breadcrumb_options')) :
function free_blog_breadcrumb_options(){
    global $free_blog_theme_options;
    if( 1 == $free_blog_theme_options['free-blog-extra-breadcrumb']){
        free_blog_breadcrumbs();
    }
}
endif;
add_action('free_blog_breadcrumb_options_hook', 'free_blog_breadcrumb_options');

/**
 * BreadCrumb Settings
 */
if( ! function_exists( 'free_blog_breadcrumbs' ) ):
    function free_blog_breadcrumbs() {
        if ( ! function_exists( 'free_blog_breadcrumb_trail' ) ) {
            require get_template_directory() . '/inc/breadcrumbs/breadcrumbs.php';
        }
        $breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false
        );
       global $free_blog_theme_options;

        $free_blog_you_are_here_text = esc_html( $free_blog_theme_options['free-blog-breadcrumb-text'] );
        if( !empty( $free_blog_you_are_here_text ) ){
            $free_blog_you_are_here_text = "<span class='breadcrumb'>".$free_blog_you_are_here_text."</span>";
        }
        echo "<div class='breadcrumbs init-animate clearfix'>".$free_blog_you_are_here_text."<div id='free_blog-breadcrumbs' class='clearfix'>";
        free_blog_breadcrumb_trail( $breadcrumb_args );
        echo "</div></div>";
    }
endif;
add_action('free_blog_breadcrumbs_hook', 'free_blog_breadcrumbs');
