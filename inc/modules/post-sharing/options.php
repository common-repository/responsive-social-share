<?php
/* 
 * Adds Module related options to the Plugin.
 */

if ( ! defined( 'RESS_VERSION' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die;
}

/*
 * Register Module Setting Section and Fields.
 */
function ress_post_sharing_options_init() {
    
    /**
     * Section - Social Sharing
     */
    add_settings_section(
        'ress_post_sharing', // Unique identifier for the settings section
        __('Settings', 'ress'), // Section title
        '__return_false', // Section callback (we don't want anything)
        'ress-post-sharing' // Menu slug
    );
    
    /**
     * Field - Share Links Label
     */
    add_settings_field(
        'post_sharing_label', // Unique identifier for the field for this section
        __('Share Label', 'ress'), // Setting field label
        'ress_options_render_text_input', // Function that renders the settings field
        'ress-post-sharing', // Menu slug
        'ress_post_sharing', // Settings section.
        array( // Args to pass to render function
            'name' => 'post_sharing_label',
            'help_text' => __( 'Text displayed before the Social Share buttons.', 'ress' )
        ) 
    );
    
    /**
     * Field - Social Sharing Theme
     */
    add_settings_field(
        'post_sharing_theme', // Unique identifier for the field for this section
        __('Theme', 'ress'), // Setting field label
        'ress_post_sharing_theme_render', // Function that renders the settings field
        'ress-post-sharing', // Menu slug
        'ress_post_sharing', // Settings section.
        array( // Args to pass to render function
            'name' => 'post_sharing_theme',
            'help_text' => __( 'Choose the Theme used to display the share buttons.', 'ress' )
        ) 
    );
    
    /**
     * Field - Share Link Size
     */
    add_settings_field(
        'post_sharing_size', // Unique identifier for the field for this section
        __('Button Size', 'ress'), // Setting field label
        'ress_post_sharing_size_render', // Function that renders the settings field
        'ress-post-sharing', // Menu slug
        'ress_post_sharing', // Settings section.
        array( // Args to pass to render function
            'name' => 'post_sharing_size',
            'help_text' => __( 'Controls the size of the Sharing buttons.', 'ress' )
        ) 
    );
    
    /**
     * Field - Social Sharing Position
     */
    add_settings_field(
        'post_sharing_position', // Unique identifier for the field for this section
        __('Position', 'ress'), // Setting field label
        'ress_post_sharing_position_render', // Function that renders the settings field
        'ress-post-sharing', // Menu slug
        'ress_post_sharing', // Settings section.
        array( // Args to pass to render function
            'name' => 'post_sharing_position',
            'help_text' => __( 'Choose where on the page to show the Share Buttons.', 'ress' )
        ) 
    );
    
    /**
     * Field - Social Sharing Post Types
     */
    add_settings_field(
        'post_sharing_post_types', // Unique identifier for the field for this section
        __('Post Types', 'ress'), // Setting field label
        'ress_post_sharing_post_type_render', // Function that renders the settings field
        'ress-post-sharing', // Menu slug
        'ress_post_sharing', // Settings section.
        array( // Args to pass to render function
            'name' => 'post_sharing_post_types',
            'help_text' => __( 'Which Post Types to display Share buttons for.', 'ress' )
        ) 
    );
    
    /**
     * Field - Social Sharing Content Width
     */
    add_settings_field(
        'post_sharing_site_width', // Unique identifier for the field for this section
        __('Max Content Width', 'ress'), // Setting field label
        'ress_options_render_text_input', // Function that renders the settings field
        'ress-post-sharing', // Menu slug
        'ress_post_sharing', // Settings section.
        array( // Args to pass to render function
            'name' => 'post_sharing_site_width',
            'help_text' => __( 'The maximum width of your website, in pixels.', 'ress' )
        ) 
    );
    

    
}
add_action( 'admin_init', 'ress_post_sharing_options_init' );

/*
 * Add Module Default Options
 */
function ress_post_sharing_option_defaults( $defaults ) {
    
    $sharing = array(
        'post_sharing_label' => 'Share this:',
        'post_sharing_theme' => 'plain',
        'post_sharing_position' => array( 'top', 'bottom' ),
        'post_sharing_counts' => 'yes',
        'post_sharing_size' => 'medium',
        'post_sharing_post_types' => array( 'post' ),
        'post_sharing_site_width' => 1100
    );
    
    $options = wp_parse_args( $defaults, $sharing );
    
    return $options;
    
}
add_filter( 'ress_get_plugin_options', 'ress_post_sharing_option_defaults' );

/**
 * Returns an array of select inputs for the Theme dropdown.
 */
function ress_post_sharing_themes() {
    
    $themes = array(
        'plain' => array(
            'value' => 'plain',
            'label' => __('Plain', 'ress')
        ),
        'gradient' => array(
            'value' => 'gradient',
            'label' => __('Gradient', 'ress')
        ),
    );

    return apply_filters( 'ress_post_sharing_themes', $themes );
    
}

/**
 * Renders the Theme dropdown.
 */
function ress_post_sharing_theme_render( $args ) {
    
    $options = ress_get_plugin_options();
    
    $name = esc_attr( $args['name'] );
    
    ?>
    <select id="<?php echo $name; ?>" name="ress_plugin_options[<?php echo $name; ?>]">
    <?php
    foreach ( ress_post_sharing_themes() as $dropdown ) {
        
        ?>
        <option value="<?php echo esc_attr( $dropdown['value'] ); ?>" <?php selected( $dropdown['value'], $options[ $name ] ); ?>>
            <?php echo esc_html( $dropdown['label'] ); ?>
        </option>
        <?php
        
    }
    ?>
    </select>    
    <?php
        
}

/**
 * Returns an array of select inputs for the Theme dropdown.
 */
function ress_post_sharing_positions() {
    
    $dropdown = array(
        'top' => array(
            'value' => 'top',
            'label' => __('Top', 'ress')
        ),
        'bottom' => array(
            'value' => 'bottom',
            'label' => __('Bottom', 'ress')
        ),
        'floating' => array(
            'value' => 'floating',
            'label' => __('Floating Bar', 'ress')
        ),
    );

    return apply_filters( 'ress_post_sharing_positions', $dropdown );
    
}

/**
 * Renders the Post Type checkboxes.
 */
function ress_post_sharing_position_render( $args ) {
    
    $options = ress_get_plugin_options();
    
    $name = esc_attr( $args['name'] );
    
    $help_text = ( $args['help_text'] ) ? esc_html( $args['help_text'] ) : null;
    
    foreach ( ress_post_sharing_positions() as $position ) {
        
        ?>
        <label for="<?php echo $name; ?>[<?php echo $position['value']; ?>]">
        <input type="checkbox" id="<?php echo $name; ?>[<?php echo $position['value']; ?>]" name="ress_plugin_options[<?php echo $name; ?>][]" value="<?php echo $position['value']; ?>" <?php checked( true, in_array( $position['value'], $options[ $name ] ) ); ?> />
        <?php echo esc_html( $position['label'] ); ?>
        </label>
        <br>
        <?php
        
    }
    
    if ( $help_text ) { ?>
        <span class="howto"><?php echo esc_html( $help_text ); ?></span>
    <?php }
        
}

/**
 * Returns an array of select inputs for the Theme dropdown.
 */
function ress_post_sharing_sizes() {
    
    $dropdown = array(
        'xsmall' => array(
            'value' => 'xsmall',
            'label' => __('Extra Small', 'ress')
        ),
        'small' => array(
            'value' => 'small',
            'label' => __('Small', 'ress')
        ),
        'medium' => array(
            'value' => 'medium',
            'label' => __('Medium', 'ress')
        ),
        'large' => array(
            'value' => 'large',
            'label' => __('Large', 'ress')
        ),
        'xlarge' => array(
            'value' => 'xlarge',
            'label' => __('Extra Large', 'ress')
        ),
    );

    return apply_filters( 'ress_post_sharing_sizes', $dropdown );
    
}

/**
 * Renders the radio options setting field.
 */
function ress_post_sharing_size_render( $args ) {
    
    $options = ress_get_plugin_options();
    
    $name = esc_attr( $args['name'] );
    
    ?>
    <select id="<?php echo $name; ?>" name="ress_plugin_options[<?php echo $name; ?>]">
    <?php
    foreach ( ress_post_sharing_sizes() as $dropdown ) {
        
        ?>
        <option value="<?php echo esc_attr( $dropdown['value'] ); ?>" <?php selected( $dropdown['value'], $options[ $name ] ); ?>>
            <?php echo esc_html( $dropdown['label'] ); ?>
        </option>
        <?php
        
    }
    ?>
    </select>    
    <?php
    
}

/**
 * Renders the Post Type checkboxes.
 */
function ress_post_sharing_post_type_render( $args ) {
    
    $options = ress_get_plugin_options();
    
    $name = esc_attr( $args['name'] );
    
    $help_text = ( $args['help_text'] ) ? esc_html( $args['help_text'] ) : null;
    
    $args = array(
        'public' => true,
    );
    $post_types = get_post_types( $args, 'objects' );
    
    foreach ( $post_types as $post_type ) {
        
        ?>
        <label for="<?php echo $name; ?>[<?php echo $post_type->name; ?>]">
        <input type="checkbox" id="<?php echo $name; ?>[<?php echo $post_type->name; ?>]" name="ress_plugin_options[<?php echo $name; ?>][]" value="<?php echo $post_type->name; ?>" <?php checked( true, in_array( $post_type->name, $options[ $name ] ) ); ?> />
        <?php echo esc_html( $post_type->labels->name ); ?>
        </label>
        <br>
        <?php
        
    }
    
    if ( $help_text ) { ?>
        <span class="howto"><?php echo esc_html( $help_text ); ?></span>
    <?php }
        
}

/**
 * Sanitize and validate options input. Accepts an array, return a sanitized array.
 */
function ress_post_sharing_options_validate( $input, $output ) {
    
    if ( isset( $input['post_sharing_label'] ) && ! empty( $input['post_sharing_label'] ) ) {
	$output['post_sharing_label'] = sanitize_text_field( $input['post_sharing_label'] );
    }
    
    if ( isset( $input['post_sharing_position'] ) ) {
        $output['post_sharing_position'] = esc_html( $input['post_sharing_position'] );
    }
    
    if ( isset( $input['post_sharing_counts'] ) && array_key_exists( $input['post_sharing_counts'], ress_options_radio_buttons() ) ) {
        $output['post_sharing_counts'] = $input['post_sharing_counts'];
    }
    
    if ( isset( $input['post_sharing_post_types'] ) ) {
        $output['post_sharing_post_types'] = esc_html( $input['post_sharing_post_types'] );
    }
    
    if ( isset( $input['post_sharing_theme'] ) && array_key_exists( $input['post_sharing_theme'], ress_post_sharing_themes() ) ) {
        $output['post_sharing_theme'] = $input['post_sharing_theme'];
    }
    
    if ( isset( $input['post_sharing_site_width'] ) && ! empty( $input['post_sharing_site_width'] ) ) {
	$output['post_sharing_site_width'] = absint( $input['post_sharing_site_width'] );
    }
    
    return $output;
    
}
add_filter( 'ress_plugin_options_validation', 'ress_post_sharing_options_validate', 10, 2 );