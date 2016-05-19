<?php
// Gestion des contenus qui apparaissent dans le fil rss global
add_filter('request', function($qv) {
    if (isset($qv['feed']) && !isset($qv['post_type'])) {
        $qv['post_type'] = array('post', 'produits');
    }

    return $qv;
});

// Elargir la recherche à custom post type
add_filter('pre_get_posts', function($query) {
    if ($query->is_search) {
        $query->set('post_type', array('post', 'page'));
    };

    return $query;
});

/*FONCTION Compte le nombre d'articles d'une catégorie donnée
-----------------------------------------------------------------*/
function wt_get_category_count($input)
{
    global $wpdb;

    if ($input == '') {
        $category = get_the_category();
        $nombre_articles = $category[0]->category_count;
    } elseif (is_numeric($input)) {
        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
        $nombre_articles = $wpdb->get_var($SQL);
    } else {
        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
        $nombre_articles = $wpdb->get_var($SQL);
    }
}

/*PLUGIN ARTICLE : Récupère les derniers articles
-----------------------------------------------------------------*/
function mdv_recent_posts($no_posts = 10, $before = '<li>', $after = '</li>', $hide_pass_post = true, $skip_posts = 0, $show_excerpts = false)
{
    global $wpdb; 
    $time_difference = get_settings('gmt_offset'); 
    $now = gmdate("Y-m-d H:i:s",time()); 
    $request = "SELECT ID, post_title, post_excerpt FROM $wpdb->posts WHERE post_status = 'publish' ";

    if ($hide_pass_post) {
        $request .= "AND post_password ='' ";
    }

    $request .= "AND post_date_gmt < '$now' ORDER BY post_date DESC LIMIT $skip_posts, $no_posts"; 
    $posts = $wpdb->get_results($request);
    $output = '';

    if ($posts) {
        foreach ($posts as $post) {
            $post_title = stripslashes($post->post_title);
            $permalink = get_permalink($post->ID);
            $output .= $before . '<a href="' . $permalink . '" rel="bookmark" title="Permanent Link: ' . htmlspecialchars($post_title, ENT_COMPAT) . '">' . htmlspecialchars($post_title) . '</a>';
            
            if ($show_excerpts) {
                $post_excerpt = stripslashes($post->post_excerpt);
                $output .= '<br />' . $post_excerpt;
            }
            $output .= $after;
        }
    } else { 
        $output .= $before . "None found" . $after; 
    }

    echo $output; 
} 

/*PLUGIN ARTICLE : Récupère les derniers commentaires
-----------------------------------------------------------------*/
function mdv_recent_comments($no_comments = 10, $comment_lenth = 5, $before = '<li>', $after = '</li>', $show_pass_post = false, $comment_style = 0) {
    global $wpdb;
    $request = "SELECT ID, comment_ID, comment_content, comment_author, comment_author_url, post_title FROM $wpdb->comments LEFT JOIN $wpdb->posts ON $wpdb->posts.ID=$wpdb->comments.comment_post_ID WHERE post_status IN ('publish','static') ";
    if (!$show_pass_post) {
        $request .= "AND post_password ='' ";
    }
    $request .= "AND comment_approved = '1' ORDER BY comment_ID DESC LIMIT $no_comments";
    $comments = $wpdb->get_results($request);
    $output = '';

    if ($comments) {
        foreach ($comments as $comment) {
            $comment_author = stripslashes($comment->comment_author);
            if ($comment_author == '') {
                $comment_author = "anonymous";
            }
            $comment_content = strip_tags($comment->comment_content);
            $comment_content = stripslashes($comment_content);
            $words=split(" ",$comment_content); 
            $comment_excerpt = join(" ",array_slice($words,0,$comment_lenth));
            $permalink = get_permalink($comment->ID)."#comment-".$comment->comment_ID;

            if ($comment_style == 1) {
                $post_title = stripslashes($comment->post_title);
                
                $url = $comment->comment_author_url;

                if (empty($url)) {
                    $output .= $before . $comment_author . ' on ' . $post_title . '.' . $after;
                } else {
                    $output .= $before . "<a href='$url' rel='external'>$comment_author</a>" . ' on ' . $post_title . '.' . $after;
                }
            } else {
                $output .= $before . '' . $comment_author . ':  <a href="' . $permalink;
                $output .= '" title="View the entire comment by ' . $comment_author.'">' . $comment_excerpt.'</a>' . $after;
            }
        }
        $output = convert_smilies($output);
    } else {
        $output .= $before . "None found" . $after;
    }
    echo $output;
}
?>