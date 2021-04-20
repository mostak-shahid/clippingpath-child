<?php
add_action( 'wp_head', 'add_mos_additional_coding', 999 );

function add_mos_additional_coding() {
    echo carbon_get_theme_option( 'mos_additional_coding' );
}
add_action( 'wp_init', 'mos_pricing_form_handling' );

function mos_pricing_form_handling() {
    if (isset( $_POST['mos_pricing_form_field'] ) && wp_verify_nonce( $_POST['mos_pricing_form_field'], 'mos_pricing_form_action' )) {
        wp_nonce_ays( '' );
    }
}