<div class="widget widget-address">
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
</div>