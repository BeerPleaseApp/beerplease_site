<?php get_header(); ?>
<?php $postType = get_post_type($post->ID) ?>

<div class="main-inner">
    <main id="content" class="content" role="main">
        <div class="content-inner container">
            <article>
                <header class="title-wrapper row">
                    <div class="title-inner">
                        <?php get_template_part('templates/nav', 'breadcrumb'); ?>
                        <h1><?php the_title(); ?></h1>
                    </div>
                </header>
                <div class="single single-<?php echo $post->post_type; ?> row">
                    <div class="single-body">
                        <?php 
                            if (locate_template('templates/single-' . $postType . '.php') != '') {
                                get_template_part('templates/single', $postType);
                            } else {
                                the_content();
                            } 
                        ?>
                    </div>
                </div>
            </article>
        </div>
    </main>

</div>

<?php get_footer(); ?>