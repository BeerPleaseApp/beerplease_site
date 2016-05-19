<?php get_header(); ?>

<div class="main-inner">
    <main id="content" class="content" role="main">
        <div class="content-inner container">

            <article>
                <header class="title-wrapper row">
                    <div class="title-inner">
                        <?php get_template_part('templates/nav', 'breadcrumb'); ?>
                        <h1><?php _e('Search results', 'wpstartertheme'); ?></h1>
                    </div>
                </header>

                <div class="single single-<?php echo $post->post_type; ?> row">
                    <div class="single-body">
                        <blockquote>
                            <p><strong>
                                <?php
                                    global $wp_query;
                                    $count = $wp_query->found_posts;
                                    $pluriel = '';
                                    if ($count > 1): $pluriel = 's'; endif;
                                    _e('There are',  'wpstartertheme');
                                    echo '&nbsp;'.$count;
                                    _e(' result',  'wpstartertheme');
                                    echo $pluriel;
                                    if($s) :
                                        echo '&nbsp;';
                                        _e('for',  'wpstartertheme');
                                        echo '&nbsp;"'.$s.'"';
                                    endif;
                                    echo'.';
                                ?>
                            </strong></p>
                            <p><?php _e('Search again?', 'wpstartertheme'); ?></p>
                            <?php get_search_form(); ?>
                        </blockquote>

                        <?php if (have_posts()): ?>
                            <?php get_template_part('templates/nav', 'pager'); ?>

                            <?php get_template_part('templates/list', 'results'); ?>

                            <?php get_template_part('templates/nav', 'pager'); ?>
                        <?php else: ?>
                            <p><?php _e('Please be more specific in your search.', 'wpstartertheme'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        </div>
    </main>

</div>

<?php get_footer(); ?>