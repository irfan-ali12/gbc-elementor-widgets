<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_Properties {

    public static function init() {
        // Register hooks that call the actual registration on 'init'
        // This is REQUIRED - post types must be registered on 'init' hook
        add_action( 'init', [ __CLASS__, 'register_post_type' ], 0 );
        add_action( 'init', [ __CLASS__, 'register_taxonomy' ], 1 );
        
        // Other hooks
        add_filter( 'post_type_link', [ __CLASS__, 'property_permalink' ], 10, 2 );
        add_filter( 'template_include', [ __CLASS__, 'load_template' ], 20 );
        
        // AJAX hooks for contact form
        add_action( 'wp_ajax_gbc_property_contact', [ __CLASS__, 'handle_property_contact' ] );
        add_action( 'wp_ajax_nopriv_gbc_property_contact', [ __CLASS__, 'handle_property_contact' ] );
    }

    public static function register_post_type() {
        $labels = [
            'name'               => __( 'Properties', 'gbc-elementor-widgets' ),
            'singular_name'      => __( 'Property', 'gbc-elementor-widgets' ),
            'menu_name'          => __( 'Properties', 'gbc-elementor-widgets' ),
            'all_items'          => __( 'All Properties', 'gbc-elementor-widgets' ),
            'add_new'            => __( 'Add New Property', 'gbc-elementor-widgets' ),
            'add_new_item'       => __( 'Add New Property', 'gbc-elementor-widgets' ),
            'edit_item'          => __( 'Edit Property', 'gbc-elementor-widgets' ),
            'view_item'          => __( 'View Property', 'gbc-elementor-widgets' ),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [ 'slug' => 'properties', 'with_front' => false ],
            'capability_type'    => 'post',
            'has_archive'        => 'properties',
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-building',
            'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
            'show_in_rest'       => true,
        ];

        register_post_type( 'property', $args );
    }

    public static function register_taxonomy() {
        register_taxonomy( 'property_status', 'property', [
            'label'        => __( 'Property Status', 'gbc-elementor-widgets' ),
            'rewrite'      => [ 'slug' => 'property-status' ],
            'public'       => true,
            'hierarchical' => false,
            'show_in_rest' => true,
        ] );
    }

    public static function load_template( $template ) {
        // Debug logging
        error_log('GBC_EW_Properties::load_template called');
        error_log('is_post_type_archive(property): ' . (is_post_type_archive( 'property' ) ? 'true' : 'false'));
        error_log('is_singular(property): ' . (is_singular( 'property' ) ? 'true' : 'false'));
        
        if ( is_post_type_archive( 'property' ) ) {
            error_log('Loading archive template');
            return GBC_EW_PATH . 'includes/templates/archive-property.php';
        }

        if ( is_singular( 'property' ) ) {
            error_log('Loading single template');
            return GBC_EW_PATH . 'includes/templates/single-property.php';
        }

        return $template;
    }

    public static function property_permalink( $permalink, $post ) {
        if ( 'property' === $post->post_type ) {
            return home_url( '/properties/' . $post->post_name . '/' );
        }
        return $permalink;
    }

    /**
     * Get all property meta fields
     */
    public static function get_property_meta( $property_id ) {
        return [
            'price'    => get_post_meta( $property_id, 'property_price', true ),
            'address'  => get_post_meta( $property_id, 'property_address', true ),
            'beds'     => get_post_meta( $property_id, 'property_beds', true ),
            'baths'    => get_post_meta( $property_id, 'property_baths', true ),
            'sqft'     => get_post_meta( $property_id, 'property_sqft', true ),
            'status'   => get_post_meta( $property_id, 'property_status', true ),
            'gallery'  => get_post_meta( $property_id, 'property_gallery', true ),
            'location' => get_post_meta( $property_id, 'property_location', true ),
        ];
    }

    /**
     * Get all properties
     */
    public static function get_properties( $args = [] ) {
        $defaults = [
            'post_type'      => 'property',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];

        $args = wp_parse_args( $args, $defaults );
        return get_posts( $args );
    }

    /**
     * Handle property contact form submission
     */
    public static function handle_property_contact() {
        // Verify nonce
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'gbc_property_contact' ) ) {
            wp_send_json_error( 'Security check failed' );
        }

        // Get and sanitize data
        $property_id = isset( $_POST['property_id'] ) ? intval( $_POST['property_id'] ) : 0;
        $contact_name = isset( $_POST['contact_name'] ) ? sanitize_text_field( $_POST['contact_name'] ) : '';
        $contact_email = isset( $_POST['contact_email'] ) ? sanitize_email( $_POST['contact_email'] ) : '';
        $contact_phone = isset( $_POST['contact_phone'] ) ? sanitize_text_field( $_POST['contact_phone'] ) : '';
        $contact_message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( $_POST['contact_message'] ) : '';
        $contact_type = isset( $_POST['contact_type'] ) ? sanitize_text_field( $_POST['contact_type'] ) : 'tour';

        // Validate required fields
        if ( empty( $contact_name ) || empty( $contact_email ) || empty( $contact_message ) ) {
            wp_send_json_error( 'Please fill in all required fields' );
        }

        // Get property details
        $property = get_post( $property_id );
        if ( ! $property || $property->post_type !== 'property' ) {
            wp_send_json_error( 'Invalid property' );
        }

        // Get property information
        $address = get_post_meta( $property_id, 'property_address', true );
        $city = get_post_meta( $property_id, 'property_city', true );
        $property_type = get_post_meta( $property_id, 'property_type', true );
        $price = get_post_meta( $property_id, 'property_price', true );
        $rent_price = get_post_meta( $property_id, 'property_rent_price', true );
        $listing_type = get_post_meta( $property_id, 'property_listing_type', true ) ?: 'sale';

        // Get admin email
        $admin_email = get_option( 'admin_email' );

        // Compose email
        $subject = $contact_type === 'tour' 
            ? 'Tour Request: ' . $property->post_title 
            : 'Question About: ' . $property->post_title;

        $contact_type_text = $contact_type === 'tour' ? 'Schedule a Tour' : 'Ask a Question';
        $property_price = $listing_type === 'rent' ? $rent_price : $price;

        $message_body = sprintf(
            "New Property Inquiry - %s\n\n" .
            "Request Type: %s\n" .
            "Property: %s\n" .
            "Address: %s, %s\n" .
            "Price: %s\n\n" .
            "Customer Information:\n" .
            "Name: %s\n" .
            "Email: %s\n" .
            "Phone: %s\n\n" .
            "Message:\n%s\n\n" .
            "---\n" .
            "Property Link: %s\n",
            date( 'Y-m-d H:i:s' ),
            $contact_type_text,
            $property->post_title,
            $address,
            $city,
            $property_price,
            $contact_name,
            $contact_email,
            $contact_phone,
            $contact_message,
            get_permalink( $property_id )
        );

        $headers = [
            'From: ' . $contact_name . ' <' . $contact_email . '>',
            'Reply-To: ' . $contact_email,
            'Content-Type: text/plain; charset=UTF-8',
        ];

        // Send email
        $email_sent = wp_mail( $admin_email, $subject, $message_body, $headers );

        if ( $email_sent ) {
            // Also send confirmation to user
            $user_subject = 'We received your inquiry about ' . $property->post_title;
            $user_message = sprintf(
                "Hello %s,\n\n" .
                "Thank you for your interest in %s.\n\n" .
                "We have received your %s request and will contact you shortly at %s.\n\n" .
                "Best regards,\n" .
                "Mike K Realtor",
                $contact_name,
                $property->post_title,
                strtolower( $contact_type_text ),
                $contact_phone ?: $contact_email
            );

            wp_mail( $contact_email, $user_subject, $user_message );

            wp_send_json_success( 'Message sent successfully!' );
        } else {
            wp_send_json_error( 'Failed to send message. Please try again.' );
        }
    }
}
