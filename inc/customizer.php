<?php

/**

 * Free Blog Theme Customizer

 *

 * @package Free_Blog

 */

if ( !function_exists('free_blog_default_theme_options_values') ) :

    function free_blog_default_theme_options_values() {



        $default_theme_options = array(
            /*Top Header Section Default Value*/
            'free_blog_primary_color' => '#128551',

        	/*Top Header Section Default Value*/
        	'free_blog_enable_top_header'=>0,
        	'free_blog_enable_top_header_social'=>0,
        	'free_blog_enable_top_header_search'=>0,
            'free_blog_enable_top_header_menu'=>0,

        	/*Slider Section Default Value*/
        	'free_blog_enable_slider' => 0,
        	'free-blog-select-category'=> 0,
        	'free-blog-slider-number'=>3,
        	'free-blog-slider-read-more'=> esc_html__('Read More','free-blog'),
        	'free-blog-slider-suggestions'=> 1,

        	/*Blog Page Default Value*/
        	'free-blog-sidebar-blog-page'=>'right-sidebar',
        	'free-blog-column-blog-page'=> 'one-column',
        	'free-blog-content-show-from'=>'excerpt',
        	'free-blog-excerpt-length'=>25,
        	'free-blog-pagination-options'=>'numeric',
        	'free-blog-read-more-text'=> esc_html__('Read More','free-blog'),

            /*Single Page Default Value*/
        	'free-blog-single-page-featured-image'=> 1,
        	'free-blog-single-page-related-posts'=> 1,
        	'free-blog-single-page-related-posts-title'=> esc_html__('Related Posts','free-blog'),

            /*Sticky Sidebar Options*/
        	'free-blog-enable-sticky-sidebar'=> 1,

            /*Footer Section*/
        	'free-blog-footer-copyright' => sprintf(
        		/* translators: %s: the current year. */
        		esc_html__( 'All Rights Reserved %s', 'free-blog' ),
        		date_i18n( 'Y' )
        	),
        	'free-blog-go-to-top'=> 1,

            /*Font Options*/
        	'free-blog-font-family-url'=> '',
        	'free-blog-font-family-name'=> 'Raleway, sans-serif',
        	'free-blog-font-paragraph-font-size'=>16,

            /*Extra Options*/
            'free-blog-extra-breadcrumb'=> 1,
            'free-blog-breadcrumb-text'=>  esc_html__('You are Here','free-blog')
        );

        return apply_filters( 'free_blog_default_theme_options_values', $default_theme_options );

    }

endif;

/**

 *  Free Blog Theme Options and Settings

 *

 * @since Free Blog 1.0.0

 *

 * @param null

 * @return array free_blog_get_options_value

 *

 */

if ( !function_exists('free_blog_get_options_value') ) :

    function free_blog_get_options_value() {



        $free_blog_default_theme_options_values = free_blog_default_theme_options_values();





        $free_blog_get_options_value = get_theme_mod( 'free_blog_options');

        if( is_array( $free_blog_get_options_value )){

            return array_merge( $free_blog_default_theme_options_values, $free_blog_get_options_value );

        }

        else{

            return $free_blog_default_theme_options_values;

        }



    }

endif;



/**

 * Add postMessage support for site title and description for the Theme Customizer.

 *

 * @param WP_Customize_Manager $wp_customize Theme Customizer object.

 */

function free_blog_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';

	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial( 'blogname', array(

			'selector'        => '.site-title a',

			'render_callback' => 'free_blog_customize_partial_blogname',

		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(

			'selector'        => '.site-description',

			'render_callback' => 'free_blog_customize_partial_blogdescription',

		) );

	}



		$default = free_blog_default_theme_options_values();



		/* Theme Options Panel */

	    $wp_customize->add_panel( 'free_blog_panel', array(

	        'priority' => 30,

	        'capability' => 'edit_theme_options',

	        'title' => __( 'Theme Options', 'free-blog' ),

	    ) );



        /* Primary Color Section Inside Core Color Option */

        $wp_customize->add_setting( 'free_blog_options[free_blog_primary_color]',

            array(

                'default'           => $default['free_blog_primary_color'],

                'sanitize_callback' => 'sanitize_hex_color',

            )

        );

        $wp_customize->add_control(

            new WP_Customize_Color_Control(

                $wp_customize,

                'free_blog_options[free_blog_primary_color]',

                array(

                    'label'       => esc_html__( 'Primary Color', 'free-blog' ),

                    'description' => esc_html__( 'Applied to main color of site.', 'free-blog' ),

                    'section'     => 'colors',

                )

            )

        );



	    /*Top Header Options*/

	     $wp_customize->add_section( 'free_blog_header_section', array(

    	    'priority'       => 20,

    	    'capability'     => 'edit_theme_options',

    	    'theme_supports' => '',

    	    'title'          => __( 'Header', 'free-blog' ),

    	    'panel' 		 => 'free_blog_panel',

	    ) );



	    /*callback functions header section*/

		if ( !function_exists('free_blog_header_active_callback') ) :

		    function free_blog_header_active_callback(){

		        global $free_blog_theme_options;

				$enable_header = absint($free_blog_theme_options['free_blog_enable_top_header']);

		        if( 1 == $enable_header ){

		            return true;

		        }

		        else{

		            return false;

		        }

		    }

		endif;



	    /*Enable Top Header Section*/

	    $wp_customize->add_setting( 'free_blog_options[free_blog_enable_top_header]', array(

    	    'capability'        => 'edit_theme_options',

    	    'transport' => 'refresh',

    	    'default'           => $default['free_blog_enable_top_header'],

    	    'sanitize_callback' => 'free_blog_sanitize_checkbox'

    	) );



    	$wp_customize->add_control( 'free_blog_options[free_blog_enable_top_header]', array(

    	    'label'     => __( 'Enable Top Header', 'free-blog' ),

    	    'description' => __('Checked to show the top header section like search and social icons', 'free-blog'),

    	    'section'   => 'free_blog_header_section',

    	    'settings'  => 'free_blog_options[free_blog_enable_top_header]',

    	    'type'      => 'checkbox',

    	    'priority'  => 5,

    	) );



    	/*Enable Social Icons In Header*/

	    $wp_customize->add_setting( 'free_blog_options[free_blog_enable_top_header_social]', array(

    	    'capability'        => 'edit_theme_options',

    	    'transport' => 'refresh',

    	    'default'           => $default['free_blog_enable_top_header_social'],

    	    'sanitize_callback' => 'free_blog_sanitize_checkbox'

    	) );



    	$wp_customize->add_control( 'free_blog_options[free_blog_enable_top_header_social]', array(

    	    'label'     => __( 'Enable Social Icons', 'free-blog' ),

    	    'description' => __('You can show the social icons here. Manage social icons from Appearance > Menus. Social Menu will display here.', 'free-blog'),

    	    'section'   => 'free_blog_header_section',

    	    'settings'  => 'free_blog_options[free_blog_enable_top_header_social]',

    	    'type'      => 'checkbox',

    	    'priority'  => 5,

    	    'active_callback'=>'free_blog_header_active_callback'

    	) );



    	/*Enable Search Icons In Header*/

	    $wp_customize->add_setting( 'free_blog_options[free_blog_enable_top_header_search]', array(

    	    'capability'        => 'edit_theme_options',

    	    'transport' => 'refresh',

    	    'default'           => $default['free_blog_enable_top_header_search'],

    	    'sanitize_callback' => 'free_blog_sanitize_checkbox'

    	) );



    	$wp_customize->add_control( 'free_blog_options[free_blog_enable_top_header_search]', array(

    	    'label'     => __( 'Enable Search Icons', 'free-blog' ),

    	    'description' => __('You can show the search field in header.', 'free-blog'),

    	    'section'   => 'free_blog_header_section',

    	    'settings'  => 'free_blog_options[free_blog_enable_top_header_search]',

    	    'type'      => 'checkbox',

    	    'priority'  => 5,

    	    'active_callback'=>'free_blog_header_active_callback'

    	) );

        /*Enable Menu in top Header*/

        $wp_customize->add_setting( 'free_blog_options[free_blog_enable_top_header_menu]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free_blog_enable_top_header_menu'],

            'sanitize_callback' => 'free_blog_sanitize_checkbox'

        ) );



        $wp_customize->add_control( 'free_blog_options[free_blog_enable_top_header_menu]', array(

            'label'     => __( 'Menu in Header', 'free-blog' ),

            'description' => __('Top Header Menu will display here. Go to Appearance < Menu.', 'free-blog'),

            'section'   => 'free_blog_header_section',

            'settings'  => 'free_blog_options[free_blog_enable_top_header_menu]',

            'type'      => 'checkbox',

            'priority'  => 5,

            'active_callback'=>'free_blog_header_active_callback'

        ) );



	    /*Slider Options*/

	    $wp_customize->add_section( 'free_blog_slider_section', array(

    	    'priority'       => 20,

    	    'capability'     => 'edit_theme_options',

    	    'theme_supports' => '',

    	    'title'          => __( 'Slider', 'free-blog' ),

    	    'panel' 		 => 'free_blog_panel',

	    ) );



	    /*callback functions slider*/

		if ( !function_exists('free_blog_slider_active_callback') ) :

		    function free_blog_slider_active_callback(){

		        global $free_blog_theme_options;

				$enable_slider = absint($free_blog_theme_options['free_blog_enable_slider']);

		        if( 1 == $enable_slider ){

		            return true;

		        }

		        else{

		            return false;

		        }

		    }

		endif;



	    /*Slider Enable Option*/

	    $wp_customize->add_setting( 'free_blog_options[free_blog_enable_slider]', array(

    	    'capability'        => 'edit_theme_options',

    	    'transport' => 'refresh',

    	    'default'           => $default['free_blog_enable_slider'],

    	    'sanitize_callback' => 'free_blog_sanitize_checkbox'

    	) );



    	$wp_customize->add_control( 'free_blog_options[free_blog_enable_slider]', array(

    	    'label'     => __( 'Enable Slider', 'free-blog' ),

    	    'description' => __('Checked to Enable Slider In Home Page. Make sure header image is not set to display the slider', 'free-blog'),

    	    'section'   => 'free_blog_slider_section',

    	    'settings'  => 'free_blog_options[free_blog_enable_slider]',

    	    'type'      => 'checkbox',

    	    'priority'  => 5,

    	) );



    	 /*Slider Category Selection*/

    	$wp_customize->add_setting( 'free_blog_options[free-blog-select-category]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-select-category'],

            'sanitize_callback' => 'absint'

        ) );

        $wp_customize->add_control(

            new Free_Blog_Customize_Category_Dropdown_Control(

                $wp_customize,

                'free_blog_options[free-blog-select-category]',

                array(

                    'label'     => __( 'Select Category For Slider', 'free-blog' ),

                    'description' => __('From the dropdown select the category for the slider. Category having post will display in below dropdown.', 'free-blog'),

                    'section'   => 'free_blog_slider_section',

                    'settings'  => 'free_blog_options[free-blog-select-category]',

                    'type'      => 'category_dropdown',

                    'priority'  => 5,

                    'active_callback'=>'free_blog_slider_active_callback'

                )

            )

        );



         /*Slider Number*/

        $wp_customize->add_setting( 'free_blog_options[free-blog-slider-number]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-slider-number'],

            'sanitize_callback' => 'free_blog_sanitize_number_range'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-slider-number]', array(

            'label'     => __( 'Number of Slides ', 'free-blog' ),

            'description' => __('Select the number of slide. Maximum slide is 5 and minium 1', 'free-blog'),

            'section'   => 'free_blog_slider_section',

            'settings'  => 'free_blog_options[free-blog-slider-number]',

            'type'      => 'number',

            'priority'  => 15,

            'active_callback'=>'free_blog_slider_active_callback',

            'input_attrs' => array(

                'min' => '1',

                'max' => '5',

                'step' => '1',

            ),

        ) );



         /*Slider Read More Text*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-slider-read-more]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-slider-read-more'],

            'sanitize_callback' => 'sanitize_text_field'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-slider-read-more]', array(

            'label'     => __( 'Read More Text ', 'free-blog' ),

            'description' => __('Enter the text for Read More', 'free-blog'),

            'section'   => 'free_blog_slider_section',

            'settings'  => 'free_blog_options[free-blog-slider-read-more]',

            'type'      => 'text',

            'priority'  => 15,

            'active_callback'=>'free_blog_slider_active_callback',

        ) );



        /*Slider Hide Suggested Next Slider*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-slider-suggestions]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-slider-suggestions'],

            'sanitize_callback' => 'free_blog_sanitize_checkbox'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-slider-suggestions]', array(

            'label'     => __( 'Enable Next Sliders Posts ', 'free-blog' ),

            'description' => __('You can enable and disable the slider next slider recommendation which is appear above the slider', 'free-blog'),

            'section'   => 'free_blog_slider_section',

            'settings'  => 'free_blog_options[free-blog-slider-suggestions]',

            'type'      => 'checkbox',

            'priority'  => 15,

            'active_callback'=>'free_blog_slider_active_callback',

        ) );



        /*Blog Page Options*/

	    $wp_customize->add_section( 'free_blog_blog_page_section', array(

    	    'priority'       => 20,

    	    'capability'     => 'edit_theme_options',

    	    'theme_supports' => '',

    	    'title'          => __( 'Blog Page', 'free-blog' ),

    	    'panel' 		 => 'free_blog_panel',

	    ) );



        /*Blog Page Sidebar Layout*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-sidebar-blog-page]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-sidebar-blog-page'],

            'sanitize_callback' => 'free_blog_sanitize_select'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-sidebar-blog-page]', array(

        	'choices' => array(

                'right-sidebar'   => __('Right Sidebar','free-blog'),

                'left-sidebar'    => __('Left Sidebar','free-blog'),

                'no-sidebar'      => __('No Sidebar','free-blog'),

                'middle-column'   => __('Middle Column','free-blog'),

                'both-sidebar'   => __('Both Sidebar','free-blog'),



	    	 ),

            'label'     => __( 'Select the preferred sidebar', 'free-blog' ),

            'description' => __('This sidebar will work for all Pages', 'free-blog'),

            'section'   => 'free_blog_blog_page_section',

            'settings'  => 'free_blog_options[free-blog-sidebar-blog-page]',

            'type'      => 'select',

            'priority'  => 15,

        ) );



        /*Blog Page column number*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-column-blog-page]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-column-blog-page'],

            'sanitize_callback' => 'free_blog_sanitize_select'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-column-blog-page]', array(

        	'choices' => array(

                'one-column'    => __('Single','free-blog'),

                'masonry-post'       => __('Masonry','free-blog'),

	    	 ),

            'label'     => __( 'Blog Layout Column', 'free-blog' ),

            'description' => __('You can change the blog page and archive page layouts', 'free-blog'),

            'section'   => 'free_blog_blog_page_section',

            'settings'  => 'free_blog_options[free-blog-column-blog-page]',

            'type'      => 'select',

            'priority'  => 15,

        ) );



        /*Blog Page Show content from*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-content-show-from]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-content-show-from'],

            'sanitize_callback' => 'free_blog_sanitize_select'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-content-show-from]', array(

        	'choices' => array(

                'excerpt'    => __('Excerpt','free-blog'),

                'content'    => __('Content','free-blog'),

                'hide'       => __('Hide','free-blog'),

	    	 ),

            'label'     => __( 'Select Content Display Option', 'free-blog' ),

            'description' => __('You can enable excerpt from Screen Options inside post section of dashboard', 'free-blog'),

            'section'   => 'free_blog_blog_page_section',

            'settings'  => 'free_blog_options[free-blog-content-show-from]',

            'type'      => 'select',

            'priority'  => 15,

        ) );



        /*Blog Page excerpt length*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-excerpt-length]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-excerpt-length'],

            'sanitize_callback' => 'absint'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-excerpt-length]', array(

            'label'     => __( 'Size of Excerpt Content', 'free-blog' ),

            'description' => __('Enter the number per Words to show the content in blog page.', 'free-blog'),

            'section'   => 'free_blog_blog_page_section',

            'settings'  => 'free_blog_options[free-blog-excerpt-length]',

            'type'      => 'number',

            'priority'  => 15,

        ) );



        /*Blog Page Pagination Options*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-pagination-options]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-pagination-options'],

            'sanitize_callback' => 'free_blog_sanitize_select'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-pagination-options]', array(

        	'choices' => array(

                'default'    => __('Default','free-blog'),

                'numeric'    => __('Numeric','free-blog'),

                'ajax'       => __('Ajax Pagination','free-blog'),

                'hide'       => __('Hide Pagination','free-blog'),

	    	 ),

            'label'     => __( 'Pagination Types', 'free-blog' ),

            'description' => __('Select the Required Pagination Type', 'free-blog'),

            'section'   => 'free_blog_blog_page_section',

            'settings'  => 'free_blog_options[free-blog-pagination-options]',

            'type'      => 'select',

            'priority'  => 15,

        ) );



        /*Blog Page read more text*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-read-more-text]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-read-more-text'],

            'sanitize_callback' => 'sanitize_text_field'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-read-more-text]', array(

            'label'     => __( 'Enter Read More Text', 'free-blog' ),

            'description' => __('Read more text for blog and archive page.', 'free-blog'),

            'section'   => 'free_blog_blog_page_section',

            'settings'  => 'free_blog_options[free-blog-read-more-text]',

            'type'      => 'text',

            'priority'  => 15,

        ) );



        /*Single Page Options*/

	    $wp_customize->add_section( 'free_blog_single_page_section', array(

    	    'priority'       => 20,

    	    'capability'     => 'edit_theme_options',

    	    'theme_supports' => '',

    	    'title'          => __( 'Single Page', 'free-blog' ),

    	    'panel' 		 => 'free_blog_panel',

	    ) );



        /*Featured Image Option*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-single-page-featured-image]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-single-page-featured-image'],

            'sanitize_callback' => 'free_blog_sanitize_checkbox'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-single-page-featured-image]', array(

            'label'     => __( 'Enable Featured Image', 'free-blog' ),

            'description' => __('You can hide or show featured image on single page.', 'free-blog'),

            'section'   => 'free_blog_single_page_section',

            'settings'  => 'free_blog_options[free-blog-single-page-featured-image]',

            'type'      => 'checkbox',

            'priority'  => 15,

        ) );



        /*Related Post Options*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-single-page-related-posts]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-single-page-related-posts'],

            'sanitize_callback' => 'free_blog_sanitize_checkbox'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-single-page-related-posts]', array(

            'label'     => __( 'Enable Related Posts', 'free-blog' ),

            'description' => __('3 Post from similar category will display at the end of the page.', 'free-blog'),

            'section'   => 'free_blog_single_page_section',

            'settings'  => 'free_blog_options[free-blog-single-page-related-posts]',

            'type'      => 'checkbox',

            'priority'  => 15,

        ) );



        /*callback functions related posts*/

		if ( !function_exists('free_blog_related_post_callback') ) :

		    function free_blog_related_post_callback(){

		        global $free_blog_theme_options;

				$related_posts = absint($free_blog_theme_options['free-blog-single-page-related-posts']);

		        if( 1 == $related_posts ){

		            return true;

		        }

		        else{

		            return false;

		        }

		    }

		endif;



		/*Related Post Title*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-single-page-related-posts-title]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-single-page-related-posts-title'],

            'sanitize_callback' => 'sanitize_text_field'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-single-page-related-posts-title]', array(

            'label'     => __( 'Related Posts Title', 'free-blog' ),

            'description' => __('Give the appropriate title for related posts', 'free-blog'),

            'section'   => 'free_blog_single_page_section',

            'settings'  => 'free_blog_options[free-blog-single-page-related-posts-title]',

            'type'      => 'text',

            'priority'  => 15,

            'active_callback'=>'free_blog_related_post_callback'

        ) );



        /*Sticky Sidebar*/

	    $wp_customize->add_section( 'free_blog_sticky_sidebar', array(

    	    'priority'       => 20,

    	    'capability'     => 'edit_theme_options',

    	    'theme_supports' => '',

    	    'title'          => __( 'Sticky Sidebar', 'free-blog' ),

    	    'panel' 		 => 'free_blog_panel',

	    ) );



        /*Sticky Sidebar Setting*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-enable-sticky-sidebar]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-enable-sticky-sidebar'],

            'sanitize_callback' => 'free_blog_sanitize_checkbox'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-enable-sticky-sidebar]', array(

            'label'     => __( 'Enable Sticky Sidebar', 'free-blog' ),

            'description' => __('Enable and Disable sticky sidebar from this section.', 'free-blog'),

            'section'   => 'free_blog_sticky_sidebar',

            'settings'  => 'free_blog_options[free-blog-enable-sticky-sidebar]',

            'type'      => 'checkbox',

            'priority'  => 15,

        ) );



        /*Footer Options*/

	    $wp_customize->add_section( 'free_blog_footer_section', array(

    	    'priority'       => 20,

    	    'capability'     => 'edit_theme_options',

    	    'theme_supports' => '',

    	    'title'          => __( 'Footer', 'free-blog' ),

    	    'panel' 		 => 'free_blog_panel',

	    ) );



        /*Copyright Setting*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-footer-copyright]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-footer-copyright'],

            'sanitize_callback' => 'sanitize_text_field'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-footer-copyright]', array(

            'label'     => __( 'Copyright Text', 'free-blog' ),

            'description' => __('Enter your own copyright text.', 'free-blog'),

            'section'   => 'free_blog_footer_section',

            'settings'  => 'free_blog_options[free-blog-footer-copyright]',

            'type'      => 'text',

            'priority'  => 15,

        ) );



        /*Go to Top Setting*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-go-to-top]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-go-to-top'],

            'sanitize_callback' => 'free_blog_sanitize_checkbox'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-go-to-top]', array(

            'label'     => __( 'Enable Go to Top', 'free-blog' ),

            'description' => __('Checked to Enable Go to Top', 'free-blog'),

            'section'   => 'free_blog_footer_section',

            'settings'  => 'free_blog_options[free-blog-go-to-top]',

            'type'      => 'checkbox',

            'priority'  => 15,

        ) );





        /*Font and Typography Options*/

	    $wp_customize->add_section( 'free_blog_font_options', array(

    	    'priority'       => 20,

    	    'capability'     => 'edit_theme_options',

    	    'theme_supports' => '',

    	    'title'          => __( 'Fonts', 'free-blog' ),

    	    'panel' 		 => 'free_blog_panel',

	    ) );



        /*Font Family URL*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-font-family-url]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-font-family-url'],

            'sanitize_callback' => 'esc_url_raw'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-font-family-url]', array(

            'label'     => __( 'URL of Font Family', 'free-blog' ),

            'description' => sprintf(
		        		/* translators: 1: opening link tag to Google Fonts, 2: closing link tag. */
		        		__( 'The theme already loads its own fonts from your server. Leave this empty unless you want an extra family: paste a %1$sGoogle Fonts%2$s stylesheet URL to load one. Doing so will contact Google on every page view.', 'free-blog' ),
		        		'<a href="' . esc_url( 'https://fonts.google.com/' ) . '" target="_blank" rel="noopener noreferrer">',
		        		'</a>'
		    ),

            'section'   => 'free_blog_font_options',

            'settings'  => 'free_blog_options[free-blog-font-family-url]',

            'type'      => 'url',

            'priority'  => 15,

        ) );

        /*Font Family Name*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-font-family-name]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-font-family-name'],

            'sanitize_callback' => 'sanitize_text_field'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-font-family-name]', array(

            'label'     => __( 'Font Name', 'free-blog' ),

            'description' => __('Add Font Name here, Example: Barlow Semi Condensed, sans-serif', 'free-blog'),

            'section'   => 'free_blog_font_options',

            'settings'  => 'free_blog_options[free-blog-font-family-name]',

            'type'      => 'text',

            'priority'  => 15,

        ) );

        /*Paragraph font Size*/

       	$wp_customize->add_setting( 'free_blog_options[free-blog-font-paragraph-font-size]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-font-paragraph-font-size'],

            'sanitize_callback' => 'free_blog_sanitize_number_range'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-font-paragraph-font-size]', array(

            'label'     => __( 'Paragraph Font Size', 'free-blog' ),

            'description' => __('Size apply only for paragraphs, not headings. ', 'free-blog'),

            'section'   => 'free_blog_font_options',

            'settings'  => 'free_blog_options[free-blog-font-paragraph-font-size]',

            'type'      => 'number',

            'priority'  => 15,

            'input_attrs' => array(

	        		'min' => 12,

	        		'max' => 20,

	        		'step' => 1,

	        	),

        ) );



        /*Extra Options*/

        $wp_customize->add_section( 'free_blog_extra_options', array(

            'priority'       => 20,

            'capability'     => 'edit_theme_options',

            'theme_supports' => '',

            'title'          => __( 'Extras', 'free-blog' ),

            'panel'          => 'free_blog_panel',

        ) );



        /*Breadcrumb Enable*/

        $wp_customize->add_setting( 'free_blog_options[free-blog-extra-breadcrumb]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-extra-breadcrumb'],

            'sanitize_callback' => 'free_blog_sanitize_checkbox'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-extra-breadcrumb]', array(

            'label'     => __( 'Enable Breadcrumb', 'free-blog' ),

            'description' => __( 'Breadcrumb will appear on all pages except home page', 'free-blog' ),

            'section'   => 'free_blog_extra_options',

            'settings'  => 'free_blog_options[free-blog-extra-breadcrumb]',

            'type'      => 'checkbox',

            'priority'  => 15,

        ) );



        /*Breadcrumb Text*/

        $wp_customize->add_setting( 'free_blog_options[free-blog-breadcrumb-text]', array(

            'capability'        => 'edit_theme_options',

            'transport' => 'refresh',

            'default'           => $default['free-blog-breadcrumb-text'],

            'sanitize_callback' => 'sanitize_text_field'

        ) );

        $wp_customize->add_control( 'free_blog_options[free-blog-breadcrumb-text]', array(

            'label'     => __( 'Breadcrumb Text', 'free-blog' ),

            'description' => __( 'Write your own text in place of You are Here', 'free-blog' ),

            'section'   => 'free_blog_extra_options',

            'settings'  => 'free_blog_options[free-blog-breadcrumb-text]',

            'type'      => 'text',

            'priority'  => 15,

        ) );

}

add_action( 'customize_register', 'free_blog_customize_register' );



/**

 * Render the site title for the selective refresh partial.

 *

 * @return void

 */

function free_blog_customize_partial_blogname() {

	bloginfo( 'name' );

}



/**

 * Render the site tagline for the selective refresh partial.

 *

 * @return void

 */

function free_blog_customize_partial_blogdescription() {

	bloginfo( 'description' );

}



/**

 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.

 */

function free_blog_customize_preview_js() {

	wp_enqueue_script( 'free-blog-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );

}

add_action( 'customize_preview_init', 'free_blog_customize_preview_js' );

