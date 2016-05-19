<?php
    /* Template Name: Actualités */
?>
<?php get_header(); ?>

<div class="main-inner">
    <main id="content" class="content" role="main">
        <div class="content-inner container">
            <article>
                <header class="title-wrapper row">
                    <div class="title-inner">
                        <?php get_template_part('templates/nav', 'breadcrumb'); ?>
                        <h1>
                            <?php if (is_day()): ?>
                                <?php printf(__('News - Archives of %s', 'wpstartertheme'), '<span>' . get_the_date() . '</span>'); ?>
                            <?php elseif (is_month()): ?>
                                <?php printf(__('News - Archive of the month of %s', 'wpstartertheme'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'twentyeleven')) . '</span>'); ?>
                            <?php elseif (is_year()): ?>
                                <?php printf(__('News - Archive of the year %s', 'wpstartertheme'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'twentyeleven')) . '</span>'); ?>
                            <?php else: ?>
                                <?php _e('News', 'wpstartertheme'); ?>
                            <?php endif; ?>
                        </h1>
                    </div>
                </header>

                <div class="single single-<?php echo $post->post_type; ?> row">
                    <div class="single-body">
                        <?php if (have_posts()): ?>
                            <?php get_template_part('templates/nav', 'pager'); ?>

                            <?php get_template_part('templates/list'); ?>
                                        
                            <?php get_template_part('templates/nav', 'pager'); ?>

                        <?php else: ?>
                            <p><?php _e('No news for this moment.'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        </div>
    </main>

</div>

<?php get_footer(); ?>