<?php $layout = get_query_var('btn-contact-us-layout', 'aside'); ?>
<a class="btn<?php echo ($layout !== 'footer') ? ' btn-icon' : ''; ?>" href="<?php echo routing_get('contact'); ?>">
    <?php if ($layout !== 'footer'): ?>
        <span class="icon icon-generic icon-plus"></span>
    <?php endif; ?>
    <?php _e('Contact-us!', 'wpstartertheme'); ?>
</a>