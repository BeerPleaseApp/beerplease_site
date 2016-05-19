 <ul class="list list-search-results">
    <?php while (have_posts()): the_post(); ?>
        <?php 
            switch ($post->post_type) {
                case 'page':
                    $type = __('Page', 'wpstartertheme');
                    break;
                case 'post':
                    $type = __('Blog', 'wpstartertheme');
                    break;
                default:
                    $type = '';
                    break;                                                          
            }
        ?>
        <li class="list-item is-link">
             <article>
                <header class="item-header">
                    <h2 class="item-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ($type): ?>
                                <span class="item-type"><?php echo $type; ?></span>&nbsp;-&nbsp;
                            <?php endif; ?>

                            <?php the_title(); ?>
                        </a>
                    </h2>
                </header>
                <div class="item-body">
                    <p class="item-url"><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a>
                    <p class="item-desc"><?php echo truncate(get_the_excerpt(), 300); ?></p>
                </div>
            </article>
        </li>
    <?php endwhile; ?>
</ul>