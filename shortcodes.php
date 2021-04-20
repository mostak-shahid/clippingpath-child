<?php
function admin_shortcodes_page(){
	//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null )
    add_menu_page( 
        __( 'Theme Short Codes', 'textdomain' ),
        'Short Codes',
        'manage_options',
        'shortcodes',
        'shortcodes_page',
        'dashicons-book-alt',
        3
    ); 
}
add_action( 'admin_menu', 'admin_shortcodes_page' );
function shortcodes_page(){
	?>
	<div class="wrap">
		<h1>Theme Short Codes</h1>
		<ol>
			<li>[home-url slug=''] <span class="sdetagils">displays home url</span></li>
			<li>[site-identity class='' container_class=''] <span class="sdetagils">displays site identity according to theme option</span></li>
			<li>[site-name link='0'] <span class="sdetagils">displays site name with/without site url</span></li>
			<li>[copyright-symbol] <span class="sdetagils">displays copyright symbol</span></li>
			<li>[this-year] <span class="sdetagils">displays 4 digit current year</span></li>		
			<li>[feature-image wrapper_element='div' wrapper_atts='' height='' width=''] <span class="sdetagils">displays feature image</span></li>		
        </ol>
	</div>
	<?php
}
function home_url_func( $atts = array(), $content = '' ) {
	$atts = shortcode_atts( array(
		'slug' => '',
	), $atts, 'home-url' );

	return home_url( $atts['slug'] );
}
add_shortcode( 'home-url', 'home_url_func' );
function site_identity_func( $atts = array(), $content = null ) {
	global $forclient_options;
	$logo_url = ($forclient_options['logo']['url']) ? $forclient_options['logo']['url'] : get_template_directory_uri(). '/images/logo.png';
	$logo_option = $forclient_options['logo-option'];
	$html = '';
	$atts = shortcode_atts( array(
		'class' => '',
		'container_class' => ''
	), $atts, 'site-identity' ); 
	
	
	$html .= '<div class="logo-wrapper '.$atts['container_class'].'">';
		if($logo_option == 'logo') :
			$html .= '<a class="logo '.$atts['class'].'" href="'.home_url().'">';
			list($width, $height) = getimagesize($logo_url);
			$html .= '<img class="img-responsive img-fluid" src="'.$logo_url.'" alt="'.get_bloginfo('name').' - Logo" width="'.$width.'" height="'.$height.'">';
			$html .= '</a>';
		else :
			$html .= '<div class="text-center '.$atts['class'].'">';
				$html .= '<h1 class="site-title"><a href="'.home_url().'">'.get_bloginfo('name').'</a></h1>';
				$html .= '<p class="site-description">'.get_bloginfo( 'description' ).'</p>';
			$html .= '</div>'; 
		endif;
	$html .= '</div>'; 
		
	return $html;
}
add_shortcode( 'site-identity', 'site_identity_func' );

function site_name_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'link' => 0,
	), $atts, 'site-name' );
	if ($atts['link']) $html .=	'<a href="'.esc_url( home_url( '/' ) ).'">';
	$html .= get_bloginfo('name');
	if ($atts['link']) $html .=	'</a>';
	return $html;
}
add_shortcode( 'site-name', 'site_name_func' );
function copyright_symbol_func() {
	return '&copy;';
}
add_shortcode( 'copyright-symbol', 'copyright_symbol_func' );
function this_year_func() {
	return date('Y');
}
add_shortcode( 'this-year', 'this_year_func' );


function feature_image_func( $atts = array(), $content = '' ) {
	global $mosacademy_options;
	$html = '';
	$img = '';
	$atts = shortcode_atts( array(
		'wrapper_element' => 'div',
		'wrapper_atts' => '',
		'height' => '',
		'width' => '',
	), $atts, 'feature-image' );

	if (has_post_thumbnail()) $img = get_the_post_thumbnail_url();	
	elseif(@$mosacademy_options['blog-archive-default']['id']) $img = wp_get_attachment_url( $mosacademy_options['blog-archive-default']['id'] ); 
	if ($img){
		if ($atts['wrapper_element']) $html .= '<'. $atts['wrapper_element'];
		if ($atts['wrapper_atts']) $html .= ' ' . $atts['wrapper_atts'];
		if ($atts['wrapper_element']) $html .= '>';
		list($width, $height) = getimagesize($img);
		if ($atts['width'] AND $atts['height']) :
			if ($width > $atts['width'] AND $height > $atts['height']) $img_url = aq_resize($img, $atts['width'], $atts['height'], true);
			else $img_url = $img;
		elseif ($atts['width']) :
			if ($width > $atts['width']) $img_url = aq_resize($img, $atts['width']);
			else $img_url = $img;
		else : 
			$img_url = $img;
		endif;
		list($fwidth, $fheight) = getimagesize($img_url);
		$html .= '<img class="img-responsive img-fluid img-featured" src="'.$img_url.'" alt="'.get_the_title().'" width="'.$fwidth.'" height="'.$fheight.'" />';
		if ($atts['wrapper_element']) $html .= '</'. $atts['wrapper_element'] . '>';
	}
	return $html;
}
add_shortcode( 'feature-image', 'feature_image_func' );

function mos_pricing_form_func($atts = array(), $content = '') {
	$atts = shortcode_atts( array(
        'email' => 'template-1',
        'redirect_url' => '',
	), $atts, 'mos-pricing-form' );
    ob_start(); ?>
        <div class="form-container">
            <form action="" method="post">
                <?php wp_nonce_field( 'mos_pricing_form_action', 'mos_pricing_form_field' ); ?>

                <div class="part-1">
                    <div class="input-part">
                        <div class="settings-wrapper">
                            <h3>Calculate your estimate</h3>
                            <div class="form-field">
                                <label for="service">Select a service*</label>
                                <select id="mos-services" name="services[]" class="mos-services base-input" required>
                                   
                                    <option value="" data-price="0.00">Select a Service</option>
                                    <option value="Clipping Path" data-price="0.25">Clipping Path</option>
                                    <option value="Image Background Removal" data-price="0.25">Image Background Removal</option>
                                    <option value="Photo Editing" data-price="1.00">Photo Editing</option>
                                    <option value="Ecommerce Image Editing" data-price="0.25">Ecommerce Image Editing</option>
                                    <option value="Color Correction" data-price="0.50">Color Correction</option>                                    
                                    <option value="Image Manipulation" data-price="1.00">Image Manipulation</option>
                                    <option value="Photo Retouching" data-price="0.50">Photo Retouching</option>
                                    <option value="Ghost Mannequin" data-price="0.75">Ghost Mannequin</option>
                                    <option value="Drop Shadow" data-price="0.15">Drop Shadow</option>
                                    <option value="Image Masking" data-price="0.50">Image Masking</option>
                                                                        
                                </select>
                            </div>
                            <div class="form-field">
                                <label for="quantity">Enter quantity*</label>
                                <input type="number" name="quantity[]" class="quantity base-input" data-validation="required" placeholder="Enter quantity" value="0" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="calculator-part">
                        <div class="default-text">Select a service and a quantity to calculate your estimate.</div>
                        <div class="calculated-text" style="display: none">                            
                            <div class="image"><img class="service-image" data-src="<?php echo get_stylesheet_directory_uri() ?>/images/" alt=""></div>
                            <div class="service"><span class="label">Service</span><span class="value"></span></div>
                            <div class="quantity"><span class="label">Quantity</span><span class="value"></span></div>                            
                            <div class="price"><span class="label">Price</span><span class="value"></span></div>
                            <button type="button" class="btn btn-next-step btn-lg" style="display: none">Complete my quote</button>
                        </div>
                    </div>
                </div>
                <div class="part-2" style="display: none;">
                    <div class="input-part">
                        <div class="row">
                            <div class="col">
                                <div class="input-wrap">
                                    <label for="name">Your name*</label>
                                    <input type="text" name="name" id="name" class="name input-field" required placeholder="Enter Your Name">
                                </div>                                 
                            </div>
                            <div class="col">
                                <div class="input-wrap">
                                    <label for="email">Your email*</label>
                                    <input type="email" name="email" id="email" class="email input-field" required placeholder="Enter Your Email">
                                </div>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="input-wrap">
                                    <label for="shadow">Select the type of shadow you want*</label>
                                    <select name="shadow" id="shadow">
                                        <option value="">Select One</option>
                                        <option>Natural shadow</option>
                                        <option>Reflection shadow</option>
                                        <option>Existing shadow</option>
                                        <option>Drop shadow</option>
                                        <option>Floating shadow</option>
                                    </select>
                                </div>                                 
                            </div>
                            <div class="col">
                                <div class="input-wrap">
                                    <label for="features">Straighten, crop and set margin* (free)</label>
                                    <select name="features" id="features">
                                        <option>No</option>
                                        <option>Yes</option>
                                    </select>
                                </div>                                 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="input-wrap">
                                    <label for="resize">Do you need your images resized?* (free)</label>
                                    <select name="resize" id="resize">
                                        <option>No</option>
                                        <option>Yes</option>
                                    </select>
                                </div>                                 
                            </div>
                            <div class="col">
                                <div class="input-wrap">
                                    <label for="dimention">Dimention</label>
                                    <input type="text" name="dimention" id="dimention" class="dimention input-field" required placeholder="width x height">
                                </div>                                 
                            </div>
                        </div>                        
                        <div class="input-wrap">
                            <label for="comment">Additional comments</label>
                            <textarea class="input-field" placeholder="Please write any specific instruction you might have.." name="comment" id="comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-lg">SUBMIT QUOTE</button>                      
                    </div>
                </div>
            </form>
        </div>
    <?php $html = ob_get_clean();
    return $html;
}
add_shortcode( 'mos-pricing-form', 'mos_pricing_form_func' );