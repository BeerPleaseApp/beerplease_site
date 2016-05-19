<?php
/* FONCTIONS qui suppriment certaines données dans mon HEAD (sécurité hacking)
-----------------------------------------------------------------*/
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

/* FONCTION qui désactive l'éditeur de fichiers (sécurité hacking)
-----------------------------------------------------------------*/
define('DISALLOW_FILE_EDIT', true);

/* FONCTION qui désactive les appels à la méthode system.multicall (massive login attempts)
-----------------------------------------------------------------*/
function mmx_remove_xmlrpc_methods( $methods ) {
    unset( $methods['system.multicall'] );
    return $methods;
}
add_filter( 'xmlrpc_methods', 'mmx_remove_xmlrpc_methods');

/* FONCTION qui masque les erreurs de connexion explicites pour mettre un message quelconque
-----------------------------------------------------------------*/
add_filter('login_errors', create_function('$a', 'return null;'));
?>