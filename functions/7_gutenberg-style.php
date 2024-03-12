<?php

/**
 * Gutenberg - block styles
 */

function custom_gutenberg_styles()
{
    for ($i = 1; $i <= 6; $i++) {
        register_block_style('core/heading', [
            'name' => 'h' . $i,
            'label' => __('H' . $i, 'custom'),
        ]);
    }
}
add_action('init', 'custom_gutenberg_styles');
