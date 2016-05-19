<?php
    $siteName = get_bloginfo('name');
    $social = array(
        'facebook' => array(
            'url' => get_option('wpstartertheme_social_facebook'),
            'type' => __('Page', 'wpstartertheme'),
            'name' => 'Facebook',
            'icon' => 'fa-facebook'
        ),
        'twitter' => array(
            'url' => get_option('wpstartertheme_social_twitter'),
            'type' => __('Profil', 'wpstartertheme'),
            'name' => 'Twitter',
            'icon' => 'fa-twitter'
        ),
        'googleplus' => array(
            'url' => get_option('wpstartertheme_social_googleplus'),
            'type' => __('Profil', 'wpstartertheme'),
            'name' => 'Google+',
            'icon' => 'fa-google-plus'
        ),
        'pinterest' => array(
            'url' => get_option('wpstartertheme_social_pinterest'),
            'type' => __('Page', 'wpstartertheme'),
            'name' => 'Pinterest',
            'icon' => 'fa-pinterest'
        ),
        'instagram' => array(
            'url' => get_option('wpstartertheme_social_instagram'),
            'type' => __('Profil', 'wpstartertheme'),
            'name' => 'Instagram',
            'icon' => 'fa-instagram'
        ),
        'linkedin' => array(
            'url' => get_option('wpstartertheme_social_linkedin'),
            'type' => __('Profil', 'wpstartertheme'),
            'name' => 'Linked In',
            'icon' => 'fa-linkedin'
        )
    );
?>
<div class="social">
    <ul>
        <?php foreach ($social as $itemName => $itemData): ?>
            <?php if (!empty($itemData['url'])): ?>
                <li class="social-item social-<?php echo $itemName; ?>">
                    <?php $itemTitle = $itemData['type'] . ' ' . $itemData['name'] . ' ' . _x('from', 'social-networks', 'wpstartertheme') . ' ' . $siteName . ' - ' . __('New window', 'wpstartertheme'); ?>
                    <a href="<?php echo $itemData['url']; ?>" target="_blank" title="<?php echo $itemTitle; ?>">
                        <i class="fa <?php echo $itemData['icon']; ?>"></i>
                        <span class="text"><?php echo $itemData['name']; ?></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>