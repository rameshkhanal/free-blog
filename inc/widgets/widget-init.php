<?php

if ( ! function_exists( 'free_blog_load_widgets' ) ) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function free_blog_load_widgets() {

        // Highlight Post.
        register_widget( 'Free_Blog_Featured_Post' );

        // Author Widget.
        register_widget( 'Free_Blog_Author_Widget' );
		
		// Social Widget.
        register_widget( 'Free_Blog_Social_Widget' );
        
        // Post Slider
        register_widget('Free_Blog_Post_Slider');

    }

endif;
add_action( 'widgets_init', 'free_blog_load_widgets' );


