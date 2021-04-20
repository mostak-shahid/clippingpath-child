<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );
require_once 'carbon-fields.php';
require_once 'theme-init/plugin-update-checker.php';
$themeInit = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/mostak-shahid/update/master/clippingpath-child.json',
	__FILE__,
	'clippingpath-child'
);
/**
 * Enqueue styles
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

function child_elements_enqueue_styles(){
	wp_enqueue_style( 'owl.carousel', get_stylesheet_directory_uri() . '/plugins/owlcarousel/owl.carousel.min.css');
	wp_enqueue_style( 'owl.theme.default.min', get_stylesheet_directory_uri() . '/plugins/owlcarousel/owl.theme.default.min.css');
	wp_enqueue_style( 'elements', get_stylesheet_directory_uri() . '/css/elements.css');
    
    wp_enqueue_script( 'owl.carousel', get_stylesheet_directory_uri() . '/plugins/owlcarousel/owl.carousel.min.js', 'jquery');
    wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js', 'jquery');
    
}
add_action( 'wp_enqueue_scripts', 'child_elements_enqueue_styles');
add_action( 'admin_enqueue_scripts', 'child_elements_enqueue_styles');

// require_once('my-widgets.php');

function set_element_typography($settings,$key){
    $output = '';
    if ($settings['_tab_title_typography_typography'] && $settings[$key.'_typography']!='custom')
        $output .= 'font-family: '.$settings[$key.'_typography'].';';
    if ($settings[$key.'_font_size'])
        $output .= 'font-size: '.$settings[$key.'_font_size']['size'].$settings[$key.'_font_size']['unit'].';';
    if ($settings[$key.'_font_weight'])
        $output .= 'font-weight: '.$settings[$key.'_font_weight'].';';
    if ($settings[$key.'_text_transform'])
        $output .= 'text-transform: '.$settings[$key.'_text_transform'].';';
    if ($settings[$key.'_font_style'])
        $output .= 'font-style: '.$settings[$key.'_font_style'].';';
    if ($settings[$key.'_text_decoration'])
        $output .= 'text-decoration: '.$settings[$key.'_text_decoration'].';';
    if ($settings[$key.'_line_height'])
        $output .= 'line-height: '.$settings[$key.'_line_height']['size'].$settings[$key.'_line_height']['unit'].';';       
    if ($settings[$key.'_letter_spacing'])
        $output .= 'letter-spacing: '.$settings[$key.'_letter_spacing']['size'].$settings[$key.'_letter_spacing']['unit'].';';
    return $output;
}
function set_element_dimensions($settings,$key,$mode){    
    $output = '';
    if ($settings[$key]['top'])
        $output .=$mode.'-top:'.$settings[$key]['top'].$settings[$key]['unit'].';';
    else
        $output .=$mode.'-top:0;'; 
    if ($settings[$key]['right'])
        $output .=$mode.'-right:'.$settings[$key]['right'].$settings[$key]['unit'].';';
    else
        $output .=$mode.'-right:0;'; 
    if ($settings[$key]['bottom'])
        $output .=$mode.'-bottom:'.$settings[$key]['bottom'].$settings[$key]['unit'].';';
    else
        $output .=$mode.'-bottom:0;'; 
    if ($settings[$key]['left'])
        $output .=$mode.'-left:'.$settings[$key]['left'].$settings[$key]['unit'].';';
    else
        $output .=$mode.'-left:0;'; 
    return $output;
}
function set_element_shadow($settings,$key){
    $output = '';
    $output .= '-webkit-box-shadow: '.$settings[$key]['horizontal'].'px '.$settings[$key]['vertical'].'px '.$settings[$key]['blur'].'px '.$settings[$key]['spread'].'px '.$settings[$key]['color'].';';
    $output .= '-moz-box-shadow: '.$settings[$key]['horizontal'].'px '.$settings[$key]['vertical'].'px '.$settings[$key]['blur'].'px '.$settings[$key]['spread'].'px '.$settings[$key]['color'].';';
    $output .= '-o-box-shadow: '.$settings[$key]['horizontal'].'px '.$settings[$key]['vertical'].'px '.$settings[$key]['blur'].'px '.$settings[$key]['spread'].'px '.$settings[$key]['color'].';';
    $output .= 'box-shadow: '.$settings[$key]['horizontal'].'px '.$settings[$key]['vertical'].'px '.$settings[$key]['blur'].'px '.$settings[$key]['spread'].'px '.$settings[$key]['color'].';';  
    return $output;
    
}