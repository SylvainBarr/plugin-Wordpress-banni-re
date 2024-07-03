<?php

/*
Plugin Name: Bannière Concert
Author: Sylvain Barrellon
Author URI: https://www.example.com
Description: A banner plugin to showcase the next concert
*/

defined('ABSPATH') or die('Nothing to see here.');

define('BC_PLUGIN_URL', plugin_dir_url(__FILE__));
define("BC_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));

require_once BC_PLUGIN_DIR_PATH . 'inc/banniere-concert-menus.php';

// Ajout du style et script sur la partie admin du site seulement
function bc_admin_add_styles_and_scripts(){
    if(is_admin()){
        wp_enqueue_style('date-picker-style', 'https://cdn.jsdelivr.net/npm/js-datepicker@5.18.2/dist/datepicker.min.css');
        wp_enqueue_style('bc-style', BC_PLUGIN_URL.'/inc/banniere-concert-admin.css', ['wp-color-picker', 'date-picker-style']);
        wp_enqueue_script('date-picker-script', 'https://cdn.jsdelivr.net/npm/js-datepicker@5.18.2/dist/datepicker.min.js');
        wp_enqueue_script(
            'bc-script',
            BC_PLUGIN_URL.'/inc/banniere-concert-admin.js', 
            ['wp-color-picker', 'jquery', 'date-picker-script'], 
            false, 
            true
        );
        $settings = [
            'concertDate' => esc_attr(get_option('bc_date'))
        ];
        wp_localize_script('bc-script', 'settings', $settings);
    }
}

add_action('admin_enqueue_scripts', 'bc_admin_add_styles_and_scripts');


// Ajout du style et script front 
function bc_front_add_scripts_and_styles(){
    wp_enqueue_style('bc-front-style', BC_PLUGIN_URL.'/inc/banniere-concert-front.css');
    wp_enqueue_script('bc-front-script', BC_PLUGIN_URL.'/inc/banniere-concert-front.js', ['jquery'], false, true);
    $settings = [
        'bannerColor' => esc_attr(get_option('bc_banner_color')),
        'isDisplayed' => esc_attr(get_option('bc_displayed')),
    ];
    wp_localize_script('bc-front-script', 'settings', $settings);
}

add_action('wp_enqueue_scripts', 'bc_front_add_scripts_and_styles');


// Insertion du Html dans le front
function bc_include_front_snippet(){
    $bcLocation = get_option('bc_location');
    $bcDate = get_option('bc_date');
    ?>
    <div id="banniere-concert">
        <p>En concert le <b><?= wp_date('d F Y', strtotime($bcDate)) ?></b> à <b><?= $bcLocation ?></b></p>
    </div>
    <?php
}

add_action('wp_footer', 'bc_include_front_snippet');


// Chargement du fichier d'internationalisation
function bc_load_text_domain(){
    load_plugin_textdomain('banniere-concert', false, dirname(plugin_basename(__FILE__)).'/languages');
}

add_action('init', 'bc_load_text_domain');


// Ajout du lien de réglage directement sur le plugin dans la partie 'Extensions' de l'admin du site WP
function bc_add_action_links($actions){
    // définition des nouveaux liens à ajouter aux liens d'action du plugin
    $mylinks= ['<a href="'.admin_url('themes.php?page=banniere-concert-settings').'">Réglages</a>',];
    // ajout aux actions déjà définies
    $actions = array_merge($mylinks, $actions);
    return $actions;
}

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'bc_add_action_links');