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
 * Real_Estate elementor Countdown section widget.
 *
 * @since 1.0
 */
class Real_Estate_Countdown extends Widget_Base {

	public function get_name() {
		return 'real_estate-countdown';
	}

	public function get_title() {
		return __( 'Countdown', 'real_estate-companion' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'real_estate-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  Countdown content ------------------------------
        $this->start_controls_section(
            'countdown_content',
            [
                'label' => __( 'Countdown Settings', 'real_estate-companion' ),
            ]
        );
        
        $this->add_control(
            'bg_img',
            [
                'label' => esc_html__( 'Section Bg Image', 'real_estate-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ],
            ]
        );

		$this->add_control(
            'counters', [
                'label' => __( 'Create New', 'real_estate-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ counter_label }}}',
                'fields' => [
                    [
                        'name' => 'counter_icon',
                        'label' => __( 'Counter Value', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::SELECT,
                        'default'     => 'group-icon',
                        'options' => real_estate_themify_icon()
                    ],
                    [
                        'name' => 'counter_val',
                        'label' => __( 'Counter Value', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( '200', 'real_estate-companion' ),
                    ],
                    [
                        'name' => 'counter_suffix',
                        'label' => __( 'Counter Suffix', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( '+', 'real_estate-companion' ),
                    ],
                    [
                        'name' => 'counter_label',
                        'label' => __( 'Counter Label', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Team Members', 'real_estate-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'counter_icon'   => 'group-icon',
                        'counter_val'    => __( '200', 'real_estate-companion' ),
                        'counter_suffix' => __( '+', 'real_estate-companion' ),
                        'counter_label'  => __( 'Team Members', 'real_estate-companion' ),
                    ],
                    [      
                        'counter_icon'   => 'cart-icon',
                        'counter_val'    => __( '97', 'real_estate-companion' ),
                        'counter_suffix' => __( '%', 'real_estate-companion' ),
                        'counter_label'  => __( 'Business Success', 'real_estate-companion' ),
                    ],
                    [      
                        'counter_icon'   => 'heart-icon',
                        'counter_val'    => __( '5628', 'real_estate-companion' ),
                        'counter_suffix' => __( '', 'real_estate-companion' ),
                        'counter_label'  => __( 'Happy Client', 'real_estate-companion' ),
                    ],
                    [      
                        'counter_icon'   => 'respect-icon',
                        'counter_val'    => __( '5637', 'real_estate-companion' ),
                        'counter_suffix' => __( '', 'real_estate-companion' ),
                        'counter_label'  => __( 'Business Done', 'real_estate-companion' ),
                    ],
                ],
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

    // call load widget script
    $this->load_widget_script(); 

    $settings = $this->get_settings();      
    $bg_img = !empty( $settings['bg_img']['url'] ) ? $settings['bg_img']['url'] : '';
    $counters = !empty( $settings['counters'] ) ? $settings['counters'] : '';
    ?>

    <!-- counter_area  -->
    <div class="counter_area overlay_03" <?php echo real_estate_inline_bg_img( esc_url( $bg_img ) )?>>
        <div class="container">
            <div class="row">
                <?php 
                if( is_array( $counters ) && count( $counters ) > 0 ) {
                    foreach( $counters as $item ) {
                        $counter_icon = ( !empty( $item['counter_icon'] ) ) ? REAL_ESTATE_DIR_ICON_IMG_URI . $item['counter_icon'] . '.svg' : '';
                        $counter_val = ( !empty( $item['counter_val'] ) ) ? $item['counter_val'] : '';
                        $counter_suffix = ( !empty( $item['counter_suffix'] ) ) ? '<span>'.$item['counter_suffix'].'</span>' : '';
                        $counter_label = ( !empty( $item['counter_label'] ) ) ? $item['counter_label'] : '';
                        ?>
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="single_counter text-center">
                                <?php 
                                    if ( $counter_icon ) { 
                                        echo '
                                            <div class="counter_icon">
                                                <img src="'.esc_url( $counter_icon ).'" alt="'.esc_attr( $counter_label ).'">
                                            </div>
                                        ';
                                    }
                                    if ( $counter_val ) { 
                                        echo '
                                            <h3> <span class="counter">'.esc_html( $counter_val ).'</span> '.wp_kses_post($counter_suffix).' </h3>
                                        ';
                                    }
                                    if ( $counter_label ) { 
                                        echo '
                                            <p>'.esc_html( $counter_label ).'</p>
                                        ';
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
    
    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // counter 
            $('.counter').counterUp({
              delay: 10,
              time: 10000
            });
        })(jQuery);
        </script>
        <?php 
        }
    }	
}