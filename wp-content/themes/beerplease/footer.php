            <footer class="footer" role="contentinfo">
                <div class="footer-inner container">
                    <div class="row">
                        <?php get_template_part('/templates/social-networks'); ?>
                    </div>
                    <div class="row">
                        <nav class="nav nav-footer">
                            <p>&copy; <?php _e('All rights reserved', 'wpstartertheme'); ?> <?php echo date('Y'); ?>
                            <?php
                                $arg = array(
                                    'theme_location'	=> 'menu-footer',
                                    'container' 	    => false,
                                    'items_wrap'        => '<ul>%3$s</ul>',
                                    'depth'             => 1,
                                    'menu_class'		=> 'clearfix'
                                );
                                wp_nav_menu( $arg );
                            ?>
                        </nav>
                    </div>
                </div>
            </footer>

    </div><!-- .global -->
    
    <?php wp_footer(); ?>    
    <?php get_template_part('templates/google', 'analytics'); ?>
    <?php get_template_part('templates/notice', 'cookie'); ?>
</body>
</html>