<?php
/**
 * Plugin Name: Elementor Widgets
 * Description: Custom Elementor widgets built by GBCodies for MikeKRealtor.
 * Version: 1.1.0
 * Author: GBCodies
 * Author URI: https://gbcodies.com
 * Text Domain: gbc-elementor-widgets
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Define plugin constants
define( 'GBC_EW_VERSION', '1.1.0' );
define( 'GBC_EW_FILE', __FILE__ );
define( 'GBC_EW_PATH', plugin_dir_path( __FILE__ ) );
define( 'GBC_EW_URL', plugin_dir_url( __FILE__ ) );

// Load plugin class
require_once GBC_EW_PATH . 'includes/class-plugin.php';
require_once GBC_EW_PATH . 'includes/class-properties.php';
require_once GBC_EW_PATH . 'includes/class-property-metabox.php';

/**
 * Plugin activation hook - flush rewrite rules
 */
register_activation_hook( __FILE__, function() {
    // Trigger post type registration
    GBC_EW_Properties::register_post_type();
    GBC_EW_Properties::register_taxonomy();
    
    // Flush rewrite rules
    flush_rewrite_rules();
});

/**
 * Initialize the plugin on plugins_loaded hook
 * This ensures WordPress is fully initialized
 */
add_action( 'plugins_loaded', function() {
    // Initialize Properties Post Type
    GBC_EW_Properties::init();
    
    // Initialize Property Metabox
    GBC_EW_Property_Metabox::init();
    
    // Check if Elementor exists
    if ( ! did_action( 'elementor/loaded' ) && ! class_exists( '\Elementor\Plugin' ) ) {
        // Elementor not loaded, try again later
        return;
    }
    
    // Initialize plugin
    GBC_EW_Plugin::init();
}, 20 );

/**
 * Fallback: Also try on elementor/loaded
 */
add_action( 'elementor/loaded', function() {
    if ( ! did_action( 'gbc_ew_initialized' ) ) {
        GBC_EW_Plugin::init();
    }
}, 10 );

/**
 * Enqueue global styles in frontend
 */
add_action( 'wp_enqueue_scripts', function() {
    // Enqueue Tailwind CSS from CDN as a script (needs to be script, not stylesheet)
    wp_enqueue_script(
        'tailwindcss',
        'https://cdn.tailwindcss.com?plugins=forms,typography',
        [],
        '3.0',
        false
    );

    // Enqueue Google Fonts
    wp_enqueue_style(
        'google-fonts-manrope',
        'https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap',
        [],
        '1.0',
        'all'
    );

    wp_enqueue_style(
        'google-fonts-plus',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
        [],
        '1.0',
        'all'
    );

    // Enqueue Material Symbols Outlined
    wp_enqueue_style(
        'material-symbols-outlined',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap',
        [],
        '1.0',
        'all'
    );

    // Enqueue Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        [],
        '6.4.0',
        'all'
    );

    // Enqueue custom CSS (this will load after fonts and icons)
    wp_enqueue_style(
        'gbc-ew-frontend',
        GBC_EW_URL . 'assets/css/frontend.css',
        [ 'google-fonts-manrope', 'google-fonts-plus', 'material-symbols-outlined', 'font-awesome' ],
        GBC_EW_VERSION,
        'all'
    );

    // Enqueue custom JavaScript
    wp_enqueue_script(
        'gbc-ew-frontend',
        GBC_EW_URL . 'assets/js/frontend.js',
        [ 'jquery' ],
        GBC_EW_VERSION,
        true
    );

    // Localize script variables
    wp_localize_script(
        'gbc-ew-frontend',
        'gbc_contact_nonce',
        wp_create_nonce( 'gbc_contact_nonce' )
    );
    wp_localize_script(
        'gbc-ew-frontend',
        'ajaxurl',
        admin_url( 'admin-ajax.php' )
    );

    // Inline Tailwind configuration - runs after Tailwind loads
    wp_add_inline_script(
        'tailwindcss',
        "
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof tailwind !== 'undefined') {
                tailwind.config = {
                    darkMode: 'class',
                    theme: {
                        extend: {
                            colors: {
                                primary: '#5A1E96',
                                secondary: '#8B5CF6',
                                accent: '#E9D8FD',
                                'background-light': '#FDFBFD',
                                'background-dark': '#0F0A15',
                                'surface-light': '#FFFFFF',
                                'surface-dark': '#1A1523',
                                'text-light': '#1A202C',
                                'text-dark': '#E2E8F0',
                                'accent-gray': '#F8FAFC',
                                'accent-dark-gray': '#231E2E'
                            },
                            fontFamily: {
                                display: ['Manrope', 'sans-serif'],
                                sans: [\"'Plus Jakarta Sans'\", 'sans-serif']
                            },
                            backgroundImage: {
                                'hero-gradient': 'linear-gradient(135deg, #0F0518 0%, #2E1065 100%)',
                                'purple-gradient': 'linear-gradient(135deg, #6B21A8 0%, #A855F7 100%)',
                                'card-gradient': 'linear-gradient(180deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 100%)'
                            },
                            boxShadow: {
                                'glow': '0 0 20px rgba(139, 92, 246, 0.3)',
                                'card': '0 10px 30px -5px rgba(0, 0, 0, 0.05)'
                            }
                        }
                    }
                };
            }
        });
        "
    );
}, 999 );

