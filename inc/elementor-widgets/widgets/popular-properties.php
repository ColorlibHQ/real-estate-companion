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
 * Real_Estate elementor property section widget.
 *
 * @since 1.0
 */
class Real_Estate_Properties extends Widget_Base {

	public function get_name() {
		return 'real-estate-property';
	}

	public function get_title() {
		return __( 'Property Section', 'real-estate-companion' );
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
				'label' => __( 'Property Settings', 'real-estate-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label'         => __( 'Section Title', 'real-estate-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( 'Popular Properties', 'real-estate-companion' )
            ]
        );
		$this->add_control(
			'post_order',
			[
				'label'         => esc_html__( 'Case Order', 'real-estate-companion' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block'   => false,
				'label_on'      => 'DESC',
				'label_off'     => 'ASC',
                'default'       => 'yes',
			]
		);
        $this->add_control(
            'btn_label',
            [
                'label'         => __( 'Button Label', 'real-estate-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( 'More Properties', 'real-estate-companion' )
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label'         => __( 'Button URL', 'real-estate-companion' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'default'       => [
                    'url'       => '#'
                ]
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
    $post_order = $settings['post_order'] == 'yes' ? 'DESC' : 'ASC';
    $btn_label  = !empty( $settings['btn_label'] ) ? $settings['btn_label'] : '';
    $btn_url    = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    ?>

    <!-- popular_property  -->
    <div class="popular_property">
        <div class="container">
            <?php
            if ( $sec_title ) {
                echo '
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section_title mb-40 text-center">
                            <h3>'.esc_html( $sec_title ).'</h3>
                        </div>
                    </div>
                </div>
                ';
            }
            ?>

            <div class="row">
                <?php 
                    if( function_exists( 'real_estate_properties_section' ) ) {
                        real_estate_properties_section( $post_order );
                    }
                ?>
            </div>

            <?php
            if ( $btn_label ) {
                echo '
                <div class="row">
                    <div class="col-xl-12">
                        <div class="more_property_btn text-center">
                            <a href="'.esc_url( $btn_url ).'" class="boxed-btn3-line">'.esc_html( $btn_label ).'</a>
                        </div>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
    </div>
    <!-- popular_property_end  -->
    <?php
    }  
}