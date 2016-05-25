<?php
/* Gestion de la liste déroulante de la titraille dans l'éditeur
-----------------------------------------------------------------*/
add_filter('tiny_mce_before_init', function($settings) {
    // on retire `adress`, `h1` et `h2`
    $settings['block_formats'] = 'Paragraphe=p;Titre 2=h2;Titre 3=h3;Titre 4=h4';

    return $settings;
});

/* Configuration de base
-----------------------------------------------------------------*/
if (function_exists('add_theme_support')) {
    // Ajoute par défaut les liens RSS des articles et commentaires dans le <head>
    add_theme_support('automatic-feed-links');

    // Permet plusieurs de formats d'articles
    //add_theme_support('post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ));

    // Active le bloc "Image à la une"
    add_theme_support('post-thumbnails');
}

/* FONCTION personnalisation lien sur le logo de login
-----------------------------------------------------------------*/
add_filter('login_headerurl', function() {
    return get_bloginfo('url');
});
add_filter('login_headertitle', function() {
    return get_bloginfo('name');
});

/* ACTIVER LE GESTIONNAIRE DE LIENS
-----------------------------------------------------------------*/
add_filter('pre_option_link_manager_enabled', '__return_true');


function setup_theme_admin_menus()
{
    add_menu_page('Configuration générale', 'Configuration générale', 'edit_posts', 'wordbox-config', 'wpstartertheme_config_settings');
}

/* CREATION DE CHAMPS DANS LA PAGE SETTINGS DE L'ADMIN
-----------------------------------------------------------------*/
function wpstartertheme_config_settings() {
    $statistics_id_ga   = get_option('wpstartertheme_statistics_id_ga');
    $social_facebook    = get_option('wpstartertheme_social_facebook');
    $social_twitter     = get_option('wpstartertheme_social_twitter');

    if (isset($_POST['update_settings'])) {

        $statistics_id_ga = esc_attr(stripslashes($_POST['statistics_id_ga']));
        update_option('wpstartertheme_statistics_id_ga', $statistics_id_ga);

        $social_facebook = esc_attr(stripslashes($_POST['social_facebook']));
        update_option('wpstartertheme_social_facebook', $social_facebook);

        $social_twitter = esc_attr(stripslashes($_POST['social_twitter']));
        update_option('wpstartertheme_social_twitter', $social_twitter);

        echo '<div id="message" class="updated">Configuration générale sauvegardée.</div>';
    }

    if (get_option('wpstartertheme_client_name')) {
        $client_name = get_option('wpstartertheme_client_name');
    } else {
        $client_name = get_bloginfo('name');
    }

    echo '<div class="wrap">
        <form method="POST" action="">
            <h2>Configuration générale</h2>

            <h3>Statistiques du site</h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="statistics_id_ga">Identifiant Google Analytics</label>
                    </th>
                    <td>
                        <input type="text" name="statistics_id_ga" value="'.$statistics_id_ga.'" size="50" />
                    </td>
                </tr>
            </table>';

    echo '<h3>Paramètres du pied de page</h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="social_facebook">URL Page FACEBOOK</label>
                    </th>
                    <td>
                        <input type="text" name="social_facebook" value="'.$social_facebook.'" size="50" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="social_twitter">URL Profil TWITTER</label>
                    </th>
                    <td>
                        <input type="text" name="social_twitter" value="'.$social_twitter.'" size="50" />
                    </td>
                </tr>
            </table>';

    echo '<p><input type="submit" value="Enregistrer la configuration" class="button-primary"/></p>
            <input type="hidden" name="update_settings" value="Y" />
        </form>
    </div>';
}

add_action('admin_menu', 'setup_theme_admin_menus');

?>