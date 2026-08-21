<?php
/**
 * Dynamic css
 *
 * @since Free Blog 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('free_blog_dynamic_css')) :

    function free_blog_dynamic_css()
    {
        global $free_blog_theme_options;
        $free_blog_font_family = wp_kses_post($free_blog_theme_options['free-blog-font-family-name']);
        $free_blog_font_size = absint($free_blog_theme_options['free-blog-font-paragraph-font-size']);
        $free_blog_primary_color = esc_attr($free_blog_theme_options['free_blog_primary_color']);
        
        $custom_css = '';

        /* Typography Section */
        if (!empty($free_blog_font_family)) {
            $custom_css .= "body { font-family: {$free_blog_font_family}; }";
        }

        if (!empty($free_blog_font_size)) {
            $custom_css .= "body { font-size: {$free_blog_font_size}px; }";
        }

        /* Primary Color Section */
        if (!empty($free_blog_primary_color)) {
            $custom_css .= "#secondary .widget.widget_search form input[type='submit'], #secondary h2.widget-title:after, #toTop, .read-more a:hover { background-color : {$free_blog_primary_color}; }";

        }
        if (!empty($free_blog_primary_color)) {
            $custom_css .= ".entry-meta .posted-on a, .entry-footer .cat-links a, .entry-footer .edit-link a, article.format-standard .entry-header::after, article.format-image .entry-header::after, article.hentry.sticky .entry-header::after, article.format-video .entry-header::after, article.format-gallery .entry-header::after, article.format-audio .entry-header::after, article.format-quote .entry-header::after, article.format-chat .entry-header::after, article.format-aside .entry-header::after, article.format-link .entry-header::after, .entry-footer .tags-links a, .entry-footer .comments-link a, .entry-header .byline .author a { color : {$free_blog_primary_color}; }";

        }

        wp_add_inline_style('free-blog-style', $custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'free_blog_dynamic_css', 99);