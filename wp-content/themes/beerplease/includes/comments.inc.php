<?php
/**
 * Callback wp_list_comments() dans le template comments.php
 * @param  [type] $comment [description]
 * @param  [type] $args    [description]
 * @param  [type] $depth   [description]
 * @return [type]          [description]
 */
function wpstartertheme_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div class="author-avatar">
            <?php  if (get_avatar($comment, 75)): ?>
                <?php echo get_avatar($comment, 75); ?>
            <?php else: ?>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/avatar.png" alt="<?php echo $comment->comment_author; ?>" />;
            <?php endif; ?>
        </div>
 
        <div class="comment-body">
            <?php if ($comment->comment_approved === '0'): ?>
                <p class="moderation"><?php _e('Your comment is awaiting moderation.', 'wpstartertheme'); ?></p>
            <?php endif; ?>
 
            <div class="comment-date">
                <cite class="fn"><?php echo get_comment_author_link(); ?></cite>
                - <?php printf(__('On %1$s at %2$s', 'wpstartertheme'), get_comment_date(),  get_comment_time()); ?>
            </div>
 
            <div class="comment-text"><?php comment_text(); ?></div>
 
            <div class="reply">
                <?php edit_comment_link(__('Edit'), ' '); ?>
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            </div>
        </div>

<?php
    // </li> => wpstartertheme_comment_end()
}

/**
 * Fermeture du callback wpstartertheme_comment pour prendre en compte les réponses des commentaires
 */
function wpstartertheme_comment_end($comment, $args, $depth)
{
    echo '</li>';
}

/* Formulaire de commentaire non connecte : suppression champ url
-----------------------------------------------------------------*/
add_filter('comment_form_default_fields', function($fields) {
    unset($fields['url']);
    return $fields;
});

/* Formulaire de commentaire non connecte : modification champs
-----------------------------------------------------------------*/
add_filter('comment_form_default_fields', function($fields) {
    $fields =  array(
        'author' => '<p class="comment-form-author"><label for="author">' . __('Name') . ' <span class="form-required">*</span></label><input id="author" name="author" type="text" value="" /></p>',
        'email' => '<p class="comment-form-email"><label for="email">' . __('Email', 'wpstartertheme') . ' <span class="form-required">*</span></label><input id="email" name="email" type="email" value="" /></p>'
    );

    return $fields;
});

add_filter('preprocess_comment', function($commentdata) {
    $verifmail = "!^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$!";

    if (!isset($_POST['author'])) {
        // si author est vide on affiche une erreur  
        wp_die(__('Please enter your name.', 'wpstartertheme'));
    } elseif (!isset($_POST['email'])) {
        // si author est vide on affiche une erreur  
        wp_die(__('Please enter your email address.', 'wpstartertheme'));
    } elseif (isset($_POST['email']) && !preg_match($verifmail, $_POST['email'])) {
        // si email n'est pas valide 
        wp_die(__('Please enter valid email.', 'wpstartertheme'));
    }

    return $commentdata;
});

?>