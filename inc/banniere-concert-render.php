<?php

defined('ABSPATH') or die('Nothing to see here.');

require_once BC_PLUGIN_DIR_PATH.'inc/banniere-concert-options.php';


function banniere_concert_render_options(){
    if(!current_user_can('manage_options')){
        return;
    }else{
        ?>
        <h2><?= esc_html(get_admin_page_title()) ?></h2>
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
            <?php
                settings_fields('bc_options');
                do_settings_sections('bc_options');
                submit_button();
            ?>
        </form>
    <?php
    }
}

