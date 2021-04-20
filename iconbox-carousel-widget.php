<?php
namespace Elementor;

class Mos_Iconbox_Carousel_Widget extends Widget_Base {
	
	public function get_name() {
		return 'mos-iconbox-carousel-widget';
	}
	
	public function get_title() {
		return 'Mos Iconbox Carousel';
	}
	
	public function get_icon() {
		return 'fa fa-image';
	}
	
	public function get_categories() {
		return [ 'basic' ];
	}
	
	protected function _register_controls() {
        // Start General Input Controls
		$this->start_controls_section(
			'_content_input_tab',
			[
				'label' => __( 'Mos Iconbox Carousel', 'elementor' ),
			]
		);
		
            $this->add_control(
                '_mos_iconbox_content',
                [
                    'label' => __( 'Content', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::TEXTAREA,
                    'placeholder' => __( 'Enter your Content', 'elementor' ),
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'list_icon',
                [
                    'label' => __( 'Icon', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::ICON,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
                    ],
                ]
            );

            $repeater->add_control(
                'list_title', [
                    'label' => __( 'Title', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'List Title' , 'plugin-domain' ),
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'list_content', [
                    'label' => __( 'Content', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => __( 'List Content' , 'plugin-domain' ),
                    'show_label' => false,
                ]
            );

            $this->add_control(
                'list',
                [
                    'label' => __( 'Iconbox List', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    /*'default' => [
                        [
                            'list_title' => __( 'Title #1', 'plugin-domain' ),
                            'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
                        ],
                    ],*/
                    'title_field' => '{{{ list_title }}}',
                ]
            );

		$this->end_controls_section();
        // End General Input Controls
        
        
        // Srart General Style Controls
        $this->start_controls_section(
			'_general_style_section',
			[
				'label' => __( 'General', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_control(
                '_general_bg_style_tab',
                [
                    'label' => __( 'Background Color', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::COLOR,				
                ]
            );
            $this->add_control(
                '_general_text_style_tab',
                [
                    'label' => __( 'Text Color', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::COLOR,				
                ]
            );
            $this->add_control(
                '_general_shadow_style_tab',
                [
                    'label' => __( 'Box Shadow', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::BOX_SHADOW,				
                ]
            );
		$this->end_controls_section();
        //End General Style Controls
        
        //Start Tab Tile Controls
        $this->start_controls_section(
			'_tab_title_style_section',
			[
				'label' => __( 'Tab Title', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_control(
                '_tab_title_color',
                [
                    'label' => __( 'Text Color', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::COLOR,				
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => '_tab_title_typography',
                    'label' => __( 'Typography', 'plugin-domain' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .text',
                ]
            );            
            $this->add_control(
                '_tab_title_margin',
                [
                    'label' => __( 'Margin', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} > .elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();         
        //End Tab Tile Controls
        
        //Start Icon Controls
        $this->start_controls_section(
			'_icon_style_section',
			[
				'label' => __( 'Icon', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_control(
                '_icon_color',
                [
                    'label' => __( 'Icon Color', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::COLOR,				
                ]
            );		
		$this->end_controls_section();         
        //End Icon Controls
        
        //Start Content Controls
        $this->start_controls_section(
			'_content_style_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
            $this->add_control(
                '_content_color',
                [
                    'label' => __( 'Text Color', 'elementor' ),
                    'label_block' => true,
                    'type' => Controls_Manager::COLOR,				
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => '_content_typography',
                    'label' => __( 'Typography', 'plugin-domain' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .text',
                ]
            );		
		$this->end_controls_section();         
        //End Content Controls
        
        
	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();
//        var_dump($settings);
//        die();
        $element_id = gettimeofday()['sec'] . rand(1000,9999);
        echo '<div data-id="'.$element_id.'" id="carousel-container-'.$element_id.'" class="mos-iconbox-carousel-container">';
        
        if ( $settings['list'] ) {
			echo '<div class="carousel-container"><div class="mos-iconbox-owl-carousel owl-carousel owl-theme">';
			foreach (  $settings['list'] as $item ) {
                echo '<div class="item item-' . $item['_id'] . '">
                         <div class="wrapper">
                            <i class="' . $item['list_icon'] . '"></i>
                            <h5 class="item-title">' . $item['list_title'] . '</h5><!-- /.item-title -->
                            <div class="item-desc">' . $item['list_content'] . '</div><!-- /.item-desc -->
                         </div><!-- /.wrapper -->
                      </div><!-- /.item -->';
			}
			echo '</div><!-- /.owl-carousel --></div><!-- /.carousel-container -->';
		}
        
        //Text Container
        echo '<div class="text-container"><div class="wrap">'.$settings['_mos_iconbox_content'].'<div class="carousel-controller"></div><!-- /.carousel-controller --></div><!-- /.wrap --></div><!-- /.text-container --> ';        
        
        echo '</div> <!-- /.mos-element-wrapper -->';
        
        // Style
        echo '<style>';
        echo '#carousel-container-'.$element_id.' .carousel-container .item .wrapper i {color: '.$settings['_icon_color'].'}';
        echo '#carousel-container-'.$element_id.' .carousel-container .item .wrapper .item-title {';
            if ($settings['_tab_title_color'])
                echo 'color: '.$settings['_tab_title_color'].';';
            echo set_element_typography($settings,'_tab_title_typography');
            if ($settings['_tab_title_margin'])
                echo set_element_dimensions($settings,'_tab_title_margin','margin');
        
        echo '}';
        echo '#carousel-container-'.$element_id.' .carousel-container .item .wrapper .item-desc {';
            if ($settings['_content_color'])
                echo 'color: '.$settings['_content_color'].';';
            echo set_element_typography($settings,'_content_typography');
        
        echo '}';
        echo '#carousel-container-'.$element_id.' .text-container{';        
            echo 'color: '.$settings['_general_text_style_tab'].';';
            echo 'background-color: '.$settings['_general_bg_style_tab'].';';
        echo '}';
        echo '#carousel-container-'.$element_id.' .carousel-container .item .wrapper{';
            echo set_element_shadow($settings,'_general_shadow_style_tab');
        echo '}';
        
        echo '</style>';
		 

	}
	
    protected function _content_template() {
		?>
		<div class="mos-iconbox-carousel-container">
		<# if ( settings.list.length ) { #>
		<dl>
			<# _.each( settings.list, function( item ) { #>
				<dt class="elementor-repeater-item-x-{{ item._id }}">{{{ item.list_title }}}</dt>
				<dd>{{{ item.list_content }}}</dd>
			<# }); #>
        </dl>
		<# } #>
        <div class="text-container" style="background-color:{{settings._general_bg_style_tab}};color:{{settings._general_text_style_tab}}"><div class="wrap">{{{settings._mos_iconbox_content}}}</div></div>
        </div>
		<?php
	}
	
	
}