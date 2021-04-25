<?php
/*
 * Plugin Name:       Real Estate Companion
 * Plugin URI:        https://colorlib.com/wp/themes/real-estate/
 * Description:       Real-Estate Companion is a companion for Real-Estate theme.
 * Version:           1.0.1
 * Author:            Colorlib
 * Author URI:        https://colorlib.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       real-estate-companion
 * Domain Path:       /languages
 */


if( !defined( 'WPINC' ) ){
    die;
}

/*************************
    Define Constant
*************************/

// Define version constant
if( !defined( 'REAL_ESTATE_COMPANION_VERSION' ) ){
    define( 'REAL_ESTATE_COMPANION_VERSION', '1.1' );
}

// Define dir path constant
if( !defined( 'REAL_ESTATE_COMPANION_DIR_PATH' ) ){
    define( 'REAL_ESTATE_COMPANION_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

// Define inc dir path constant
if( !defined( 'REAL_ESTATE_COMPANION_INC_DIR_PATH' ) ){
    define( 'REAL_ESTATE_COMPANION_INC_DIR_PATH', REAL_ESTATE_COMPANION_DIR_PATH.'inc/' );
}

// Define sidebar widgets dir path constant
if( !defined( 'REAL_ESTATE_COMPANION_SW_DIR_PATH' ) ){
    define( 'REAL_ESTATE_COMPANION_SW_DIR_PATH', REAL_ESTATE_COMPANION_INC_DIR_PATH.'sidebar-widgets/' );
}

// Define elementor widgets dir path constant
if( !defined( 'REAL_ESTATE_COMPANION_EW_DIR_PATH' ) ){
    define( 'REAL_ESTATE_COMPANION_EW_DIR_PATH', REAL_ESTATE_COMPANION_INC_DIR_PATH.'elementor-widgets/' );
}

// Define demo data dir path constant
if( !defined( 'REAL_ESTATE_COMPANION_DEMO_DIR_PATH' ) ){
    define( 'REAL_ESTATE_COMPANION_DEMO_DIR_PATH', REAL_ESTATE_COMPANION_INC_DIR_PATH.'demo-data/' );
}


$current_theme = wp_get_theme();

$is_parent = $current_theme->parent();



if( ( 'Real Estate' ==  $current_theme->get( 'Name' ) ) || ( $is_parent && 'Real Estate' == $is_parent->get( 'Name' ) ) ){
    require_once REAL_ESTATE_COMPANION_DIR_PATH . 'real-estate-init.php';
}else{

    add_action( 'admin_notices', 'real_estate_companion_admin_notice', 99 );
    function real_estate_companion_admin_notice() {
        $url = 'https://demo.colorlib.com/real-estate/';
    ?>
        <div class="notice-warning notice">
            <p><?php printf( __( 'In order to use the <strong>Real Estate Companion</strong> plugin you have to also install the %1$sReal Estate Theme%2$s', 'real-estate-companion' ), '<a href="'.esc_url( $url ).'" target="_blank">', '</a>' ); ?></p>
        </div>
        <?php
    }
}

?>