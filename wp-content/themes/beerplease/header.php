<!doctype html>
<!--[if IE 7]> <html class="no-js ie7" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:xlink="http://www.w3.org/1999/xlink"> <![endif]-->
<!--[if IE 8]>   <html class="no-js ie8" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:xlink="http://www.w3.org/1999/xlink"> <![endif]-->
<!--[if (gt IE 9)|(!IE)]><!--> <html class="no-js" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:xlink="http://www.w3.org/1999/xlink"> <!--<![endif]-->
<head>
    <meta charset="UTF-8" />
    <!--[if lt IE 9]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><!--<![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        $host = explode('/', str_replace(array('http://', 'https://'), '', get_bloginfo( 'url' )), 2);
        $cookieDomainApp = current($host);
        $cookiePathApp = sizeof($host) > 1 ? '/'.end($host) : '/';
    ?>
    <script type="text/javascript">
        var deviceType = '',
            templateDirectory = '<?php echo get_template_directory_uri(); ?>/',
            cookieDomainApp = '<?php echo $cookieDomainApp; ?>',
            cookiePathApp = '<?php echo $cookiePathApp; ?>',
            postId = '<?php echo !is_null($post) ? $post->ID : ''; ?>',
            wpurl = '<?php echo get_bloginfo('wpurl'); ?>';
    </script>
    <?php wp_head(); ?>

    <link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-touch-icon-57x57.png?v=2">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-touch-icon-60x60.png?v=2">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-touch-icon-72x72.png?v=2">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-touch-icon-76x76.png?v=2">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-touch-icon-114x114.png?v=2">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-touch-icon-120x120.png?v=2">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-touch-icon-144x144.png?v=2">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-touch-icon-152x152.png?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/apple-touch-icon-180x180.png?v=2">
    <link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/favicon-32x32.png?v=2" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/favicon-194x194.png?v=2" sizes="194x194">
    <link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/favicon-96x96.png?v=2" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/android-chrome-192x192.png?v=2" sizes="192x192">
    <link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/manifest.json?v=2">
    <link rel="mask-icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/safari-pinned-tab.svg?v=2" color="#f7b000">
    <meta name="msapplication-TileColor" content="#f7b000">
    <meta name="msapplication-TileImage" content="<?php bloginfo('stylesheet_directory'); ?>/images/favicons/mstile-144x144.png?v=2">
    <meta name="theme-color" content="#f7b000">

    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "name": "<?php echo get_bloginfo('name'); ?>",
        "alternateName": "<?php echo get_bloginfo('description'); ?>",
        "url": "<?php bloginfo('url'); ?>"
    }
    </script>
</head>
<body <?php body_class(); ?>>   
    <div class="global">
        <header class="header clearfix" role="banner">
            <div class="header-image"></div>
            <div class="header-background"></div>
            <div class="header-inner container">
                <div class="row">
                    <div class="logo logo-main">
                        <?php if (!is_front_page()): ?>
                            <a href="<?php bloginfo('url'); ?>" title="<?php echo __('Back to homepage', 'wpstartertheme'); ?>" rel="home">
                        <?php endif; ?>
                               <img src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/logo.svg" alt="Logo <?php echo get_bloginfo('name'); ?>" />
                        <?php if (!is_front_page()): ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if($baseline = get_bloginfo('description')) : ?>
                        <div class="logo logo-baseline">
                            <p><?php echo $baseline; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <nav class="nav nav-main row clearfix" role="navigation">
                    <?php
                        $arg = array(
                            'theme_location'	=> 'menu-primary',
                            'container' 	    => false,
                            'items_wrap'        => '<ul>%3$s</ul>',
                            'depth'             => 1
                        );
                        wp_nav_menu( $arg );
                    ?>
                </nav>
            </div>
        </header>
