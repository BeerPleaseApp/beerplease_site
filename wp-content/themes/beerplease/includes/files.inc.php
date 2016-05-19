<?php
/**
 * Styles Front & Admin
 */
add_action('init', function() {
    if (is_admin()) {
        wp_enqueue_style('theme-admin', get_stylesheet_directory_uri() . '/css/min/admin.min.css', array(), filemtime(realpath(dirname(__FILE__)."/../")."/css/min/admin.min.css"));
    } else {
        wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css?family=Arvo:400,400italic,700');
        wp_enqueue_style('google-font-2', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700');
        wp_enqueue_style('theme-main', get_stylesheet_directory_uri() . '/css/min/styles.min.css', array(), filemtime(realpath(dirname(__FILE__)."/../")."/css/min/styles.min.css"));
    }
});

/**
 * Styles TinyMCE
 */
add_action('admin_init', function() {
    add_editor_style(get_stylesheet_directory_uri() . '/css/min/editor.min.css');
});

/**
 * Styles Login
 */
add_action('login_head', function() {
    wp_dequeue_style('theme-main');
    wp_enqueue_style('theme-login', get_stylesheet_directory_uri() . '/css/min/login.min.css', array(), filemtime(realpath(dirname(__FILE__)."/../")."/css/min/login.min.css"));
});

/**
 * Scripts
 */
add_action('wp_enqueue_scripts', function() {
    wp_deregister_script('jquery');
    wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/js/min/main.min.js', array(), filemtime(realpath(dirname(__FILE__)."/../")."/js/min/main.min.js"), true);
});


/**
 * Traductions
 */
add_action('after_setup_theme', function() {
    load_theme_textdomain('wpstartertheme', get_template_directory() . '/languages');
});

?>