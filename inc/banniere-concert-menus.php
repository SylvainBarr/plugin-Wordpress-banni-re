<?php 

defined('ABSPATH') or die('Nothing to see here.');


require_once BC_PLUGIN_DIR_PATH.'inc/banniere-concert-render.php';

function banniere_concert_menu()
{
    add_submenu_page(
        'themes.php',
        __('Next concert\'s banner', 'banniere-concert'),
        __('Next concert', 'banniere-concert'),
        'manage_options',
        'banniere-concert-settings',
        'banniere_concert_render_options',
    );

}

add_action('admin_menu', 'banniere_concert_menu');