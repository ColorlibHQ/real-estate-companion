<?php
function real_estate_property_metabox( $meta_boxes ) {

	$re_prefix = '_real_estate_';
	$meta_boxes[] = array(
		'id'        => 'property_metaboxes',
		'title'     => esc_html__( 'Property Details', 'real-estate-companion' ),
		'post_types'=> array( 'property' ),
		'priority'  => 'high',
		'autosave'  => 'false',
		'fields'    => array(
			array(
				'id'    => $re_prefix . 'prop_address',
				'type'  => 'text',
				'required'  => true,
				'name'  => esc_html__( 'Address', 'real-estate-companion' ),
				'placeholder' => esc_html__( 'Detail Address for the Property.', 'real-estate-companion' ),
			),
			array(
				'id'            => $re_prefix . 'prop_map',
				'type'          => 'osm',
				'name'          => esc_html__( 'Location', 'real-estate-companion' ),
				'std'           => '-6.233406,-35.049906,15',
				'address_field' => $re_prefix . 'prop_address',
			),
			array(
				'id'    => $re_prefix . 'prop_price',
				'type'  => 'text',
				'required'  => true,
				'name'  => esc_html__( 'Price', 'real-estate-companion' ),
				'placeholder' => esc_html__( 'Ex: 1000000', 'real-estate-companion' ),
			),
			array(
				'id'    => $re_prefix . 'sell_con',
				'type'  => 'button_group',
				'required'  => true,
				'style' => 'square',
				'name'  => esc_html__( 'Selling Condition', 'real-estate-companion' ),
				'options' => [
					'one_time' => esc_html__( 'One-Time', 'real-estate-companion' ),
					'monthly'  => esc_html__( 'Monthly', 'real-estate-companion' ),
				],
			),
			array(
				'id'    => $re_prefix . 'phone_number',
				'type'  => 'text',
				'name'  => esc_html__( 'Phone', 'real-estate-companion' ),
				'placeholder' => esc_html__( 'Ex: 000 000 000', 'real-estate-companion' ),
			),
			array(
				'id'    => $re_prefix . 'prop_area',
				'type'  => 'text',
				'name'  => esc_html__( 'Area (Square Feet)', 'real-estate-companion' ),
				'placeholder' => esc_html__( 'Ex: 1500', 'real-estate-companion' ),
			),
			array(
				'id'    => $re_prefix . 'prop_bed',
				'type'  => 'number',
				'name'  => esc_html__( 'Bed', 'real-estate-companion' ),
				'placeholder' => esc_html__( 'Ex: 3', 'real-estate-companion' ),
				'min'  => 1,
				'step'  => 1,
			),
			array(
				'id'    => $re_prefix . 'prop_bath',
				'type'  => 'number',
				'name'  => esc_html__( 'Bath', 'real-estate-companion' ),
				'placeholder' => esc_html__( 'Ex: 2', 'real-estate-companion' ),
				'min'  => 1,
				'step'  => 1,
			),
			array(
				'id'    => $re_prefix . 'prop_status',
				'type'  => 'button_group',
				'style'  => 'square',
				'name'  => esc_html__( 'Property for', 'real-estate-companion' ),
				'options' => [
					'to_sale' => esc_html__( 'Sale', 'real-estate-companion' ),
					'to_rent' => esc_html__( 'Rent', 'real-estate-companion' ),
				],
				'default' => 'to_sale'
			),
			array(
				'id'    => $re_prefix . 'prop_imgs',
				'type'  => 'image_advanced',
				'name'  => esc_html__( 'Images', 'real-estate-companion' ),
				'label_description'  => esc_html__( 'The best size is "1146x600"', 'real-estate-companion' ),
				'max_file_uploads'  => 10,
				'max_status'  => false,
			),
		),
	);


	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'real_estate_property_metabox' );