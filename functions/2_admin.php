<?php

/**
 * Base admin setting
 */

// Remove help
add_action('admin_head', 'mytheme_remove_help_tabs');
function mytheme_remove_help_tabs()
{
    $screen = get_current_screen();
    $screen->remove_help_tabs();
}

// Remove comments from menu
add_action('admin_menu', 'my_remove_admin_menus');
function my_remove_admin_menus()
{
    remove_menu_page('edit-comments.php');
}

// Remove comments from post and pages
add_action('init', 'remove_comment_support', 100);
function remove_comment_support()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}

// Remove comments from admin bar
function mytheme_admin_bar_render()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');

// Default media setting
function custom_image_size()
{
    update_option('image_default_align', 'none');
    update_option('image_default_size', 'large');
    update_option('image_default_link_type', 'none');
}
add_action('after_setup_theme', 'custom_image_size');

// Remove customize - frontend admin bar
add_action('admin_bar_menu', 'remove_some_nodes_from_admin_top_bar_menu', 999);
function remove_some_nodes_from_admin_top_bar_menu($wp_admin_bar)
{
    $wp_admin_bar->remove_menu('customize');
}

// Hide WP version ( only for users )
function my_footer_shh()
{
    if (!current_user_can('update_core')) {
        remove_filter('update_footer', 'core_update_footer');
        add_filter('admin_footer_text', '__return_empty_string', 11);
    }
}
add_action('admin_menu', 'my_footer_shh');


// Clear dashboard - remove default widgets
function wporg_remove_all_dashboard_metaboxes()
{
    remove_action('welcome_panel', 'wp_welcome_panel');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    //remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes');
