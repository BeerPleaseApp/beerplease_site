<?php

/**
 * Config des routes
 */
function routing_init()
{
    global $routing;

    $routing = array(
        'news' => array(
            'fr' => 9
        ),
        'contact' => array(
            'fr' => 11
        ),
        'legals' => array(
            'fr' => 13
        ),
        'sitemap'=> array(
            'fr' => 15,
            'options' => array(
                'sitemap' => false
            )
        )
    );
}
add_action('wp_loaded', 'routing_init');

/**
 * Récupérer une route
 * @param  string $route   -> nom de la route
 * @param  string $default -> url retournée si la route n'a pas été trouvée, sinon null
 * @return node/nid si trouvée sinon $default 
 */
function routing_get($route, $default = null)
{
    global $routing;
    $language = (function_exists('pll_current_language')) ? pll_current_language() : 'fr'; // paramètre polylang (plugin de traduction)

    if (isset($routing[$route][$language])) {
        return get_permalink($routing[$route][$language]);
    }

    return $default;
}

/**
 * Récupérer l'id du post
 * @param  string $route -> Nom de la route
 * @return int si trouvée sinon false
 */
function routing_get_id($route)
{
    global $routing;
    $language = (function_exists('pll_current_language')) ? pll_current_language() : 'fr';
    
    if (isset($routing[$route][$language])) {
        return $routing[$route][$language];
    }

    return false;
}

/**
 * Récupérer les options de la route
 * @param  string $route -> Nom de la route
 * @return array si trouvée sinon false
 */
function routing_get_options($route)
{
    global $routing;
    
    if (isset($routing[$route]['options'])) {
        return $routing[$route]['options'];
    }

    return false;
}
?>