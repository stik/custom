<?php

/**
 * Gutenberg blocks
 */

// Categories
function custom_block_category($categories, $post)
{
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'custom-block-category',
                'title' => 'Custom blocks',
            ),
        )
    );
}
add_filter('block_categories', 'custom_block_category', 10, 2);



// Register block ACF6.+
add_action('init', 'register_acf_blocks', 5);
function register_acf_blocks()
{
    register_block_type(dirname(__FILE__) . '/../blocks/team-member-detail');
    register_block_type(dirname(__FILE__) . '/../blocks/team-member-grid');
}


// enabling certain blocks in gutenberg
add_filter('allowed_block_types_all', 'gute_whitelist_blocks');
function gute_whitelist_blocks($allowed_blocks)
{
    return array(
        'core/shortcode',
        'core/image',
        'core/heading',
        'core/quote',
        'core/list',
        'core/list-item',
        'core/separator',
        'core/more',
        'core/button',
        'core/table',
        'core/preformatted',
        'core/code',
        'core/html',
        'core/text-columns',
        'core/block',
        'core/paragraph',
        //'core/pullquote',
        //'core/gallery',
        //'core/cover',
        //'core/video',
        //'core/audio',
        //'core/freeform',
        //'core/latest-posts',
        //'core/categories',
        //'core/verse',
        //'core/embed',

        //Components
        'acf/team-member-detail',
        'acf/team-member-grid',
    );
}
