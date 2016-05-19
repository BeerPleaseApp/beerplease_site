<nav class="nav nav-news">
    <ul>
        <li>
            <a class="btn btn-secondary" href="<?php echo routing_get_id('news'); ?>" title="<?php _e('Toutes les actualités', 'wpstartertheme'); ?>"><?php _e('All news', 'wpstartertheme'); ?></a>
        </li>
        <li>
            <a class="btn btn-secondary btn-feed" href="<?php get_bloginfo_rss('url') ?>/feed/?post_type=post" title="<?php _e('Blog RSS Feed - New window', 'wpstartertheme'); ?>" target="_blank">
                <span class="fa fa-rss"></span>
            </a>
        </li>
    </ul>
</nav>