<?php if (have_posts()): ?>
    <article class="single single-<?php echo $post->post_type; ?>">
        <p class="single-info"><?php _e('The', 'wpstartertheme'); ?> <?php the_time('j F Y'); ?>, <?php _e('in', 'wpstartertheme'); ?> <?php the_category(', '); ?></p>
        <?php the_content(); ?>
        
        <?php $posttags = get_the_tags(); ?>
        <?php if ($posttags): ?>
            <p class="tags">
                <strong><?php _e('Keywords', 'wpstartertheme'); ?> : </strong>
                <?php foreach ($posttags as $tag): ?>
                    <?php echo $tag->name . ', '; ?>
                <?php endforeach; ?>
            </p>
        <?php endif;?>
    </article>
    
    <?php comments_template(); ?>

    <div class="single-footer">
        <?php get_template_part('templates/social', 'share'); ?>
        <?php get_template_part('templates/nav', 'news'); ?>

    </div>
<?php endif; ?>