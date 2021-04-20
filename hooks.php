<?php
add_action('wp_head', 'add_mos_additional_coding', 999);
function add_mos_additional_coding(){
    echo carbon_get_theme_option( 'mos_additional_coding' );
}