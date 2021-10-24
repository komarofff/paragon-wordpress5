<?php

function theme_setup()
{

    add_theme_support('post-thumbnails', array('post', 'page', 'property', 'broker'));
    add_theme_support('html5', array('script', 'style'));

    register_nav_menus(
        array(
            'menutop' => 'Main menu',
            'menumobile' => 'Mobile menu',
            // 'menuleft' => 'Left menu',
        )
    );

}

add_action('after_setup_theme', 'theme_setup');

function theme_scripts()
{

    $version = '001';

    if (is_singular('property')) {
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');

        wp_enqueue_script('script-slider', get_template_directory_uri() . '/slider/slick/slick.min.js', array(), $version, true);
        wp_enqueue_style('style-theme-slider-css', get_template_directory_uri() . '/slider/slick/slick.css', array(), $version);
        wp_enqueue_style('style-theme-slider-theme-css', get_template_directory_uri() . '/slider/slick/slick-theme.css', array(), $version);
        wp_enqueue_script('script-slider-details', get_template_directory_uri() . '/js/slider-details.js', array(), $version, true);

    }


    wp_enqueue_style('style-css', get_template_directory_uri() . '/css/style.css', array(), $version);
    wp_enqueue_style('style-theme-css', get_template_directory_uri() . '/css/style-theme.css', array(), $version);
    wp_enqueue_style('style-theme-mobile-css', get_template_directory_uri() . '/css/style-theme-mobile.css', array(), $version);

    wp_enqueue_script('jquery');
    wp_enqueue_script('menu-js', get_template_directory_uri() . '/js/menu.js', array(), $version, true);
    wp_enqueue_script('properties-list-js', get_template_directory_uri() . '/js/properties-list.js', array(), $version, true);
    wp_enqueue_script('script-theme-js', get_template_directory_uri() . '/js/script-theme.js', array(), $version, true);

    if (is_page('our-team')) {
        wp_enqueue_script('jquery');
        add_action('wp_footer', 'broker_page_js', 95);
    }
    if (is_front_page()) {
        wp_enqueue_script('circle-js', get_template_directory_uri() . '/js/circle-animations.js', array(), $version, true);
    }

    if(is_page('contact')){
        wp_enqueue_script('script-map-contact', get_template_directory_uri() . '/js/map-contact-page.js', array(), $version, true);
    }

}

add_action('wp_enqueue_scripts', 'theme_scripts');


function theme_admin_scripts_styles()
{
    wp_enqueue_style("style-admin", get_template_directory_uri() . "/css/style-admin.css");
    wp_enqueue_script('script-admin', get_template_directory_uri() . '/js/script-admin.js', array('jquery'));
}

add_action('admin_enqueue_scripts', 'theme_admin_scripts_styles', 99);


// Remove H2 from pagination
function theme_navigation_template($template, $class)
{
    return '
	<nav class="navigation %1$s">
		<div class="nav-links">%3$s</div>
	</nav>
	';
}

add_filter('navigation_markup_template', 'theme_navigation_template', 10, 2);

function get_theme_pagination()
{
    return get_the_posts_pagination(
        array(
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'show_all' => false,
            'end_size' => 1,
            'mid_size' => 2,
            'prev_next' => true,
            'add_args' => false,
        )
    );
}

add_filter('excerpt_length', function () {
    return 20;
});

function theme_excerpt_more($more)
{
    global $post;
    return '...<span class="d-block pt-2"><a href="' . get_permalink($post) . '">more &raquo;</a></span>';
}

add_filter('excerpt_more', 'theme_excerpt_more');

// Session
// function do_session_start() { 
//     if ( !session_id() ) session_start();
// }
// add_action( 'init', 'do_session_start' );

// Array print
function p_arr($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}


require_once(get_template_directory() . '/functions/config.php');
require_once(get_template_directory() . '/functions/functions_theme.php');
require_once(get_template_directory() . '/functions/functions_admin.php');