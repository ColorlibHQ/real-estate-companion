<?php
namespace Real_Estateelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Real_Estate elementor about section widget.
 *
 * @since 1.0
 */
class Real_Estate_About_Section extends Widget_Base {

	public function get_name() {
		return 'real_estate-about-us';
	}

	public function get_title() {
		return __( 'About Section', 'real_estate-companion' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'real_estate-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  About Us content ------------------------------
        $this->start_controls_section(
            'about_content',
            [
                'label' => __( 'About Us Settings', 'real_estate-companion' ),
            ]
        );

        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'real_estate-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Why our Consulting?', 'real_estate-companion' ),
            ]
        );
        $this->add_control(
            'sec_text',
            [
                'label' => esc_html__( 'Section Text', 'real_estate-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => __( 'Esteem spirit temper too say adieus who direct esteem. It esteems luckily or picture placing drawing. Apartments frequently or motionless on reasonable.', 'real_estate-companion' ),
            ]
        );
        $this->add_control(
            'btn_label',
            [
                'label' => esc_html__( 'Button Text', 'real_estate-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => __( 'About Us', 'real_estate-companion' ),
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label' => esc_html__( 'Button URL', 'real_estate-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default'   => [
                    'url' => '#'
                ],
            ]
        );
        $this->add_control(
            'sec_img',
            [
                'label' => esc_html__( 'Section Image', 'real_estate-companion' ),
                'description' => esc_html__( 'Best size is 558x400', 'real_estate-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->end_controls_section(); // End left content

        //------------------------------ Style title ------------------------------
        
        // Top Section Styles
        $this->start_controls_section(
            'about_sec_style', [
                'label' => __( 'About Section Styles', 'real_estate-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_col', [
                'label' => __( 'Sub Title Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_real_estate_area .welcome_real_estate_info h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sec_title_col', [
                'label' => __( 'Sec Title Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_real_estate_area .welcome_real_estate_info h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sec_text_col', [
                'label' => __( 'Sec Text Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_real_estate_area .welcome_real_estate_info p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .welcome_real_estate_area .welcome_real_estate_info ul li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'list_circle_col', [
                'label' => __( 'List Item Icon Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_real_estate_area .welcome_real_estate_info ul li::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_styles_seperator',
            [
                'label' => esc_html__( 'Button Styles', 'real_estate-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'btn_txt_col', [
                'label' => __( 'Button Text & Border Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_real_estate_area .welcome_real_estate_info .boxed-btn3-white-2' => 'color: {{VALUE}} !important; border-color: {{VALUE}}',
                    '{{WRAPPER}} .welcome_real_estate_area .welcome_real_estate_info .boxed-btn3-white-2:hover' => 'background: {{VALUE}} !important; border-color: transparent',
                ],
            ]
        );
        $this->add_control(
            'btn_hvr_col', [
                'label' => __( 'Button Hover Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_real_estate_area .welcome_real_estate_info .boxed-btn3-white-2:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
    $settings   = $this->get_settings();  
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sec_img    = !empty( $settings['sec_img']['id'] ) ? wp_get_attachment_image( $settings['sec_img']['id'], 'real_estate_about_thumb_558x400', '', array( 'alt' => $sec_title ) ) : '';
    $sec_text   = !empty( $settings['sec_text'] ) ? $settings['sec_text'] : '';
    $btn_label  = !empty( $settings['btn_label'] ) ? $settings['btn_label'] : '';
    $btn_url    = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    ?>
    
    <!-- about_info_area start  -->
    <div class="about_info_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="about_text">
                        <?php 
                            if ( $sec_title ) { 
                                echo '<h3>'.esc_html($sec_title).'</h3>';
                            }
                            if ( $sec_text ) { 
                                echo '<p>'.wp_kses_post( $sec_text ).'</p>';
                            }
                            if ( $btn_label ) { 
                                echo '<a class="boxed-btn3" href="'.esc_url( $btn_url ).'">'.esc_html( $btn_label ).'</a>';
                            }
                        ?>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <?php 
                        if ( $sec_img ) { 
                            echo '
                                <div class="about_thumb">
                                    '.$sec_img.'
                                </div>
                            ';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /about_info_area end  -->
    <?php
    }
}