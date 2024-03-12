<?php

/**
 * Custom functions
 */

// unversal sanitize script
function sanitize($form)
{
    $form = trim($form);
    $form = stripcslashes($form);
    $form = htmlspecialchars($form);
    return $form;
}

// removing parentheses from the excerpt
function my_excerpt_more($text)
{
    $text = '...';
    return $text;
}
add_filter('excerpt_more', 'my_excerpt_more');

//custom debug
function debug($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

//format tel
function get_phone($data)
{
    $data = str_replace(' ','', $data);
    return Trim($data);
}

//custom svg inline
function inline_svg($name, $args = [])
{
    $path = dirname(__FILE__) . '/../img/' . $name . '.svg';

    $args_defaults = [
        'class' => '',
        'style' => '',
    ];

    $args = wp_parse_args($args, $args_defaults);
    $args['class'] = (is_array($args['class']) ? implode(' ', $args['class']) : $args['class']);

    if (file_exists($path)) {
        $add_content = array();
        foreach ($args as $k => $v) {
            if ($v != '') {
                $add_content[] = $k . ' ="' . $v . '"';
            }
        }

        $svg = file_get_contents($path);
        $svg = str_replace('<svg ', '<svg ' . implode($add_content) . ' ', $svg);

        return $svg;
    }

    return '<img src="' . $path . '" title="Image not found">';
}
