<?php
/* 
 * Register the core Dashboard Widgets
 */

if ( ! defined( 'RESS_VERSION' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die;
}

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function ress_post_sharing_add_status_widget() {

	wp_add_dashboard_widget(
            'ress_post_sharing_status',
            __( 'Post Sharing Status', 'ress' ),
            'ress_post_sharing_status_widget_render'
        );	
}
add_action( 'wp_dashboard_setup', 'ress_post_sharing_add_status_widget' );

/**
 * Social Sharing Dashboard Widget
 * 
 * Displays Total and Grouped Social Counts.
 */
function ress_post_sharing_status_widget_render() {
    
    /*
     * Store Query Results in Transient to save processing
     * 
     * expiry 5 mins
     * 
     * TODO: Make this refresh in the background so it never impacts 
     */
    if ( false === ( $counts = get_transient( 'ress_post_sharing_status_widget' . get_current_blog_id() ) ) ) {
        
        global $wpdb;

        /*
         * Query for all share count post_meta
         * 
         * TODO: Test on blogs with extreme numbers of posts.
         */
        $results = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM $wpdb->postmeta WHERE meta_key = %s",
                '_ress_post_sharing_counts'
            )
        );
        
        /**
         * Prepare Social Count Totals
         */
        $counts = ress_post_sharing_prepare_count_totals( $results );
        
        /*
         * Add custom expiry time for use in soft expiry
         */
        //$counts->expiry = time() + ( 5 * MINUTE_IN_SECONDS );
        
        set_transient( 'ress_post_sharing_status_widget' . get_current_blog_id(), $counts, 5 * MINUTE_IN_SECONDS );
        
    }
    
    /**
     * Check we have valid Data before output.
     */
    if ( is_object( $counts ) && ! empty( $counts->total ) ) : 
    ?>

    <div class="ress-status">
        
        <div class="kfull" style="border: none;" title="<?php esc_attr_e( 'Total Number of Social Shares', 'ress' ); ?>">
            <span class="kcount total" style="font-size: 18px; margin: 0;"><?php echo esc_html( number_format( $counts->total ) ); ?></span>
            <span class="klabel" style="margin: 0;"><?php esc_html_e( 'Total Shares', 'ress' ); ?></span>
        </div>
        
        <div class="khalf">
            <span class="kcount twitter"><?php echo esc_html( number_format( $counts->twitter ) ); ?></span>
            <span class="klabel">Twitter</span>
        </div>
        
        <div class="khalf kright">
            <span class="kcount facebook"><?php echo esc_html( number_format( $counts->facebook ) ); ?></span>
            <span class="klabel">Facebook</span>
        </div>
        
        <div class="khalf">
            <span class="kcount googleplus"><?php echo esc_html( number_format( $counts->googleplus ) ); ?></span>
            <span class="klabel">Google+</span>
        </div>
        
        <div class="khalf kright">
            <span class="kcount linkedin"><?php echo esc_html( number_format( $counts->linkedin ) ); ?></span>
            <span class="klabel">LinkedIn</span>
        </div>
        
        <br class="clear">
        
    </div>

    <?php
    else :
    ?>

    <div class="ress-status">
        
        <h3 style="text-align: center;"><?php _e( 'Sorry, not enough data.', 'ress' ); ?></h3>
        
    </div>

    <?php
    endif;
    
}