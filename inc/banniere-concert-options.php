<?php

defined('ABSPATH') or die('Nothing to see here.');

function bc_register_settings(){
    // Déclaration des diférentes options du plugin
    register_setting('bc_options', 'bc_displayed', 'validation_display');
    register_setting('bc_options', 'bc_date');
    register_setting('bc_options', 'bc_location');
    register_setting('bc_options', 'bc_banner_color');

    // Création de la section pour l'affichage des inputs
    add_settings_section(
        'bc_main_options',
        __('Banner options', 'banniere-concert'),
        function(){},
        'bc_options'
    );

    // Création des champs d'input
    add_settings_field(
        'bc_displayed',
        __('Banner activated', 'banniere-concert'),
        function(){echo'<input type="radio" name="bc_displayed" id="oui" value="oui"'.(esc_attr(get_option('bc_displayed')) == 'oui'?"checked": "").'/><label for="oui">Oui</label><input type="radio" name="bc_displayed" id="non" value="non"'.(esc_attr(get_option('bc_displayed')) == 'non'?"checked": "").'/><label for="non">Non</label>';},
        'bc_options',
        'bc_main_options'
    );
    add_settings_field(
        'bc_date',
        __('Date', 'banniere-concert'),
        function(){echo '<input type="text" class="date-picker-input" name="bc_date" value="'.(!empty(esc_attr(get_option('bc_date')))?esc_attr(get_option('bc_date')): '').'"/>';},
        'bc_options',
        'bc_main_options'
    );
    add_settings_field(
        'bc_location',
        __('Location', 'banniere-concert'),
        function(){echo '<input type="text" name="bc_location" value="'.(!empty(esc_attr(get_option('bc_location')))?esc_attr(get_option('bc_location')): '').'"/>';},
        'bc_options',
        'bc_main_options'
    );
    add_settings_field(
        'bc_banner_color',
        __('Banner\'s color', 'banniere-concert'),
        function(){echo '<input type="color" class="bc-color-picker" name="bc_banner_color" value="'.(!empty(esc_attr(get_option('bc_banner_color')))?esc_attr(get_option('bc_banner_color')): '').'"/>';},
        'bc_options',
        'bc_main_options'
    );
}

add_action('admin_init', 'bc_register_settings');



// Ajout d'une fonction sur le callback du choix d'activation de la bannière pour afficher un message personnalisé
function validation_display($input){
    if($input == 'oui'){
        add_settings_error('banner-activated', 'activated', 'Votre bannière est activée.', 'success');
    }else{
        add_settings_error('banner-disactivated', 'disactivated', 'Votre bannière est désactivée.', 'error');
    }
    return $input;
}