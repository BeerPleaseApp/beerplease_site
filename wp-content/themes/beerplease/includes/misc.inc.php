<?php
/* Teste le type de post (article, custom post type, page,...)
-----------------------------------------------------------------*/
function is_post_type($type)
{
    global $wp_query;

    if ($type == get_post_type($wp_query->post->ID)) {
        return true;
    }
    
    return false;
}

/* Test page enfant
-----------------------------------------------------------------*/
function is_child($parent = '')
{
    global $post;
 
    $parent_obj = get_page($post->post_parent, ARRAY_A);
    $parent = (string) $parent;
    $parent_array = (array) $parent;
 
    if (in_array( (string) $parent_obj['ID'], $parent_array)) {
        return true;
    } elseif (in_array( (string) $parent_obj['post_title'], $parent_array)) {
        return true;    
    } elseif (in_array( (string) $parent_obj['post_name'], $parent_array)) {
        return true;
    } else {
        return false;
    }
}

/* Slugifie le titre de mon post
-----------------------------------------------------------------*/
function get_slug()
{
    $post_obj = $wp_query->get_queried_object();
    $post_ID = $post_obj->ID;
    $post_title = $post_obj->post_title;
    $post_slug = $post_obj->post_name;

    return $post_slug;
}
?>