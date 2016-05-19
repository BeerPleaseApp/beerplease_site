<?php
/*IMAGES : ajoute des tailles d'image personnalisées
-----------------------------------------------------------------*/
// ### ATTENTION : a chaque changement; régénérer les vignettes avec le plugin REGENERATE THUMBNAILS ###

// on vérifie que la fonction existe, puis on crée la nouvelle taille d'image.
if (function_exists('add_image_size')) {
    add_image_size('slider_main', 1920, 510, true);
    add_image_size('list', 120, 120, true);
    add_image_size('list_column', 365, 99999, false);
    add_image_size('list_grid', 271, 200, true);
}

/*IMAGES : récupère l'id de la première image d'un POST
---------------------------------------------------------------*/
if (!function_exists('get_attachment_id')) {
    /**
     * Get the Attachment ID for a given image URL.
     * @link   http://wordpress.stackexchange.com/a/7094
     * @param  string $url
     * @return boolean|integer
     */
    function get_attachment_id() {

        global $post, $posts;
        $first_img = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $url = count($matches[1]) ? $matches[1][0] : "";
        
        $dir = wp_upload_dir();

        // baseurl never has a trailing slash
        if ( false === strpos( $url, $dir['baseurl'] . '/' ) ) {
            // URL points to a place outside of upload directory
            return false;
        }

        $file  = basename( $url );
        $query = array(
            'post_type'  => 'attachment',
            'fields'     => 'ids',
            'meta_query' => array(
                array(
                    'value'   => $file,
                    'compare' => 'LIKE',
                ),
            )
        );

        $query['meta_query'][0]['key'] = '_wp_attached_file';

        // query attachments
        $ids = get_posts( $query );
        if ( ! empty( $ids ) ) {
            foreach ( $ids as $id ) {
                // first entry of returned array is the URL
                $media = wp_get_attachment_image_src($id, 'full');
                if ($url === array_shift($media))
                    return $id;
            }
        }

        $query['meta_query'][0]['key'] = '_wp_attachment_metadata';

        // query attachments again
        $ids = get_posts( $query );

        if ( empty( $ids) )
            return false;

        foreach ( $ids as $id ) {
            $meta = wp_get_attachment_metadata( $id );
            foreach ( $meta['sizes'] as $size => $values )
            {
                $media = wp_get_attachment_image_src($id, $size);
                if ($values['file'] === $file && $url === array_shift($media))
                    return $id;
            }
        }

        return false;
    }
}

if (!function_exists('get_first_post_media')) {
    /**
     * Récupère le 1er média d'un post
     * 
     * @param  object $item -> Le post courant
     * @param  string $size -> Nom machine du profil média
     * @return array('url', 'alt')
     */
    function get_first_post_media($item, $size)
    {
        global $post;
        $post = $item;
        $firstMedia = array();

        if (has_post_thumbnail()):
            $mediaSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
            $mediaAlt = get_the_title(get_post_thumbnail_id());
        else :
            $id = get_attachment_id();
            $mediaSrc = wp_get_attachment_image_src($id, $size);
            $mediaAlt = get_the_title($id);
        endif;

        if (isset($mediaSrc[0]) && $mediaSrc[0] !== null) {
            $firstMedia['url'] = $mediaSrc[0];
            $firstMedia['alt'] = (!empty($mediaAlt)) ? $mediaAlt : get_the_title($item->ID);
        
            return $firstMedia;
        }

        return false;
    }
}


/*IMAGES : ajoute automatiquement la classe "fancybox" aux liens sur les images des post
---------------------------------------------------------------*/
function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){ 
    $classes = 'fancybox'; 
    if ( preg_match('/<a.*? class=".*?">/', $html) ) { 
        $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html); 
    } 
    else { 
        $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html); 
    } 
    return $html; 
} 
add_filter('image_send_to_editor','give_linked_images_class', 10, 8);

/*IMAGES : affiche les images SVG dans l'admin
---------------------------------------------------------------*/
function wg_fix_svg_size_attributes( $out, $id )
{
    $image_url  = wp_get_attachment_url( $id );
    $file_ext   = pathinfo( $image_url, PATHINFO_EXTENSION );

    if ( ! is_admin() || 'svg' !== $file_ext )
    {
        return false;
    }

    return array( $image_url, null, null, false );
}
add_filter( 'image_downsize', 'wg_fix_svg_size_attributes', 10, 3 );
?>