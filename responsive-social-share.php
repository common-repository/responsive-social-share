<?php
/**
 * Plugin Name: Responsive Social Share
 * Plugin URI:  http://wpspec.com/
 * Description: Responsive Social Share is the best social media plugin for WordPress that integrates share buttons to your website.
 * Version:     1.3
 * Author:      WPSpec
 * Author URI:  http://wpspec.com/
 * License:     GPLv2+
 * Text Domain: ress
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2014 WPSpec
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Sorry, no direct access.' );
}

// Useful global constants
define( 'RESS_VERSION', '1.3' );
define( 'RESS_URL', plugin_dir_url(__FILE__) );
define( 'RESS_PATH', plugin_dir_path(__FILE__) );

/*
 * Load textdomain early, as we need it for the PHP version check.
 */
function ress_load_textdomain() {
    
    load_plugin_textdomain( 'ress', false, RESS_PATH . '/languages' );
    
}
add_filter( 'wp_loaded', 'ress_load_textdomain' );

/*
 * Check for the required version of PHP
 */
if ( version_compare( PHP_VERSION, '5.2', '<' ) ) {
    
    if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
        
        require_once ABSPATH . '/wp-admin/includes/plugin.php';
        deactivate_plugins(__FILE__);
        wp_die( __( 'Responsive Social Share requires PHP 5.2 or higher, as does WordPress 3.2 and higher.', 'ress' ) );
        
    }
    
}

/*
 * Load Relevant Internal Files
 */
function ress_plugin_setup() {

    /*
     * Include Loader file.
     */
    require_once( RESS_PATH . 'inc/loader.php' );
    
}
add_action( 'plugins_loaded', 'ress_plugin_setup', 15 );

/**
 * Register plugin scripts and styles.
 */
function ress_register_files() {

    // Register Styles
    wp_register_style( 'ress-admin', RESS_URL . 'assets/css/admin.css', array(), RESS_VERSION, 'all' );
    wp_register_style( 'ress-admin-min', RESS_URL . 'assets/css/admin.min.css', array(), RESS_VERSION, 'all' );
        
    // Register Scripts
    wp_register_script( 'ress-admin-js', RESS_URL . 'assets/js/admin.js', array(), RESS_VERSION, true );
    
    wp_register_script( 'ress-feature-control', RESS_URL . 'assets/js/feature-control.js', array( 'jquery' ), RESS_VERSION, true );
    
    wp_register_script( 'jquery-ui-touchpunch', RESS_URL . 'assets/js/vendor/jquery.ui.touch-punch.min.js', array( 'jquery-ui-sortable' ), RESS_VERSION, false );
    
    wp_register_script( 'flot', RESS_URL . 'assets/js/vendor/flot/jquery.flot.js', array( 'jquery' ), RESS_VERSION, false );
    wp_register_script( 'flot-min', RESS_URL . 'assets/js/vendor/flot/jquery.flot.min.js', array( 'jquery' ), RESS_VERSION, false );
    
    wp_register_script( 'flot-resize', RESS_URL . 'assets/js/vendor/flot/jquery.flot.resize.js', array( 'flot' ), RESS_VERSION, false );
    wp_register_script( 'flot-resize-min', RESS_URL . 'assets/js/vendor/flot/jquery.flot.resize.min.js', array( 'flot-min' ), RESS_VERSION, false );
    
    wp_register_script( 'flot-pie', RESS_URL . 'assets/js/vendor/flot/jquery.flot.pie.js', array( 'flot' ), RESS_VERSION, false );
    wp_register_script( 'flot-pie-min', RESS_URL . 'assets/js/vendor/flot/jquery.flot.pie.min.js', array( 'flot-min' ), RESS_VERSION, false );
    
    wp_register_script( 'flot-canvas', RESS_URL . 'assets/js/vendor/flot/jquery.flot.canvas.js', array( 'flot' ), RESS_VERSION, false );
    wp_register_script( 'flot-canvas-min', RESS_URL . 'assets/js/vendor/flot/jquery.flot.canvas.min.js', array( 'flot-min' ), RESS_VERSION, false );
    
    wp_register_script( 'flot-time', RESS_URL . 'assets/js/vendor/flot/jquery.flot.time.js', array( 'flot' ), RESS_VERSION, false );
    wp_register_script( 'flot-time-min', RESS_URL . 'assets/js/vendor/flot/jquery.flot.time.min.js', array( 'flot-min' ), RESS_VERSION, false );
        
}
add_action( 'wp_enqueue_scripts', 'ress_register_files' );
add_action( 'admin_enqueue_scripts', 'ress_register_files' );
    
/**
 * Enqueue frontend plugin scripts and styles.
 */
function ress_enqueue_frontend() {

    
        
}
add_action( 'wp_enqueue_scripts', 'ress_enqueue_frontend' );
    
/**
 * Enqueue backend plugin scripts and styles.
 */
function ress_enqueue_backend( $hook_suffix ) {
    
    // Enqueue files for core dashboard page
    if ( 'index.php' == $hook_suffix ) {
            
        /*
         * Use minified files where available, unless SCRIPT_DEBUG is true
         */
        if ( false == SCRIPT_DEBUG ) {
            
            wp_enqueue_style( 'ress-admin-min' );
            
        } else {
            
            wp_enqueue_style( 'ress-admin' );
            
        }
            
    }
    
    // Enqueue files for Responsive Social Share pages
    if ( 'settings_page_responsive-social-share' == $hook_suffix ) {
            
        /*
         * Use minified files where available, unless SCRIPT_DEBUG is true
         */
        if ( false == SCRIPT_DEBUG ) {
            
            wp_enqueue_style( 'ress-admin-min' );
            
        } else {
            
            wp_enqueue_style( 'ress-admin' );
            
        }
        
        wp_enqueue_script( 'ress-feature-control' );
            
    }
        
}
add_action( 'admin_enqueue_scripts', 'ress_enqueue_backend' );

/**
 * Add a link to the plugin screen, to allow users to jump straight to the settings page.
 */
$ress_plugin_file = plugin_basename(__FILE__);

function ress_plugin_settings_link( $links ) {
    
    $links[] = '<a href="' . admin_url( 'options-general.php?page=responsive-social-share' ) . '">' . __( 'Settings', 'ress' ) . '</a>';
    
    return $links;
    
}
add_filter( 'plugin_action_links_'. $ress_plugin_file, 'ress_plugin_settings_link' );