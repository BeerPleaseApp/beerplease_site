<?php if( !isset($_COOKIE['BEERPLEASE-COOKIE-ACCEPT']) ) : ?>
    <div id="cookie-legal-notice" class="notice notice-cookie">
        <p>
            <?php _e('By browsing this site, you accept the use of cookies to compile statistics of attendance and thus improve interest and usability of our services.', 'wpstartertheme'); ?>
            <a href="<?php echo routing_get('legals'); ?>#cookie"><?php _e('Read more', 'wpstartertheme'); ?></a><button><?php _e('OK', 'wpstartertheme'); ?></button>
        </p>
    </div>
<?php endif; ?>