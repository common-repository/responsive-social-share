<?php
/* 
 * Social Sharing Module - Uninstall Functions
 */

function ress_post_sharing_uninstall() {
    
    // Delete Options
    delete_option( 'ress_post_sharing_order' );
    
    // Delete Transients
    delete_transient( 'ress_post_sharing_status_widget' . get_current_blog_id() );
    
    // TODO: Remove share count post_meta from all posts.
    
}
add_action( 'ress_plugin_uninstall', 'ress_post_sharing_uninstall' );
add_action( 'ress_plugin_uninstall_multisite', 'ress_post_sharing_uninstall' );