<?php

/**
 * Custom post type
 */

function cpt_team_members()
{
    $labels = array(
        'name'                => __('Team Members', 'custom'),
        'singular_name'       => __('Member', 'custom'),
        'menu_name'           => __('Team Members', 'custom'),
        'name_admin_bar'      => __('Team Members', 'custom'),
        'parent_item_colon'   => __('Parent item:', 'custom'),
        'all_items'           => __('All memebers', 'custom'),
        'add_new_item'        => __('Add New', 'custom'),
        'add_new'             => __('Add New', 'custom'),
        'new_item'            => __('New member', 'custom'),
        'edit_item'           => __('Edit member', 'custom'),
        'update_item'         => __('Update member', 'custom'),
        'view_item'           => __('View member', 'custom'),
        'search_items'        => __('Searcg', 'custom'),
        'not_found'           => __('Not found', 'custom'),
        'not_found_in_trash'  => __('Not found in trash', 'custom'),
    );

    $args = array(
        'label'               => __('Team Members', 'custom'),
        'description'         => __('Team Members', 'custom'),
        'labels'              => $labels,
        'supports'            => array(),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'menu_icon'           => 'dashicons-groups',
        'rewrite'             => array('slug' => 'member'),
    );
    register_post_type('team_members', $args);
}
add_action('init', 'cpt_team_members', 0);


/*
 * Taxonomies
 */
/*
function my_taxonomies_product()
{
  $labels = array(
    'name'              => __( 'Product Categories', 'custom' ),
    'singular_name'     => __( 'Product Category', 'custom' ),
    'search_items'      => __( 'Search Product Categories', 'custom' ),
    'all_items'         => __( 'All Product Categories', 'custom' ),
    'parent_item'       => __( 'Parent Product Category', 'custom' ),
    'parent_item_colon' => __( 'Parent Product Category:', 'custom' ),
    'edit_item'         => __( 'Edit Product Category', 'custom' ),
    'update_item'       => __( 'Update Product Category', 'custom' ),
    'add_new_item'      => __( 'Add New Product Category', 'custom' ),
    'new_item_name'     => __( 'New Product Category', 'custom' ),
    'menu_name'         => __( 'Product Categories', 'custom' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'show_admin_column' => true,
    'has_archive' => true,
  );
  register_taxonomy( 'product_category', 'product', $args );
}
add_action( 'init', 'my_taxonomies_product', 0 );
*/
