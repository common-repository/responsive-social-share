<?php
/*
 * Register the Top Level menu item for the plugin.
 */

if ( ! defined( 'RESS_VERSION' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die;
}

function ress_plugin_menu() {

    /*
     * Plugin Page - Under Settings Menu
     * 
     * Uses Internal Tabs
     */
    add_submenu_page(
        'options-general.php', // Parent
        __('Responsive Social Share', 'ress'), // Page Title
        __('Responsive Social Share', 'ress'), // Menu Title
        'manage_options', // Capability
        'responsive-social-share', // Menu Slug
        'responsive_social_share_menu_render' // Render Function
    );
    
}
add_action( 'admin_menu', 'ress_plugin_menu' );

/*
 * Render the Dashboard Page
 */
function ress_dashboard_page_render() {
    ?>

        <?php settings_errors('ress-dashboard'); ?>

        <div id="dashboard-widgets-wrap" class="wpspec">
            
            <div id="dashboard-widgets" class="metabox-holder">
                
                <div id="postbox-container-1" class="postbox-container">
                    
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                        
                        <!-- Begin Dashboard Items - Column One -->
                        
                        <?php do_action( 'ress_dashboard_column_one' ); ?>
                        
                        <!-- End Dashboard Items - Column One -->
                        
                    </div><!-- .meta-box-sortables .ui-sortable -->
                    
                </div><!-- .postbox-container -->
                
                <div id="postbox-container-2" class="postbox-container">
                    
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                        
                        <!-- Begin Dashboard Items - Column Two -->
                        
                        <?php do_action( 'ress_dashboard_column_two' ); ?>
                        
                        <!-- End Dashboard Items - Column Two -->
                        
                    </div>
                    
                </div>
                
                <div id="postbox-container-3" class="postbox-container">
                    
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                        
                        <!-- Begin Dashboard Items - Column Three -->
                        
                        <?php do_action( 'ress_dashboard_column_three' ); ?>
                        
                        <!-- End Dashboard Items - Column Three -->
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>

        <style type="text/css">
        
            .js .postbox .hndle {
                cursor: auto;
            }
        
        </style>

    <?php
}
add_action( 'ress_tab_page_dashboard', 'ress_dashboard_page_render' );

/*
 * Render the Settings Page
 */
function ress_settings_page_render() {
    
    ?>

        <?php settings_errors('ress-settings'); ?>
        
        <form method="post" action="options.php">
            <?php
            settings_fields( 'ress_options' );
            do_settings_sections( 'ress-settings' );
            submit_button();
            ?>
        </form>

    <?php
    
}
//add_action( 'ress_tab_page_settings', 'ress_settings_page_render' );

/**
 * Renders the Twitter Feed Options page.
 */
function responsive_social_share_menu_render() {
    
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    
    ?>
    <div class="wrap wpspec">
        
        <h2><?php _e('Responsive Social Share', 'ress'); ?></h2>
        
        <?php
        /**
         * Render Page
         */
        ress_tab_page_render();
        ?>
        
    </div><!-- .wrap -->

    <?php
    
}