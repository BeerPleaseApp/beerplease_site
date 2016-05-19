<?php $searchInputId = 'search-input-' . uniqid(); ?>
<div class="search search-form" role="search">
    <form class="form-search" role="search" method="get" action="<?php echo home_url('/'); ?>">
        <label for="<?php echo $searchInputId; ?>"><?php _e('Search'); ?> :</label>
        <input id="<?php echo $searchInputId; ?>" class="form-text" type="search" placeholder="<?php _e('Keywords', 'wpstartertheme'); ?>" name="s" id="<?php echo $searchInputId; ?>" />
        <button name="search-submit" type="submit" class="form-submit"><i class="fa fa-search fa-2x"></i><span>OK</span></button>
    </form>
</div>