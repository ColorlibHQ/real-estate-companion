<?php
namespace Real_Estateelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Real_Estate elementor search-properties section widget.
 *
 * @since 1.0
 */
class Real_Estate_Search_Properties extends Widget_Base {

	public function get_name() {
		return 'real-estate-search-properties';
	}

	public function get_title() {
		return __( 'Search Properties', 'real-estate-companion' );
	}

	public function get_icon() {
		return 'eicon-settings';
	}

	public function get_categories() {
		return [ 'real_estate-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  property content ------------------------------
		$this->start_controls_section(
			'property_content',
			[
				'label' => __( 'Search Settings', 'real-estate-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label'         => __( 'Section Title', 'real-estate-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( 'Please search by your arguments.', 'real-estate-companion' )
            ]
        );

		$this->end_controls_section(); // End property content

    /**
     * Style Tab
     * ------------------------------ Style Section Heading ------------------------------
     *
     */

        $this->start_controls_section(
            'style_room_section', [
                'label' => __( 'Style Service Section', 'real-estate-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style_type' => 'style_1'
                ],
            ]
        );
        $this->add_control(
            'sub_title_col', [
                'label' => __( 'Sub Title Color', 'real-estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lastest_project .section_title .sub_heading' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sec_title_col', [
                'label' => __( 'Section Title Color', 'real-estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lastest_project .section_title h3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .lastest_project .section_title .seperator' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'singl_item_styles_seperator',
            [
                'label' => esc_html__( 'Single Project Styles', 'real-estate-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'proj_loc_col', [
                'label' => __( 'Project Location Color', 'real-estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lastest_project .section_title .sub_heading2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'proj_title_col', [
                'label' => __( 'Project Title Color', 'real-estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lastest_project .section_title h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'proj_txt_col', [
                'label' => __( 'Project Text Color', 'real-estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lastest_project .section_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'singl_item_btn_styles_seperator',
            [
                'label' => esc_html__( 'Button Styles', 'real-estate-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'btn_line_txt_col', [
                'label' => __( 'Button Border & Text Color', 'real-estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lastest_project .section_title .boxed-btn' => 'color: {{VALUE}} !important; border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hvr_bg_col', [
                'label' => __( 'Button Hover Bg & Border Color', 'real-estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lastest_project .section_title .boxed-btn:hover' => 'background: {{VALUE}}; border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hvr_txt_col', [
                'label' => __( 'Button Hover Text Color', 'real-estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lastest_project .section_title .boxed-btn:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

		//------------------------------ Services Item Style ------------------------------
		$this->start_controls_section(
			'style_serv_items_sec', [
				'label' => __( 'Style Single Item', 'real-estate-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style_type' => 'style_2'
                ],
			]
		);
		$this->add_control(
			'big_titles_color', [
				'label' => __( 'Big Titles Color', 'real-estate-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .project_details .project_details_left .single_details h3, .project_details .projects_details_info .details_info h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'texts_color', [
				'label' => __( 'Text Color', 'real-estate-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .project_details .project_details_left .single_details p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

    }
    

	protected function render() {
    $settings   = $this->get_settings();
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    ?>

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider single_slider2  d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="property_wrap">
                            <div class="property_form">
                                <form action="" class="search-properties-form">
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
                                                    <a href="javascript:void(0)">
                                                        <i class="ti-search"></i>
                                                    </a>
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
    </div>
    <!-- slider_area_end -->

    <!-- slider_area_end -->
    <div class="popular_property">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-40 text-center">
                        <?php 
                            if ( $sec_title ) { 
                                echo '<h4>'.esc_html( $sec_title ).'</h4>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row our-contents"></div>
        </div>
    </div>
    <?php
    }  
}