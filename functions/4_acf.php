<?php

/**
 * ACF setting
 */

//options pages
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => __('Web options', 'custom'),
        'menu_title'    => __('Web options', 'custom'),
        'menu_slug'     => 'weboptions',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}


//from ACF 5.6.0 - faster loading - https://www.advancedcustomfields.com/blog/acf-pro-5-5-13-update/
add_filter('acf/settings/remove_wp_meta_box', '__return_true');
