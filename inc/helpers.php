<?php
/*
 * General Helper Functions
 */

if ( ! defined( 'RESS_VERSION' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die;
}

/**
 * Render Dashboard Widgets
 */
function ress_dashboard_widget_render( $title, $content, $sortable = false ) {
    
    ?>
    <div id="unique-id" class="postbox">

        <!--
        <div class="handlediv" title="<?php _e('Click to toggle'); ?>">
            
            <br>
            
        </div>
        -->

        <h3 class="hndle">

            <span><?php echo esc_html( $title ); ?></span>

        </h3>

        <div class="inside">

            <div class="main">

                <?php echo $content; ?>
                
            </div>

        </div>

    </div><!-- .postbox -->
    <?php
    
}

/**
 * Menu Tabs Helpers
 */

/**
 * Get Tabs Pages
 */
function ress_get_tabs_pages() {
    
    $pages = array(
        array(
            'slug' => 'dashboard',
            'label' => __( 'Dashboard', 'ress' )
        ),
        /*
        array(
            'slug' => 'settings',
            'label' => __( 'Settings', 'ress' )
        ),
         * 
         * Not Currently Used
         * Might be later
         */
    );
    
    return apply_filters( 'ress_tab_pages', $pages );
    
}

/**
 * Render Tab Pages
 */
function ress_tab_page_render() {
    
    /**
     * Render Tabs
     */
    ress_tabs_render();
    
    /**
     * Allow page content to be added via hooks.
     */
    do_action( 'ress_tab_page_' . ress_get_tab_page() );
    
}

/**
 * Renders Tabs
 */
function ress_tabs_render() {
    
    $pages = ress_get_tabs_pages();
    
    ?>
    <h2 class="nav-tab-wrapper">
    <?php
    
    if ( is_array( $pages ) ) :
        
        foreach ( $pages as $page ) {

            ?>
            <a class="nav-tab<?php echo ress_is_active_tab( $page ); ?>" data-slug="<?php echo esc_attr( $page['slug'] ); ?>" href="<?php echo admin_url( 'options-general.php?page=responsive-social-share&tab=' . esc_attr( $page['slug'] ) ); ?>"><?php echo esc_html( $page['label'] ); ?></a>
            <?php
        
        }
        
    endif;
    
    ?>
    </h2>
    <?php
    
}

/**
 * Checks for active tab and outputs class if needed
 */
function ress_get_tab_page() {
    
    if ( isset( $_GET['tab'] ) ) {
        
        $page = sanitize_title( $_GET['tab'], 'dashboard' );
        
    } else {
        
        $page = 'dashboard';
        
    }
        
    return $page;
    
}

/**
 * Checks for active tab and outputs class if needed
 */
function ress_is_active_tab( $page ) {
    
    if ( $page['slug'] == ress_get_tab_page() ) {
                
        echo ' nav-tab-active';
                
    }
    
}