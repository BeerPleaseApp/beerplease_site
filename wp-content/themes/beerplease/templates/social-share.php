<?php
    $currentTitle = get_the_title();
    $currentUrl = get_permalink();
    $share = array(
        'facebook' => array(
            'url' => 'http://www.facebook.com/sharer/sharer.php?u=' . $currentUrl,
            'title' => 'Partagez sur Facebook',
            'icon' => 'fa-facebook'
        ),
        'twitter' => array(
            'url' => 'http://twitter.com/share?url=' . $currentUrl . '&text=' . $currentTitle,
            'title' => 'Partagez sur Twitter',
            'icon' => 'fa-twitter'
        ),
        'googleplus' => array(
            'url' => 'https://plus.google.com/share?url=' . $currentUrl,
            'title' => 'Partagez sur Google+',
            'icon' => 'fa-google-plus'
        ),
        'mail' => array(
            'url' => 'mailto:?subject=' . $currentTitle . '&body=' . $currentUrl,
            'title' => 'Partagez par email',
            'icon' => 'fa-envelope'
        ),
    );
?>
<div class="social social-share">
    <ul>
        <?php foreach ($share as $shareKey => $shareValue): ?>
            <li class="social-item social-<?php echo $shareKey; ?>">
                <a href="<?php echo htmlspecialchars($shareValue['url']); ?>" title="<?php echo $shareValue['title']; ?>"  onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700'); return false;" target="_blank">
                    <i class="fa <?php echo $itemData['icon']; ?>">"></i>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>