<?php

/**
 * Gutenberg + ACF - define block id and class
 */

function define_block_id_and_class($name = "block", $block = array())
{
    $id = $name . '-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }

    $className = $name;
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }

    $array = array(
        'id' => $id,
        'class' => $className,
    );

    return $array;
}

//fix bug InnerBlocks width ACF - FE vs. BE WP 5.x
function innerBlocks()
{
    if (is_admin()) {
        echo "<InnerBlocks></InnerBlocks>";
    } else {
        echo "<InnerBlocks />";
    }
}

//remove all paterns
function fire_theme_support()
{
    remove_theme_support('core-block-patterns');
}
add_action('after_setup_theme', 'fire_theme_support');
