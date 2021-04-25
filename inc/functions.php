<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * @Packge     : Real_Estate Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author     URI : http://colorlib.com/wp/
 *
 */


/*===========================================================
	Get elementor templates
============================================================*/
function get_elementor_templates() {
	$options = [];
	$args = [
		'post_type' => 'elementor_library',
		'posts_per_page' => -1,
	];

	$page_templates = get_posts($args);

	if (!empty($page_templates) && !is_wp_error($page_templates)) {
		foreach ($page_templates as $post) {
			$options[$post->ID] = $post->post_title;
		}
	}
	return $options;
}

// Section Heading
function real_estate_section_heading( $title = '', $subtitle = '' ) {
	if( $title || $subtitle ) :
	?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-heading text-center">
						<?php
						// Sub title
						if ( $subtitle ) {
							echo '<p>' . esc_html( $subtitle ) . '</p>';
						}
						// Title
						if ( $title ) {
							echo '<h2>' . esc_html( $title ) . '</h2>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	endif;
}

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'real_estate_companion_frontend_scripts', 99 );
function real_estate_companion_frontend_scripts() {

	wp_enqueue_script( 'real_estate-companion-script', plugins_url( '../js/loadmore-ajax.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'real_estate-common-js', plugins_url( '../js/common.js', __FILE__ ), array( 'jquery' ), '1.0', true );

}
// 
add_action( 'wp_ajax_real_estate_portfolio_ajax', 'real_estate_portfolio_ajax' );

add_action( 'wp_ajax_nopriv_real_estate_portfolio_ajax', 'real_estate_portfolio_ajax' );
function real_estate_portfolio_ajax( ){

	ob_start();

	if( !empty( $_POST['elsettings'] ) ):


		$items = array_slice( $_POST['elsettings'], $_POST['postNumber'] );

	    $i = 0;
	    foreach( $items as $val ):

	    $tagclass = sanitize_title_with_dashes( $val['label'] );
	    $i++;
	?>
	<div class="single_gallery_item <?php echo esc_attr( $tagclass ); ?>">
	    <?php 
	    if( !empty( $val['img']['url'] ) ){
	        echo '<img src="'.esc_url( $val['img']['url'] ).'" />';
	    }
	    ?>
	    <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
	        <div class="port-hover-text text-center">
	            <?php 
	            if( !empty( $val['title'] ) ){
	                echo real_estate_heading_tag(
	                    array(
	                        'tag'  => 'h4',
	                        'text' => esc_html( $val['title'] )
	                    )
	                );
	            }

	            if( !empty( $val['sub-title-url'] ) &&  !empty( $val['sub-title'] ) ){
	                echo '<a href="'.esc_url( $val['sub-title-url'] ).'">'.esc_html( $val['sub-title'] ).'</a>';
	            }else{
	                echo '<p>'.esc_html( $val['sub-title'] ).'</p>';
	            }
	            ?>
	            
	        </div>
	    </div>
	</div>

	<?php 

	if( !empty( $_POST['postIncrNumber'] ) ){

	    if( $i == $_POST['postIncrNumber'] ){
	        break;
	    }
	}
	    endforeach;
	endif;
	echo ob_get_clean();
	die();
}

	// Update the post/page by your arguments
	function real_estate_update_the_followed_post_page_status( $title = 'Hello world!', $type = 'post', $status = 'draft', $message = false ){

		// Get the post/page by title
		$target_post_id = get_page_by_title( $title, OBJECT, $type);

		// Post/page arguments
		$target_post = array(
			'ID'    => $target_post_id->ID,
			'post_status'   => $type,
		);

		if ( $message == true ) {
			// Update the post/page
			$update_status = wp_update_post( $target_post, true );
		} else {
			// Update the post/page
			$update_status = wp_update_post( $target_post, false );
		}

		return $update_status;
	}


	
// Property - Custom Post Type
function real_estate_custom_posts() {	
	$labels = array(
		'name'               => _x( 'Properties', 'post type general name', 'real-estate-companion' ),
		'singular_name'      => _x( 'Property', 'post type singular name', 'real-estate-companion' ),
		'menu_name'          => _x( 'Properties', 'admin menu', 'real-estate-companion' ),
		'name_admin_bar'     => _x( 'Property', 'add new on admin bar', 'real-estate-companion' ),
		'add_new'            => _x( 'Add New', 'property', 'real-estate-companion' ),
		'add_new_item'       => __( 'Add New Property', 'real-estate-companion' ),
		'new_item'           => __( 'New Property', 'real-estate-companion' ),
		'edit_item'          => __( 'Edit Property', 'real-estate-companion' ),
		'view_item'          => __( 'View Property', 'real-estate-companion' ),
		'all_items'          => __( 'All Properties', 'real-estate-companion' ),
		'search_items'       => __( 'Search Properties', 'real-estate-companion' ),
		'parent_item_colon'  => __( 'Parent Property:', 'real-estate-companion' ),
		'not_found'          => __( 'No properties found.', 'real-estate-companion' ),
		'not_found_in_trash' => __( 'No properties found in Trash.', 'real-estate-companion' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'real-estate-companion' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'property' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'property', $args );

	// property-type - Custom taxonomy
	$labels = array(
		'name'              => _x( 'Property Type', 'taxonomy general name', 'real-estate-companion' ),
		'singular_name'     => _x( 'Property Types', 'taxonomy singular name', 'real-estate-companion' ),
		'search_items'      => __( 'Search Property Types', 'real-estate-companion' ),
		'all_items'         => __( 'All Property Types', 'real-estate-companion' ),
		'parent_item'       => __( 'Parent Property Type', 'real-estate-companion' ),
		'parent_item_colon' => __( 'Parent Property Type:', 'real-estate-companion' ),
		'edit_item'         => __( 'Edit Property Type', 'real-estate-companion' ),
		'update_item'       => __( 'Update Property Type', 'real-estate-companion' ),
		'add_new_item'      => __( 'Add New Property Type', 'real-estate-companion' ),
		'new_item_name'     => __( 'New Property Type Name', 'real-estate-companion' ),
		'menu_name'         => __( 'Property Type', 'real-estate-companion' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'property-type' ),
	);

	register_taxonomy( 'property-type', array( 'property' ), $args );

}
add_action( 'init', 'real_estate_custom_posts' );



/*=========================================================
    Properties Section
========================================================*/
function real_estate_properties_section( $post_order ){ 
	$properties = new WP_Query( array(
		'post_type' => 'property',
		'order' => $post_order,

	) );
	
	if( $properties->have_posts() ) {
		while ( $properties->have_posts() ) {
			$properties->the_post();			
			$property_cat = get_the_terms(get_the_ID(), 'property-type');
			$property_img = get_the_post_thumbnail( get_the_ID(), 'real_estate_property_thumb_362x240', '', array( 'alt' => get_the_title() ) );
			$prop_address = ! empty( real_estate_meta( 'prop_address') ) ? real_estate_meta( 'prop_address') : '';
			$prop_price   = ! empty( real_estate_meta( 'prop_price') ) ? real_estate_meta( 'prop_price') : '';
			$sell_con     = ! empty( real_estate_meta( 'sell_con') ) ? real_estate_meta( 'sell_con') : '';
			$phone_number = ! empty( real_estate_meta( 'phone_number') ) ? real_estate_meta( 'phone_number') : '';
			$prop_area    = ! empty( real_estate_meta( 'prop_area') ) ? real_estate_meta( 'prop_area') : 'N/A';
			$prop_bed     = ! empty( real_estate_meta( 'prop_bed') ) ? real_estate_meta( 'prop_bed') : 'N/A';
			$prop_bath    = ! empty( real_estate_meta( 'prop_bath') ) ? real_estate_meta( 'prop_bath') : 'N/A';
			$prop_status  = ! empty( real_estate_meta( 'prop_status') ) ? real_estate_meta( 'prop_status') : '';
			$prop_imgs    = ! empty( real_estate_meta( 'prop_imgs') ) ? real_estate_meta( 'prop_imgs', false) : '';
			$loc_icon     = REAL_ESTATE_DIR_ICON_IMG_URI . 'location.svg';
			$square_icon  = REAL_ESTATE_DIR_ICON_IMG_URI . 'square.svg';
			$bed_icon  	  = REAL_ESTATE_DIR_ICON_IMG_URI . 'bed.svg';
			$bath_icon    = REAL_ESTATE_DIR_ICON_IMG_URI . 'bath.svg';
			?>
			<div class="col-xl-4 col-md-6 col-lg-4">
				<div class="single_property">
					<div class="property_thumb">
						<?php
							if ( $prop_status != '' ) {
								?>
								<div class="property_tag<?=esc_attr( $prop_status == 'to_rent' ? ' red' : '' )?>">
									<?=esc_html( $prop_status == 'to_sale' ? __( 'For Sale', 'real-estate-companion' ) : ($prop_status == 'to_rent' ? __( 'For Rent', 'real-estate-companion' ) : '') )?>
								</div>
								<?php
							}
							
							if ( has_post_thumbnail() ) {
								echo $property_img;
							}
						?>
					</div>
					<div class="property_content">
						<div class="main_pro">
							<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
							<?php
							if ( $prop_address != '' ) {
								?>
								<div class="mark_pro">
									<img src="<?=esc_html( $loc_icon )?>" alt="location icon">
									<span><?=esc_html( $prop_address )?></span>
								</div>
								<?php
							}
							if ( $prop_price != '' ) {
								?>
								<span class="amount">
									<?php
										if ( $sell_con == 'monthly' ) {
											echo '$'.esc_html( $prop_price ).'/'.__('month', 'real-estate-companion');
										} else {
											echo __('From', 'real-estate-companion'). ' $'.esc_html( $prop_price );
										}
									?>
								</span>
								<?php
							}
							?>
						</div>
					</div>

					<div class="footer_pro">
						<ul>
							<li>
								<div class="single_info_doc">
									<img src="<?=esc_url( $square_icon )?>" alt="square icon">
									<span><?=esc_html( $prop_area )?> <?= _e('Sqft', 'real-estate-companion')?></span>
								</div>
							</li>
							<li>
								<div class="single_info_doc">
									<img src="<?=esc_url( $bed_icon )?>" alt="bed icon">
									<span><?=esc_html( $prop_bed )?> <?= ($prop_bed > 1) ? _e('Beds', 'real-estate-companion') : _e('Bed', 'real-estate-companion')?></span>
								</div>
							</li>
							<li>
								<div class="single_info_doc">
									<img src="<?=esc_url( $bath_icon )?>" alt="bath icon">
									<span><?=esc_html( $prop_bath )?> <?= ($prop_bath > 1) ? _e('Baths', 'real-estate-companion') : _e('Bath', 'real-estate-companion')?></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<?php
		}
	}
}


add_action('wp_ajax_prop_datas', 'search_prop_form_datas');
add_action('wp_ajax_nopriv_prop_datas', 'search_prop_form_datas');

// Search properties form data handling
if ( ! function_exists( 'search_prop_form_datas' ) ) {
	function search_prop_form_datas() {
		// Check the nonce
		check_ajax_referer( 'search_prop_data_nonce', 'nonce' );

		// Catch our datas and sanitize them
		$prop_loc	= isset( $_POST['prop_loc'] ) ? sanitize_text_field( $_POST['prop_loc'] ) : '';
		$prop_type	= isset( $_POST['prop_type'] ) ? sanitize_text_field( $_POST['prop_type'] ) : '';
		$price_min	= isset( $_POST['price_min'] ) ? sanitize_text_field($_POST['price_min']) : '';
		$price_max	= isset( $_POST['price_max'] ) ? sanitize_text_field($_POST['price_max']) : '';
		$bed_room	= isset( $_POST['bed_room'] ) ? sanitize_text_field( $_POST['bed_room'] ) : '';
		$bath_room	= isset( $_POST['bath_room'] ) ? sanitize_text_field( $_POST['bath_room'] ) : '';
		
		
		$price_min = substr_replace($price_min,"",-1) . '000';
		$price_max = substr_replace($price_max,"",-1) . '000';
		$item = 0;
		$response	= [];
		ob_start();
		$properties = new WP_Query( array(
			'post_type' => 'property',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key'     => '_real_estate_prop_address',
					'value'   => $prop_loc,
					'compare' => 'LIKE',
				),
				array(
					'key'     => '_real_estate_prop_price',
					'value'   => [$price_min, $price_max],
					'type'    => 'numeric',
					'compare' => 'BETWEEN',
				),
				array(
					'relation' => 'AND',
					array(
						'key'     => '_real_estate_prop_bed',
						'value'   => $bed_room,
						'compare' => '=',
					),
					array(
						'key'     => '_real_estate_prop_bath',
						'value'   => $bath_room,
						'compare' => '=',
					),
				),
			),
		) );
		if( $properties->have_posts() ) {
			while ( $properties->have_posts() ) {
				$properties->the_post();		
				$property_img = get_the_post_thumbnail( get_the_ID(), 'real_estate_property_thumb_362x240', '', array( 'alt' => get_the_title() ) );
				$prop_address = ! empty( real_estate_meta( 'prop_address') ) ? real_estate_meta( 'prop_address') : '';
				$prop_price   = ! empty( real_estate_meta( 'prop_price') ) ? real_estate_meta( 'prop_price') : '';
				$sell_con     = ! empty( real_estate_meta( 'sell_con') ) ? real_estate_meta( 'sell_con') : '';
				$phone_number = ! empty( real_estate_meta( 'phone_number') ) ? real_estate_meta( 'phone_number') : '';
				$prop_area    = ! empty( real_estate_meta( 'prop_area') ) ? real_estate_meta( 'prop_area') : 'N/A';
				$prop_bed     = ! empty( real_estate_meta( 'prop_bed') ) ? real_estate_meta( 'prop_bed') : 'N/A';
				$prop_bath    = ! empty( real_estate_meta( 'prop_bath') ) ? real_estate_meta( 'prop_bath') : 'N/A';
				$prop_status  = ! empty( real_estate_meta( 'prop_status') ) ? real_estate_meta( 'prop_status') : '';
				$prop_imgs    = ! empty( real_estate_meta( 'prop_imgs') ) ? real_estate_meta( 'prop_imgs', false) : '';
				$loc_icon     = REAL_ESTATE_DIR_ICON_IMG_URI . 'location.svg';
				$square_icon  = REAL_ESTATE_DIR_ICON_IMG_URI . 'square.svg';
				$bed_icon  	  = REAL_ESTATE_DIR_ICON_IMG_URI . 'bed.svg';
				$bath_icon    = REAL_ESTATE_DIR_ICON_IMG_URI . 'bath.svg';
				$item++;
				?>
				<div class="col-xl-4 col-md-6 col-lg-4">
					<div class="single_property">
						<div class="property_thumb">
							<?php
								if ( $prop_status != '' ) {
									?>
									<div class="property_tag<?=esc_attr( $prop_status == 'to_rent' ? ' red' : '' )?>">
										<?=esc_html( $prop_status == 'to_sale' ? __( 'For Sale', 'real-estate-companion' ) : ($prop_status == 'to_rent' ? __( 'For Rent', 'real-estate-companion' ) : '') )?>
									</div>
									<?php
								}
								
								if ( has_post_thumbnail() ) {
									echo $property_img;
								}
							?>
						</div>
						<div class="property_content">
							<div class="main_pro">
								<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
								<?php
								if ( $prop_address != '' ) {
									?>
									<div class="mark_pro">
										<img src="<?=esc_html( $loc_icon )?>" alt="location icon">
										<span><?=esc_html( $prop_address )?></span>
									</div>
									<?php
								}
								if ( $prop_price != '' ) {
									?>
									<span class="amount">
										<?php
											if ( $sell_con == 'monthly' ) {
												echo '$'.esc_html( $prop_price ).'/'.__('month', 'real-estate-companion');
											} else {
												echo __('From', 'real-estate-companion'). ' $'.esc_html( $prop_price );
											}
										?>
									</span>
									<?php
								}
								?>
							</div>
						</div>

						<div class="footer_pro">
							<ul>
								<li>
									<div class="single_info_doc">
										<img src="<?=esc_url( $square_icon )?>" alt="square icon">
										<span><?=esc_html( $prop_area )?> <?= _e('Sqft', 'real-estate-companion')?></span>
									</div>
								</li>
								<li>
									<div class="single_info_doc">
										<img src="<?=esc_url( $bed_icon )?>" alt="bed icon">
										<span><?=esc_html( $prop_bed )?> <?= ($prop_bed > 1) ? _e('Beds', 'real-estate-companion') : _e('Bed', 'real-estate-companion')?></span>
									</div>
								</li>
								<li>
									<div class="single_info_doc">
										<img src="<?=esc_url( $bath_icon )?>" alt="bath icon">
										<span><?=esc_html( $prop_bath )?> <?= ($prop_bath > 1) ? _e('Baths', 'real-estate-companion') : _e('Bath', 'real-estate-companion')?></span>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<?php
			}
			echo '<span class="total-search-count" data-total-search-count="'.$item.'"></span>';
			wp_reset_postdata();
		} else {
			echo '<h2 class="text-center">Sorry! We could not find any property with your criteria.</h2>';
			// echo '<h2 class="text-center">Prop loc '.$prop_loc.'</h2>';
		}
		$response = ob_get_clean();
		// $response['response'] = 'error';
		// $response['message']  = __( 'Please upload your CV.', 'job-app-manager' );

		// Return response
		echo json_encode( $response );
		exit();
	}
}


// Related cases for Single Page
function real_estate_related_cases( $current_post_id = null ){
	$related_cases = new WP_Query( array(
        'post_type' => 'case',
		'post__not_in' => array( $current_post_id ),
        // 'posts_per_page'    => $pnumber,
    ) );
	?>
	<!-- case_study_area  -->
	<div class="case_study_area case_page">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="section_title mb-40">
						<h3><?php _e('Related Properties', 'real-estate-companion')?></h3>
					</div>
				</div>
			</div>
			<div class="row">
				<?php
				if( $related_cases->have_posts() ) {
					while ( $related_cases->have_posts() ) {
						$related_cases->the_post();			
						$case_cat = get_the_terms(get_the_ID(), 'case-cat');
						$case_img = get_the_post_thumbnail( get_the_ID(), 'real_estate_case_study_thumb_362x240', '', array( 'alt' => get_the_title() ) );
						?>
						<div class="col-xl-4 col-md-6 col-lg-4">
							<div class="single_case">
								<?php 
									if ( $case_img ) {
										echo '
											<div class="case_thumb">
												'.$case_img.'
											</div>
										';
									}
								?>
								<div class="case_heading">
									<span><?php echo $case_cat[0]->name?></span>
									<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
								</div>
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