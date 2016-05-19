<?php
    /* Template Name: Page mentions légales */
?>
<?php get_header(); ?>

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
                        <h2><?php _e('Site owner', 'wpstartertheme'); ?></h2>
                        <p>
                            <strong><?php echo get_bloginfo('name'); ?></strong><br />
                            <?php if ($clientAddr = get_option('wpstartertheme_client_address')): ?>
                                <?php echo $clientAddr; ?><br />
                            <?php endif; ?>

                            <?php if ($clientZipcode = get_option('wpstartertheme_client_zipcode')): ?>
                                <?php echo $clientZipcode; ?>
                            <?php endif; ?>

                            <?php if ($clientCity = get_option('wpstartertheme_client_city')): ?>
                                <?php echo $clientCity; ?><br />
                            <?php endif; ?>

                            <?php if ($clientPhone = get_option('wpstartertheme_client_phone')): ?>
                                <?php echo __('Phone', 'wpstartertheme') . ' : ' . $clientPhone; ?><br />
                            <?php endif; ?>

                            <?php if ($clientFax = get_option('wpstartertheme_client_fax')): ?>
                                <?php echo __('Fax', 'wpstartertheme') . ' : ' . $clientFax; ?>
                            <?php endif; ?>
                        </p>
                        
                        <h2><?php _e('Hoster contact information', 'wpstartertheme'); ?></h2>
                        <p><strong>Nom de l'hébergeur</strong><br />
                        Adresse de l'hébergeur<br />
                        00000 - Ville<br />
                        <?php _e('Phone', 'wpstartertheme'); ?> : 00 00 00 00 00<br />
                        
                        <h2><?php _e('Website designer contact information', 'wpstartertheme'); ?></h2>
                        <p>
                            <strong><a href="http://www.machin.fr" title="Site Internet de Machin - <?php _e('New window', 'wpstartertheme'); ?>" target="_blank">Machin</a></strong><br />
                            18 Rue adresse<br />
                            00000 - Ville</br>
                            <?php _e('Phone', 'wpstartertheme'); ?> : 00 00 00 00 00</br>
                            <?php _e('Fax', 'wpstartertheme'); ?> : 00 00 00 00 00
                        </p>

                        <?php the_content(); ?>
                    </div>
                </div>
            </article>
        </div>
    </main>

</div>

<?php get_footer(); ?>