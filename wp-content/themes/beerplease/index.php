<?php
    /* Template Name: Page d'accueil */
?>
<?php get_header(); ?>

<div class="main-inner">
    <main id="content" class="content" role="main">
        <div class="content-inner container">
            <article>
                <header class="title-wrapper row">
                    <div class="title-inner">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </header>

                <div class="single single-home row">
                    <div class="single-body">
                        <?php the_content(); ?>
                    </div>
                </div>
            </article>
        </div>
    </main>
</div>

<?php get_footer(); ?>