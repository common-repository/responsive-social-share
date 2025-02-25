<?php
/* 
 * Load Extra Classes and Files
 */

if ( ! defined( 'RESS_VERSION' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die;
}

/*
 * Include Options file.
 */
require_once( RESS_PATH . 'inc/options.php' );

/*
 * Include Classes
 */
function ress_class_autoloader( $class ) {
    
    if ( file_exists ( RESS_PATH . 'inc/classes/' . $class . '.php' ) ) {
        
        require_once RESS_PATH . 'inc/classes/' . $class . '.php';
        
    }
    
}
spl_autoload_register( 'ress_class_autoloader' );

/*
 * Include Main Menu file.
 */
require_once( RESS_PATH . 'inc/menu.php' );

/*
 * Include Dashboard Widgets file.
 */
require_once( RESS_PATH . 'inc/dashboard-widgets.php' );

/*
 * Include Helper Functions file.
 */
require_once( RESS_PATH . 'inc/helpers.php' );

/*
 * Include AJAX file.
 */
require_once( RESS_PATH . 'inc/ajax.php' );

// Get Plugin Options
$options = ress_get_plugin_options();

/*
 * Include activated features file.
 */
if ( 'yes' == $options['feature_control_post_sharing'] ) {
    
    require_once( RESS_PATH . 'inc/modules/post-sharing/init.php' );
    
}

// Unset Plugin Options
unset( $options );