<?php
namespace Real_Estateelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Real_Estate elementor hero section widget.
 *
 * @since 1.0
 */
class Real_Estate_Hero extends Widget_Base {

	public function get_name() {
		return 'real_estate-hero';
	}

	public function get_title() {
		return __( 'Hero Section', 'real_estate-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'real_estate-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Hero content ------------------------------
		$this->start_controls_section(
			'hero_content',
			[
				'label' => __( 'Hero section content', 'real_estate-companion' ),
			]
        );
        $this->add_control(
            'bg_img',
            [
                'label' => esc_html__( 'BG Image', 'real_estate-companion' ),
                'description' => esc_html__( 'Best size is 1920x900', 'real_estate-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'big_text',
            [
                'label' => esc_html__( 'Big Title', 'real_estate-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Find your best Property', 'real_estate-companion' ),
            ]
        );
        $this->add_control(
            'sub_text',
            [
                'label' => esc_html__( 'Sub Title', 'real_estate-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => esc_html__( 'Esteem spirit temper too say adieus who direct esteem.', 'real_estate-companion' ),
            ]
        );

        $this->end_controls_section(); // End Hero content


    /**
     * Style Tab
     * ------------------------------ Style Title ------------------------------
     *
     */
        $this->start_controls_section(
			'style_title', [
				'label' => __( 'Style Hero Section', 'real_estate-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'big_title_col', [
				'label' => __( 'Title Color', 'real_estate-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_col', [
				'label' => __( 'Text Color', 'real_estate-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text p' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_control(
            'button_section_separator',
            [
                'label'     => __( 'Button Styles', 'real_estate-companion' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        ); 
        $this->add_control(
			'button_col', [
				'label' => __( 'Button Color', 'real_estate-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3' => 'color: {{VALUE}} !important',
				],
			]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg_color',
                'label' => __( 'Button BG Color', 'real_estate-companion' ),
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3',
            ]
        );

        $this->add_control(
            'button_hover_section_separator',
            [
                'label'     => __( 'Button Hover Styles', 'real_estate-companion' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        ); 
        $this->add_control(
			'button_hover_col', [
				'label' => __( 'Button Hover Color', 'real_estate-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3:hover' => 'color: {{VALUE}} !important; border-color: {{VALUE}};',
				],
			]
        );
        $this->add_control(
			'button_hover_bg_col', [
				'label' => __( 'Button Hover Bg Color', 'real_estate-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3:hover' => 'background: {{VALUE}};',
				],
			]
        );

		$this->end_controls_section();
	}
    
	protected function render() {
    // call load widget script
    $this->load_widget_script(); 

    $settings = $this->get_settings();
    $bg_img   = !empty( $settings['bg_img']['url'] ) ? $settings['bg_img']['url'] : '';
    $big_text = !empty( $settings['big_text'] ) ? $settings['big_text'] : '';
    $sub_text = !empty( $settings['sub_text'] ) ? $settings['sub_text'] : '';
    ?>

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider d-flex align-items-center slider_bg_1" <?php echo real_estate_inline_bg_img( esc_url( $bg_img ) ); ?>>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="slider_text text-center justify-content-center">
                            <?php 
                                if ( $big_text ) { 
                                    echo '<h3>'.wp_kses_post( nl2br( $big_text ) ).'</h3>';
                                }
                                if ( $sub_text ) { 
                                    echo '<p>'.wp_kses_post( nl2br( $sub_text ) ).'</p>';
                                }
                            ?>
                        </div>
                        <div class="property_form">
                            <form action="<?php echo home_url( 'search-property' )?>" class="search-properties-form-home">
                                <?php wp_nonce_field( 'search_prop_data_nonce' );?>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form_wrap d-flex">
                                            <div class="single-field max_width prop-loc">
                                                <label for="#">Location</label>
                                                <select class="wide">
                                                    <option data-display="NewYork">NewYork</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="India">India</option>
                                                </select>
                                            </div>
                                            <div class="single-field max_width prop-type">
                                                <label for="#">Property type</label>
                                                <select class="wide" >
                                                    <option data-display="Apartment">Apartment</option>
                                                    <option value="1">Flat</option>
                                                    <option value="2">Building</option>
                                                </select>
                                            </div>
                                            <div class="single_field range_slider">
                                                <label for="#">Price ($)</label>
                                                <div id="slider">
                                                    <span class="prices-area" style="display:none">
                                                        <span class="min-price">67</span>
                                                        <span class="max-price">160</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="single-field min_width bed-room">
                                                <label for="#">Bed Room</label>
                                                <select class="wide" >
                                                    <option data-display="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="single-field min_width bath-room">
                                                <label for="#">Bath Room</label>
                                                <select class="wide" >
                                                    <option data-display="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="serach_icon">
                                                <!-- <a href="javascript:void(0)">
                                                    <i class="ti-search"></i>
                                                </a> -->
                                                <button type="submit"><i class="ti-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->
    <?php

    } 
    
    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // slider_active
            $('.slider_active').owlCarousel({
                loop:true,
                margin:0,
            items:1,
            autoplay:true,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
                nav:true,
            dots:false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
                responsive:{
                    0:{
                        items:1,
                        nav:false,
                    },
                    767:{
                        items:1,
                        nav:false,
                    },
                    992:{
                        items:1,
                        nav:false
                    },
                    1200:{
                        items:1,
                        nav:false
                    },
                    1600:{
                        items:1,
                        nav:true
                    }
                }
            });
        })(jQuery);
        </script>
        <?php 
        }
    }	
}