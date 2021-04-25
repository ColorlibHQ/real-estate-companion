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

// demo import file
function real_estate_import_files() {
	
	$demoImg = '<img src="'.plugins_url( 'screen-image.jpg', __FILE__ ) .'" alt="'.esc_attr__( 'Demo Preview Imgae', 'real_estate-companion' ).'" />';
	
  return array(
    array(
      'import_file_name'             => 'Real_Estate Demo',
      'local_import_file'            => REAL_ESTATE_COMPANION_DEMO_DIR_PATH .'real_estate-demo.xml',
      'local_import_widget_file'     => REAL_ESTATE_COMPANION_DEMO_DIR_PATH .'real_estate-widgets-demo.wie',
      'import_customizer_file_url'   => plugins_url( 'real_estate-customizer.dat', __FILE__ ),
      'import_notice' => $demoImg,
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'real_estate_import_files' );


// demo import setup
function real_estate_after_import_setup() {
	// Assign menus to their locations.
	$main_menu    = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$departments  = get_term_by( 'name', 'Departments', 'nav_menu' );
	$useful_links = get_term_by( 'name', 'Useful Links', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu' => $main_menu->term_id,
			'departments'  => $departments->term_id,
			'useful-links' => $useful_links->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Homepage' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );
	update_option( 'posts_per_page', 3 );

	// Update the post to draft after import is done
	real_estate_update_the_followed_post_page_status();

	// Add an option to check after import is done
	update_option( 'real_estate-import-data', true );

}
add_action( 'pt-ocdi/after_import', 'real_estate_after_import_setup' );

//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function real_estate_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'real_estate-companion' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'real_estate-companion' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'real_estate-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'real_estate_import_plugin_page_setup' );

// Enqueue scripts
function real_estate_demo_import_custom_scripts(){
	
	
	if( isset( $_GET['page'] ) && $_GET['page'] == 'real_estate-demo-import' ){
		// style
		wp_enqueue_style( 'real_estate-demo-import', plugins_url( 'css/demo-import.css', __FILE__ ), array(), '1.0', false );
	}
	
	
}
add_action( 'admin_enqueue_scripts', 'real_estate_demo_import_custom_scripts' );
