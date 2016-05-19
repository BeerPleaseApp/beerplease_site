<?php do_action('comment_form'); ?>

<?php if (post_password_required()) { return; } ?>

<div class="comments">
    <?php if (have_comments()): ?>
        <h3 class="comments-title">
            <?php printf(_n('One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'wpstartertheme'), number_format_i18n(get_comments_number()), get_the_title()); ?>
        </h3>

        <?php get_template_part('templates/nav', 'comment'); ?>

        <ul class="list">
            <?php wp_list_comments(array(
                'short_ping' => true,
                'avatar_size'=> 75,
                'max_depth' => 2,
                'type' => 'comment', 
                'callback' => 'wpstartertheme_comment',
                'end-callback' => 'wpstartertheme_comment_end'
            )); ?>
        </ul>

        <?php get_template_part('templates/nav', 'comment'); ?>

        <?php if (!comments_open()): ?>
            <p><?php _e('Comments are closed.', 'wpstartertheme'); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <?php comment_form(); ?>
</div>