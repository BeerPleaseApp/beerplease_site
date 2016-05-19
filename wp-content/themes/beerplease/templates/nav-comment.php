<?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
    <nav class="nav nav-comment">
        <div class="nav-comment-previous"><?php previous_comments_link(__('&larr; Oldest reviews')); ?></div>
        <div class="nav-comment-next"><?php next_comments_link(__('Newest reviews &rarr;')); ?></div>
    </nav>
<?php endif; ?>