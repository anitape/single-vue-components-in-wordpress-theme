<?php

/* Hiding admin bar*/

add_filter('show_admin_bar', '__return_false');

/* Enabling menu editor in WP admin panel*/

function register_wpmenu(){
    register_nav_menu('primary', 'Main menu');
}

add_action('init', 'register_wpmenu');

/* Adding featured image to posts*/
add_theme_support('post-thumbnails');


/* Adding essential styles and scripts*/
function essential_scripts() {

    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css',
        [],
        '4.5.3'
    );
  

    wp_enqueue_style(
        'essential-style',
        get_template_directory_uri() . '/style.css',
        [],
        '0.1.0'
    );

    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        [],
        '4.7.0'
    );

    wp_enqueue_script(
        'vue',
        'https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.39/vue.global.min.js',
        [],
        '3.2.39'
    );

    wp_enqueue_script(
        'vue-test',
        get_template_directory_uri() . '/js/test.js',
        ['vue'],
        '0.1.0',
        true
    );

    wp_enqueue_script(
        'slider',
        get_template_directory_uri() . '/js/slider.js',
        ['vue'],
        '0.1.0',
        true
    );

    wp_enqueue_script(
        'dropdowns',
        get_template_directory_uri() . '/js/dropdowns.js',
        ['vue'],
        '0.1.0',
        true
    );

    wp_enqueue_script(
        'dropdown',
        get_template_directory_uri() . '/js/dropdown.js',
        ['vue'],
        '0.1.0',
        true
    );

    wp_enqueue_script(
        'tabs',
        get_template_directory_uri() . '/js/tabs.js',
        ['vue'],
        '0.1.0',
        true
    );

}

add_action('wp_enqueue_scripts', 'essential_scripts');

add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
    if ( 20 === $item->ID || 21 === $item->ID ) { // change 1161 to the ID of your menu item.
        $atts['@click'] = 'makeVisible';
    }

    return $atts;
}, 10, 3 );

?>