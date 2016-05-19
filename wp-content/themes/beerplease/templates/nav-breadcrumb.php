<?php
    $breadcrumb = array();

    // Home
    $breadcrumb[] = '<a href="'.get_bloginfo('url').'" title="'.__('Back to home page').'" itemprop="url">'.__('Home').'</a>';

    if (have_posts()) {
        // Parents
        if (is_single()) {
            switch ($post->post_type) {
                case 'post':
                    $breadcrumb[] = '<a href="'.routing_get('news').'" itemprop="url">'. get_the_title(routing_get_id('news')).'</a>';
                    break;
            }
        } else {
            breacrumbAddParents($breadcrumb, $post->ID);
        }

        // Current page
        $breadcrumb[] = get_the_title($post->ID);
    }

    //Add "Search" in the breadcrumb on the page which list the search results
    if(is_search()) {
        $breadcrumb[] = "<span class='parent'>".__('Search', 'wpstartertheme')."</span>";
    }

    //Add shop page title in the breadcrumb on the woocommerce pages, excluding single product page and shop template page
    /*if(!is_single() && !is_page_template('page-shop.php') && (is_woocommerce() || is_cart() || is_checkout())) {
        $breadcrumb[] = '<a href="'.routing_get('shop').'" itemprop="url">'. get_the_title(routing_get_id('shop')).'</a>';
    }*/

    //Add current tag/category name in the breadcrumb
    if (is_archive()) {
        $breadcrumb[] = single_cat_title("", false);
    }

    // Current page
    if(!is_search() && !is_archive()) {
        $breadcrumb[] = get_the_title($post->ID);
    }

    $i = 0;
    $breadcrumbCount = count($breadcrumb);
?>
<nav class="nav nav-breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
    <ol>
        <?php foreach ($breadcrumb as $item): ?>
            <?php
                $first = ($i === 0) ? true : false;
                $last = ($i === $breadcrumbCount-1) ? true : false;
                $itemClasses = array('nav-breadcrumbItem');

                $itemClasses[] = ($first) ? 'nav-breadcrumbItemFirst' : '';
                $itemClasses[] = ($last) ? 'nav-breadcrumbItemLast' : '';
            ?>
            <li id="bditem-<?php echo $i; ?>" class="<?php echo trim(implode(' ', $itemClasses)); ?>"<?php if (!$first): ?> itemprop="child"<?php endif; ?><?php if (!$last): ?> itemref="bditem-<?php echo $i+1; ?>"<?php endif; ?>>
                <?php if (!$first): ?>
                    <span> › </span>
                <?php endif; ?>

                <?php echo $item; ?>
            </li>
            <?php $i++; ?>
        <?php endforeach; ?>
    </ol>
</nav>