<?php
//require_once 'widget-click2call.inc.php';

class Widget_address extends WP_Widget
{
    public function __construct() {
        parent::__construct('widget_address', 'Adresse complète', array('description' => 'Affiche l\'adresse saisie dans la configuration'));
    }

    public function widget($args, $instance) {
        get_template_part('templates/widget', 'address');
    }
}

class Widget_contact extends WP_Widget
{
    public function __construct() {
        parent::__construct('Widget_contact', 'Bouton Contactez-nous', array('description' => 'Lien vers la page contact'));
    }

    public function widget($args, $instance) {
        echo '<div class="widget">';
            get_template_part('templates/btn', 'contact-us');
        echo '</div>';
    }
}

function init_widgets()
{
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    
    register_widget('widget_address');
    register_widget('Widget_contact');
}
add_action('widgets_init', 'init_widgets', 1);
?>