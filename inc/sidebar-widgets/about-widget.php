<?php
if( !defined( 'WPINC' ) ){
    die;
}
/**
 * @Packge     : Real_Estate Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */

 
 
/**************************************
*Creating About Widget
***************************************/
 
class real_estate_about_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'real_estate_about_widget', 


// Widget name will appear in UI
esc_html__( '[ Real_Estate ] About Widget', 'real_estate-companion' ), 

// Widget description
array( 'description' => esc_html__( 'Add footer about content', 'real_estate-companion' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
	
$title 		= apply_filters( 'widget_title', $instance['title'] );
$image 		= apply_filters( 'widget_image', $instance['image'] );
$textarea 	= apply_filters( 'widget_textarea', $instance['textarea'] );

// before and after widget arguments are defined by themes
echo wp_kses_post( $args['before_widget'] );
if ( ! empty( $title ) )
echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );

    
?>
    <div class="single-footer-widget mb-100">
        <?php 
        // logo
        if( $image ){
        	echo '<a href="'.esc_url( site_url('/') ).'" class="mb-50 d-block">';
		    	echo real_estate_img_tag(
		    		array(
		    			'url' 	 => esc_url( $image ),
		    		)
		    	);
        	echo '</a>';
        }
        //
		if( $textarea ){
			echo '<p>'.wp_kses_post( $textarea).'</p>';
		}
        ?>
    </div>
<?php
echo wp_kses_post( $args['after_widget'] );
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'About', 'real_estate-companion' );
}


//	Text Area
if ( isset( $instance[ 'textarea' ] ) ) {
	$textarea = $instance[ 'textarea' ];
}else {
	$textarea = '';
}

//	logo
if ( isset( $instance[ 'image' ] ) ) {
	$image = $instance[ 'image' ];
}else {
	$image = '';
}

// Widget admin form
?>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' ,'real_estate-companion'); ?></label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>"><?php esc_html_e( 'About Content:' ,'real_estate-companion'); ?></label> 
<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea' ) ); ?>"><?php echo esc_textarea( $textarea ); ?></textarea>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php _e( 'Image', 'real_estate-companion' ); ?>:</label>
	<div class="real_estate-media-container">
		<div class="real_estate-media-inner">
			<?php $img_style = ( $image != '' ) ? '' : 'style="display:none;"'; ?>
			<img id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-preview" src="<?php echo esc_attr( $image ); ?>" <?php echo wp_kses_post( $img_style ); ?> />
			<?php $no_img_style = ( $image != '' ) ? 'style="display:none;"' : ''; ?>
			<span class="real_estate-no-image" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-noimg" <?php echo wp_kses_post( $no_img_style ); ?>><?php _e( 'No image selected', 'real_estate-companion' ); ?></span>
		</div>
	
	<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" value="<?php echo esc_attr( $image ); ?>" class="real_estate-media-url" />

	<input type="button" value="<?php echo _e( 'Remove', 'real_estate-companion' ); ?>" class="button real_estate-media-remove" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-remove" <?php echo wp_kses_post( $img_style ); ?> />

	<?php $button_text = ( $image != '' ) ? __( 'Change Image', 'real_estate-companion' ) : __( 'Select Image', 'real_estate-companion' ); ?>
	<input type="button" value="<?php echo esc_html( $button_text ); ?>" class="button real_estate-media-upload" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-button" />
	<br class="clear">
	</div>
</p>
<style>
.real_estate-media-container {
	width: 98%;
}

.real_estate-media-inner {
	border: 1px solid #ddd;
	padding: 10px;
	text-align: center;
	border-radius: 2px;
	margin-bottom: 10px;
}

.widget-description img,
.real_estate-media-inner img {
	max-width: 100%;
	height: auto;
}

.real_estate-media-url {
	display: none;
}

.real_estate-media-remove {
	float: left;
	width: 48%;
}

.real_estate-media-upload {
	float: right;
	width: 48%;
}
</style>
<script>
jQuery(function($){
    'use strict';
	/**
	 *
	 * About Widget Logo upload
	 *
	 */
	$( function(){
	    // Upload / Change Image
    function wpshed_image_upload( button_class ) {
        
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;

        $( 'body' ).on( 'click', button_class, function(e) {

            var button_id           = '#' + $( this ).attr( 'id' ),
                self                = $( button_id),
                send_attachment_bkp = wp.media.editor.send.attachment,
                button              = $( button_id ),
                id                  = button.attr( 'id' ).replace( '-button', '' );

            _custom_media = true;

            wp.media.editor.send.attachment = function( props, attachment ){

                if ( _custom_media ) {

                    $( '#' + id + '-preview'  ).attr( 'src', attachment.url ).css( 'display', 'block' );
                    $( '#' + id + '-remove'  ).css( 'display', 'inline-block' );
                    $( '#' + id + '-noimg' ).css( 'display', 'none' );
                    $( '#' + id ).val( attachment.url ).trigger( 'change' );  

                } else {

                    return _orig_send_attachment.apply( button_id, [props, attachment] );

                }
            }

            wp.media.editor.open( button );

            return false;
        });
    }
    wpshed_image_upload( '.real_estate-media-upload' );

    // Remove Image
    function wpshed_image_remove( button_class ) {

        $( 'body' ).on( 'click', button_class, function(e) {

            var button              = $( this ),
                id                  = button.attr( 'id' ).replace( '-remove', '' );

            $( '#' + id + '-preview' ).css( 'display', 'none' );
            $( '#' + id + '-noimg' ).css( 'display', 'block' );
            button.css( 'display', 'none' );
            $( '#' + id ).val( '' ).trigger( 'change' );

        });
    }
    wpshed_image_remove( '.real_estate-media-remove' );
	
	});
});
</script>
<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {

	
$instance = array();
$instance['title'] 	  = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['textarea'] = ( ! empty( $new_instance['textarea'] ) ) ? strip_tags( $new_instance['textarea'] ) : '';
$instance['image']  	  = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';

return $instance;
}
} // Class quickfix_subscribe_widget ends here


// Register and load the widget
function real_estate_about_load_widget() {
	register_widget( 'real_estate_about_widget' );
}
add_action( 'widgets_init', 'real_estate_about_load_widget' );