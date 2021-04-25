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
 * Real_Estate elementor service section widget.
 *
 * @since 1.0
 */
class Real_Estate_Services extends Widget_Base {

	public function get_name() {
		return 'real_estate-service';
	}

	public function get_title() {
		return __( 'Services', 'real_estate-companion' );
	}

	public function get_icon() {
		return 'eicon-settings';
	}

	public function get_categories() {
		return [ 'real_estate-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Services content ------------------------------
		$this->start_controls_section(
			'service_content',
			[
				'label' => __( 'Services content', 'real_estate-companion' ),
			]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'real_estate-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'What we Do?', 'real_estate-companion' ),
            ]
        );

        $this->add_control(
            'service_settings_seperator',
            [
                'label' => esc_html__( 'Services', 'real_estate-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

		$this->add_control(
            'services', [
                'label' => __( 'Create New', 'real_estate-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ item_title }}}',
                'fields' => [
                    [
                        'name' => 'item_icon',
                        'label' => __( 'Select Icon', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::SELECT,
                        'default'     => 'icon-1',
                        'options' => real_estate_themify_icon()
                    ],
                    [
                        'name' => 'item_title',
                        'label' => __( 'Title', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default'     => __( 'Marketing & SEO Agency', 'real_estate-companion' ),
                    ],
                    [
                        'name' => 'item_text',
                        'label' => __( 'Text', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default'     => __( 'Esteem spirit temper too say adieus who direct esteem.', 'real_estate-companion' ),
                    ],
                    [
                        'name' => 'btn_text',
                        'label' => __( 'Button Text', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default'     => __( 'Learn More', 'real_estate-companion' ),
                    ],
                    [
                        'name' => 'btn_url',
                        'label' => __( 'Button URL', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::URL,
                        'default'     => [
                            'url' => '#'
                        ],
                    ],
                ],
                'default'   => [
                    [      
                        'item_icon'    => 'icon-1',
                        'item_title'   => __( 'Marketing & SEO Agency', 'real_estate-companion' ),
                        'item_text'    => __( 'Esteem spirit temper too say adieus who direct esteem.', 'real_estate-companion' ),
                        'btn_text'    => __( 'Learn More', 'real_estate-companion' ),
                        'btn_url'    => [
                            'url' => '#'
                        ],
                    ],
                    [      
                        'item_icon'    => 'icon-2',
                        'item_title'   => __( 'Startup Agency', 'real_estate-companion' ),
                        'item_text'    => __( 'Esteem spirit temper too say adieus who direct esteem.', 'real_estate-companion' ),
                        'btn_text'    => __( 'Learn More', 'real_estate-companion' ),
                        'btn_url'    => [
                            'url' => '#'
                        ],
                    ],
                    [      
                        'item_icon'    => 'icon-3',
                        'item_title'   => __( 'Corporate Business', 'real_estate-companion' ),
                        'item_text'    => __( 'Esteem spirit temper too say adieus who direct esteem.', 'real_estate-companion' ),
                        'btn_text'    => __( 'Learn More', 'real_estate-companion' ),
                        'btn_url'    => [
                            'url' => '#'
                        ],
                    ],
                    [      
                        'item_icon'    => 'icon-4',
                        'item_title'   => __( 'Finance Solution', 'real_estate-companion' ),
                        'item_text'    => __( 'Esteem spirit temper too say adieus who direct esteem.', 'real_estate-companion' ),
                        'btn_text'    => __( 'Learn More', 'real_estate-companion' ),
                        'btn_url'    => [
                            'url' => '#'
                        ],
                    ],
                    [      
                        'item_icon'    => 'icon-5',
                        'item_title'   => __( 'Food & Restaurant', 'real_estate-companion' ),
                        'item_text'    => __( 'Esteem spirit temper too say adieus who direct esteem.', 'real_estate-companion' ),
                        'btn_text'    => __( 'Learn More', 'real_estate-companion' ),
                        'btn_url'    => [
                            'url' => '#'
                        ],
                    ],
                    [      
                        'item_icon'    => 'icon-6',
                        'item_title'   => __( 'Travel Agency', 'real_estate-companion' ),
                        'item_text'    => __( 'Esteem spirit temper too say adieus who direct esteem.', 'real_estate-companion' ),
                        'btn_text'    => __( 'Learn More', 'real_estate-companion' ),
                        'btn_url'    => [
                            'url' => '#'
                        ],
                    ],
                ]
            ]
		);
		$this->end_controls_section(); // End service content

    /**
     * Style Tab
     * ------------------------------ Style Section Heading ------------------------------
     *
     */

        $this->start_controls_section(
            'style_room_section', [
                'label' => __( 'Style Service Section', 'real_estate-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'big_title_col', [
                'label' => __( 'Section Title Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expert_doctors_area .doctors_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'single_item_styles_seperator',
            [
                'label' => esc_html__( 'Single Item Styles', 'real_estate-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'member_name_col', [
                'label' => __( 'Member Name Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expert_doctors_area .single_expert .experts_name h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'member_desig_color', [
                'label' => __( 'Member Designation Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expert_doctors_area .single_expert .experts_name span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'single_item_bg_styles_seperator',
            [
                'label' => esc_html__( 'Single Item Bg Styles', 'real_estate-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'member_bg_color', [
                'label' => __( 'Bg Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expert_doctors_area .single_expert .experts_name' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hover_member_bg_color', [
                'label' => __( 'Item Hover Bg Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expert_doctors_area .single_expert:hover .experts_name' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $settings  = $this->get_settings();
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $services = !empty( $settings['services'] ) ? $settings['services'] : '';
    ?>

    <!-- service_area_start -->
    <div class="service_area">
        <div class="container">
            <?php 
                if ( $sec_title ) { 
                    echo '
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="section_title text-center mb-50">
                                <h3>'.esc_html( $sec_title ).'</h3>
                            </div>
                        </div>
                    </div>
                    ';
                }
            ?>
            <div class="row">
                <?php 
                if( is_array( $services ) && count( $services ) > 0 ) {
                    foreach( $services as $item ) {
                        $item_icon = ( !empty( $item['item_icon'] ) ) ? REAL_ESTATE_DIR_ICON_IMG_URI . $item['item_icon'] . '.svg' : '';
                        $item_title = ( !empty( $item['item_title'] ) ) ? $item['item_title'] : '';
                        $item_text = ( !empty( $item['item_text'] ) ) ? $item['item_text'] : '';
                        $btn_text = ( !empty( $item['btn_text'] ) ) ? $item['btn_text'] : '';
                        $btn_url = ( !empty( $item['btn_url']['url'] ) ) ? $item['btn_url']['url'] : '';
                        ?>
                        <div class="col-xl-4 col-md-6 col-lg-4">
                            <div class="single_service text-center">
                                <?php 
                                    if ( $item_icon ) { 
                                        echo '
                                        <div class="service_icon">
                                            <img src="'.esc_url( $item_icon ).'" alt="'.esc_url( $item_title ).'">
                                        </div>
                                        ';
                                    }
                                    if ( $item_title ) { 
                                        echo '<h3>'.esc_html( $item_title ).'</h3>';
                                    }
                                    if ( $item_text ) { 
                                        echo '<p>'.wp_kses_post( $item_text ).'</p>';
                                    }
                                    if ( $btn_text ) { 
                                        echo '<a href="'.esc_url( $btn_url ).'" class="learn_more">'.esc_html( $btn_text ).'</a>';
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    }
}