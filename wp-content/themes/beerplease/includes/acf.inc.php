<?php

/* ACF : Date & Time picker + Categories list
-----------------------------------------------------------------*/
if (function_exists('register_field')) {
    register_field('acf_time_picker', TEMPLATEPATH . '/includes/custom-fields/acf_time_picker/acf_time_picker.php');
    register_field('Categories_field', TEMPLATEPATH . '/includes/custom-fields/categories.php');
}

/* ACF : Activation du plugin répéteur
-----------------------------------------------------------------*/
add_filter('acf_settings', function($options) {
    // activate add-ons
    $options['activation_codes']['repeater'] = 'QJF7-L4IX-UCNP-RF2W';
    $options['activation_codes']['gallery'] = 'GF72-8ME6-JS15-3PZC';

    return $options;
});

?>