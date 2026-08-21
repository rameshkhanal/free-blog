<?php
/**
 * Free Blog post Slider Widget
 *
 * @since 1.0.0
 */
if (!class_exists('Free_Blog_Post_Slider')) :

    /**
     * Highlight Post widget class.
     *
     * @since 1.0.0
     */
    class Free_Blog_Post_Slider extends WP_Widget
    {

        function __construct()
        {
            $opts = array(
                'classname' => 'free-blog-post-slider',
                'description' => esc_html__('Display post in Slider Form. Suitable on Sidebars.', 'free-blog'),
            );

            parent::__construct('free-blog-post-slider', esc_html__('Free Blog Post Slider', 'free-blog'), $opts);
        }


        function widget($args, $instance)
        {
            $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
            echo $args['before_widget'];


            if (!empty($title)) {
                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
            }
            $cat_id = !empty($instance['cat']) ? $instance['cat'] : '';

            $post_number = !empty($instance['post-number']) ? $instance['post-number'] : '';

            $query_args = array(
                'post_type' => 'post',
                'cat' => absint($cat_id),
                'posts_per_page' => absint($post_number),
                'ignore_sticky_posts' => true
            );

            $query = new WP_Query($query_args); ?>
            
            <div class="post-slider-section">            
                <?php if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post();
                        ?>
                            <div class="post-slide-item">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('full'); ?>
                                </a>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <span class="entry-meta">
                                    <?php echo get_the_date(); ?>
                                </span>
                            </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
                  </div>
                <?php 

    
                echo $args['after_widget']; ?>            
          
            <?php 
        }

        function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = sanitize_text_field($new_instance['title']);

            $instance['cat'] = absint($new_instance['cat']);

            $instance['post-number'] = absint($new_instance['post-number']);

            return $instance;

        }

        function form($instance)
        {
            // Defaults.
            $defaults = array(
                'cat' => 0,
                'title' => esc_html__('Recent Posts', 'free-blog' ),
                'post-number' => 5,
            );
            
            $instance = wp_parse_args((array)$instance, $defaults);
            ?>
            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'free-blog'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                       value="<?php echo esc_attr($instance['title']); ?>"/>
            </p>
            <p class="custom-dropdown-posts">
                <label for="<?php echo esc_attr($this->get_field_name('cat')); ?>">
                    <strong><?php esc_html_e('Select Category: ', 'free-blog'); ?></strong>
                </label>
                <?php
                $cat_args = array(
                    'orderby' => 'name',
                    'hide_empty' => 0,
                    'id' => $this->get_field_id('cat'),
                    'name' => $this->get_field_name('cat'),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'selected' => absint($instance['cat']),
                    'show_option_all' => esc_html__('Show Recent Posts', 'free-blog')
                );
                wp_dropdown_categories($cat_args);
                ?>
            </p>

            <p>
                <label
                    for="<?php echo esc_attr($this->get_field_id('post-number')); ?>"><?php esc_html_e('Number of Posts to Display:', 'free-blog'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post-number')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('post-number')); ?>" type="number"
                       value="<?php echo esc_attr($instance['post-number']); ?>"/>
            </p>

        <?php
        }
    }

endif;