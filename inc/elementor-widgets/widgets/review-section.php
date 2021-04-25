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
 * Real_Estate Review Contents section widget.
 *
 * @since 1.0
 */
class Real_Estate_Review_Contents extends Widget_Base {

	public function get_name() {
		return 'real_estate-review-contents';
	}

	public function get_title() {
		return __( 'Review Contents', 'real_estate-companion' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	public function get_categories() {
		return [ 'real_estate-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Review contents  ------------------------------
		$this->start_controls_section(
			'reviews_content',
			[
				'label' => __( 'Review Contents', 'real_estate-companion' ),
			]
        );

        $this->add_control(
            'sec_bg',
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
            'reviews', [
                'label' => __( 'Create New', 'real_estate-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ reviewer_name }}}',
                'fields' => [
                    [
                        'name' => 'review_txt',
                        'label' => __( 'Review Text', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.  <br> Fusce ac mattis nulla. Morbi eget ornare dui.'
                    ],
                    [
                        'name' => 'client_img',
                        'label' => __( 'Client Image', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                    ],
                    [
                        'name' => 'reviewer_name',
                        'label' => __( 'Client Name', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Robert Thomson', 'real_estate-companion' ),
                    ],
                    [
                        'name' => 'reviewer_designation',
                        'label' => __( 'Client Designation', 'real_estate-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Business Owner', 'real_estate-companion' ),
                    ],
                ],
                'default'   => [
                    [
                        'review_txt'            => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.  <br> Fusce ac mattis nulla. Morbi eget ornare dui.',
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'reviewer_name'         => __( 'Robert Thomson', 'real_estate-companion' ),
                        'reviewer_designation'  => __( 'Business Owner', 'real_estate-companion' ),
                    ],
                    [
                        'review_txt'            => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.  <br> Fusce ac mattis nulla. Morbi eget ornare dui.',
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'reviewer_name'         => __( 'Jonathan Doe', 'real_estate-companion' ),
                        'reviewer_designation'  => __( 'Business Owner', 'real_estate-companion' ),
                    ],
                    [
                        'review_txt'            => 'Donec imperdiet congue orci consequat mattis. Donec rutrum porttitor <br> sollicitudin. Pellentesque id dolor tempor sapien feugiat ultrices nec sed neque.  <br> Fusce ac mattis nulla. Morbi eget ornare dui.',
                        'client_img'         => [
                            'url' => Utils::get_placeholder_image_src()
                        ],
                        'reviewer_name'         => __( 'John Doe', 'real_estate-companion' ),
                        'reviewer_designation'  => __( 'Business Owner', 'real_estate-companion' ),
                    ],
                ]
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
                'label' => __( 'Style Review Section', 'real_estate-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_overlay_col', [
                'label' => __( 'Section Overlay Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-testmonial.overlay2::before' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rev_text_col', [
                'label' => __( 'Review Text Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testmonial_area .testmonial_info p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'rev_name_col', [
                'label' => __( 'Reviewer Name Color', 'real_estate-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testmonial_area .testmonial_info h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {

    // call load widget script
    $this->load_widget_script(); 
    $settings       = $this->get_settings();
    $sec_bg         = !empty( $settings['sec_bg']['url'] ) ? $settings['sec_bg']['url'] : '';
    $reviews        = !empty( $settings['reviews'] ) ? $settings['reviews'] : '';
    ?>

    <div class="testimonial_area overlay" <?php echo real_estate_inline_bg_img( esc_url( $sec_bg ) ); ?>>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="testmonial_active owl-carousel">
                        <?php
                        if( is_array( $reviews ) && count( $reviews ) > 0 ){
                            foreach ( $reviews as $review ) {
                                $review_txt    = !empty( $review['review_txt'] ) ? $review['review_txt'] : '';
                                $reviewer_name = !empty( $review['reviewer_name'] ) ? $review['reviewer_name'] : '';
                                $reviewer_designation = !empty( $review['reviewer_designation'] ) ? $review['reviewer_designation'] : '';
                                $client_img = !empty( $review['client_img']['id'] ) ? wp_get_attachment_image( $review['client_img']['id'], 'real_estate_np_thumb', '', array( 'alt' => $reviewer_name. ' image' ) ) : '';
                                $quote_icon = REAL_ESTATE_DIR_ICON_IMG_URI . 'quote-icon.svg';
                                ?>
                                <div class="single_carousel">
                                    <div class="single_testmonial text-center">
                                        <?php 
                                            if ( $client_img ) { 
                                                echo '
                                                <div class="quote">
                                                    <img src="'.esc_url($quote_icon).'" alt="quote icon">
                                                </div>
                                                ';
                                            }
                                            if ( $review_txt ) { 
                                                echo '<p>'.wp_kses_post( nl2br( $review_txt ) ).'</p>';
                                            }
                                            echo '<div class="testmonial_author">';
                                                if ( $client_img ) { 
                                                    echo '
                                                    <div class="thumb">
                                                        '.$client_img.'
                                                    </div>
                                                    ';
                                                }
                                                if ( $reviewer_name ) { 
                                                    echo '<h3>'.esc_html( $reviewer_name ).'</h3>';
                                                }
                                                if ( $reviewer_designation ) { 
                                                    echo '<span>'.esc_html( $reviewer_designation ).'</span>';
                                                }
                                            echo '</div>';
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
        </div>
    </div>
    <!-- testmonial_area_end  -->
    <?php

    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // review-active
            $('.testmonial_active').owlCarousel({
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
                    dots:false,
                    nav:false,
                },
                767:{
                    items:1,
                    dots:false,
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
                1500:{
                    items:1
                }
            }
            });
        })(jQuery);
        </script>
        <?php 
        }
    }	
}
