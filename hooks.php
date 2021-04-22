<?php
add_action( 'init', 'mos_pricing_form_handling' );
function mos_pricing_form_handling(){
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if( isset( $_POST['mos_pricing_form_field'] ) && wp_verify_nonce( $_POST['mos_pricing_form_field'], 'mos_pricing_form_action') ) {
            $headers = array('Content-Type: text/html; charset=UTF-8');

            $to = ($_POST['["admin"]'])?$_POST['["admin"]']:get_option( 'admin_email' );
            $subject = 'Pricing Query from Clipping Path Campus';
            $body = '<strong>Name</strong>: ' . $_POST['name'] . '<br/>';
            $body .= '<strong>Email</strong>: ' . $_POST['email'] . '<br/>';
            $body .= '<strong>Service</strong>: ' . $_POST['services'] . '<br/>';
            $body .= '<strong>Quantity</strong>: ' . $_POST['quantity'] . '<br/>';
            $body .= '<strong>The type of shadow</strong>: ' . $_POST['shadow'] . '<br/>';
            $body .= '<strong>Straighten, crop and set margin</strong>: ' . $_POST['features'] . '<br/>';
            $body .= '<strong>Images resized</strong>: ' . $_POST['resize'] . '<br/>';
            $body .= '<strong>Dimention</strong>: ' . $_POST['dimention'] . '<br/>';
            $body .= '<p>' . $_POST['comment'] . '</p>';

            wp_mail( $to, $subject, $body, $headers );

            $to = $_POST['email'];
            $subject = 'Thank you from Clipping Path Campus';
            $body = 'Dear ' . $_POST['name'] . '<br/>';
            $body .= 'Thank you for reaching out to Clipping Path Campus. We appreciate that you’ve taken the time to check out our exclusive photo editing services.  We express our excitement at the prospect of working with you! We will assign one of our associates to get back to you with additional information as soon as possible so we can get started without any delays!<br/>';
            $body .= 'We welcome you to try our services before you make up your mind.<br/>';
            $body .= 'Cheers<br/>';
            $body .= 'Clipping Path Campus team';

            wp_mail( $to, $subject, $body, $headers );
            
            wp_redirect( $_POST['redirect'] );
            exit;
/*
array(13) {
  ["mos_pricing_form_field"]=>
  string(10) "f8a58744f9"
  ["_wp_http_referer"]=>
  string(13) "/our-pricing/"
  ["admin"]=>
  string(22) "to.hasannaim@gmail.com"
  ["redirect"]=>
  string(42) "http://clippingpath.localhost/our-pricing/"
  ["services"]=>
  string(24) "Image Background Removal"
  ["quantity"]=>
  string(1) "1"
  ["name"]=>
  string(17) "Md. Mostak Shahid"
  ["email"]=>
  string(20) "mostak.apu@gmail.com"
  ["shadow"]=>
  string(14) "Natural shadow"
  ["features"]=>
  string(3) "Yes"
  ["resize"]=>
  string(3) "Yes"
  ["dimention"]=>
  string(9) "1920x1024"
  ["comment"]=>
  string(23) "sdf sdf sd fsdf sdf sdf"
}
*/
        }
    }
}

add_action( 'wp_head', 'add_mos_additional_coding', 999 );
function add_mos_additional_coding() {
    echo carbon_get_theme_option( 'mos_additional_coding' );
}
