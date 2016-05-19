<?php $truncate = get_query_var('truncate-news-desc', 300); ?>
<ul class="list list-news">
    <?php while (have_posts()): the_post(); ?>
        <?php
            $image = get_first_post_media($post, 'list');

            $rowClasses = array('list-item is-link');
            $rowClasses[] = ($image) ? 'l-media' : '';
        ?>
        <li class="<?php echo trim(implode(' ', $rowClasses)); ?>">
            <article>
                <header class="item-header">
                    <h2 class="item-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="item-infos"><?php _e('The', 'wpstartertheme'); ?> <?php the_time('j F Y'); ?>, <?php _e('in', 'wpstartertheme'); ?> <?php the_category(', '); ?></p>
                </header>

                <div class="item-body">
                    <?php if ($image): ?>
                        <div class="item-image">
                            <a href="<?php the_permalink(); ?>">
                                <img class="media media-borderedTop" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                            </a>
                        </div>
                    <?php endif; ?>
                    <p class="item-desc"><?php echo truncate(get_the_excerpt(), $truncate); ?></p>
                </div>


                <footer class="item-footer">
                    <a class="btn btn-link" href="<?php the_permalink(); ?>"><?php _e('Read more', 'wpstartertheme'); ?></a>
                </footer>

            </article>
        </li>
     <?php endwhile; ?>
</ul>