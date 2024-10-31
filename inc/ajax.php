<?php
/* 
 * Core plugin AJAX functions
 */

/*
 * AJAX Update Feature Control Options
 */
function ress_feature_control_update() {
    
    /*
     * Check for the required inputs
     */
    if ( ! isset( $_POST['action'] ) && ! isset( $_POST['data'] ) && ! isset( $_POST['nonce'] )  ) {
        die();
    }
    
    // Get the action
    $action = $_POST['action'];
    
    // Get the data
    $data = $_POST['data'];
    
    // Get nonce
    $nonce = $_POST['nonce'];
    
    /*
     * Check action
     */
    if ( 'ress_feature_control_update' !== $action ) {
        die();
    }
    
    /*
     * Check nonce
     */
    if ( ! wp_verify_nonce( $nonce, 'ress_feature_control' ) ) {
        die();
    }
    
    /**
     * Update Feature Control Options
     */
    $option_name = 'feature_control_' . $data;
    
    $options = ress_get_plugin_options();
    
    /*
     * If active then de-active, if de-active then activate.
     */
    if ( isset( $options[ $option_name ] ) && 'yes' == $options[ $option_name ] ) {
        
        $options[ $option_name ] = 'no';
        
    } else {
        
        $options[ $option_name ] = 'yes';
        
    }
    
    update_option( 'ress_plugin_options', $options );
    
    // Send successful response
    $response = array(
        'action' => 'save',
        'success' => 'true',
    );
    
    // Output response
    print_r( json_encode( $response ) );
    
    // Send Output
    die();
    
}
add_action( 'wp_ajax_ress_feature_control_update', 'ress_feature_control_update' );