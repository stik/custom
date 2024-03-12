<?php

/**
 * Setup WP
 */

//Load CSS to gutenberg + front
function wpdocs_mytheme_block_styles()
{
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/dist/css/style.css', array(), filemtime(get_stylesheet_directory() . '/dist/css/style.css'));
}
add_action('enqueue_block_assets', 'wpdocs_mytheme_block_styles');

// Load CSS and JS files
function jpen_enqueue_assets()
{
    //remove gutenberg styles
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
    wp_dequeue_style('global-styles');
    //wp_dequeue_style('classic-theme-styles');

    //WP 6.0 remove classes
    remove_filter('render_block', 'wp_render_layout_support_flag', 10, 2);
    add_filter('render_block', function ($block_content, $block) {
        if ($block['blockName'] === 'core/columns' || $block['blockName'] === 'core/column' || $block['blockName'] === 'core/block') {
            return $block_content;
        }
        return wp_render_layout_support_flag($block_content, $block);
    }, 10, 2);



    // remove jquery on front
    if (!is_admin()) wp_deregister_script('jquery');


    // primary JS
    wp_enqueue_script('scripts-defer', get_template_directory_uri() . '/dist/js/scripts.min.js', array(), filemtime(get_template_directory() . '/dist/js/scripts.min.js'), true);

    // remove scripts from wp_head
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);

    // add scripts to wp_footer
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action('wp_enqueue_scripts', 'jpen_enqueue_assets');



// Base setting
add_action('after_setup_theme', function () {

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('menus');
    register_nav_menu('primary', 'Primary menu');
    register_nav_menu('mobile', 'Mobile menu');

    add_image_size('full_width', 1920, false);

    // custom medium_large
    remove_image_size('medium_large');
    add_image_size('medium_large', 500, 0);

    // remove thumbs
    remove_image_size('2048x2048');
    remove_image_size('1536x1536');
});

// Clean WP
function custom_cleanup()
{

    // remove styles and scripts
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    add_filter('emoji_svg_url', '__return_false');
    add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');

    /**
     * Disabled oEmbed
     */

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');
    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
    // Remove the REST API lines from the HTML header
    remove_action('wp_head', 'rest_output_link_wp_head', 10);

    // Clear <head>
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('do_feed_rdf', 'do_feed_rdf', 10, 1);
    remove_action('do_feed_rss', 'do_feed_rss', 10, 1);
    remove_action('do_feed_rss2', 'do_feed_rss2', 10, 1);
    remove_action('do_feed_atom', 'do_feed_atom', 10, 1);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    //remove_action('wp_head', 'rel_canonical');
}
add_action('init', 'custom_cleanup');


// Fix czech files
function sanitize_accents($filename)
{
    return remove_accents($filename);
}
add_filter('sanitize_file_name', 'sanitize_accents', 10);

//img-media file
function default_type_set_link($settings)
{
    $settings['galleryDefaults']['link'] = 'file';
    return $settings;
}
add_filter('media_view_settings', 'default_type_set_link');


// Remove WP version from RSS
add_filter('the_generator', 'roots_no_generator');
function roots_no_generator()
{
    return '';
}

add_filter('the_generator', 'remove_version');
function remove_version()
{
    return '';
}

// Disable emoji in TinyMCE
function disable_emojicons_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

// Do not send emails to the admin after changing the password
if (!function_exists('wp_password_change_notification')) {
    function wp_password_change_notification($user)
    {
        return;
    }
}

// stop resize image from WP 5.3
add_filter('big_image_size_threshold', '__return_false');


// Add async and defer
if (!is_admin()) {
    function add_asyncdefer_attribute($tag, $handle)
    {
        if (strpos($handle, 'async-defer') !== false) {
            return str_replace('<script ', '<script async defer ', $tag);
        } else if (strpos($handle, 'async') !== false) {
            return str_replace('<script ', '<script async ', $tag);
        } else if (strpos($handle, 'defer') !== false) {
            return str_replace('<script ', '<script defer ', $tag);
        } else {
            return $tag;
        }
    }
    add_filter('script_loader_tag', 'add_asyncdefer_attribute', 10, 2);
}


// add menu link class
/*
'list_item_class'  => 'nav-item',
'link_class'       => 'nav-link m-2 menu-item nav-active'
*/
function add_menu_link_class($atts, $item, $args)
{
    if (property_exists($args, 'link_class')) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

function add_menu_list_item_class($classes, $item, $args)
{
    if (property_exists($args, 'list_item_class')) {
        $classes[] = $args->list_item_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);


// disable update plugin / core / theme
function remove_core_updates()
{
    global $wp_version;
    return (object) array('last_checked' => time(), 'version_checked' => $wp_version);
}
//add_filter('pre_site_transient_update_core','remove_core_updates'); //hide updates for WordPress itself
//add_filter('pre_site_transient_update_plugins','remove_core_updates'); //hide updates for all plugins
//add_filter('pre_site_transient_update_themes','remove_core_updates'); //hide updates for all themes
