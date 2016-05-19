<?php
/* Ajout des sidebars
-----------------------------------------------------------------*/
if (function_exists('register_sidebar')) {
    $sidebarDefaultOptions = array(
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>'
    );
    /**
    register_sidebar(array_merge(array(
        'name'=>'Sidebar',
        'id' => 'sidebar-default',
    ), $sidebarDefaultOptions));
     */
}

/* Delete default sidebars
-----------------------------------------------------------------*/
if (function_exists('unregister_sidebar')) {
    unregister_sidebar('sidebar-1');
    unregister_sidebar('sidebar-4');
}


/* Ajout de nouveaux emplacements de menu
-----------------------------------------------------------------*/
add_action('init', function() {
    if (function_exists('register_nav_menus')) {
        register_nav_menus(array(
            'menu-primary' => 'Menu principal',
            'menu-footer' => 'Menu footer'
        ));
    }
});
?>