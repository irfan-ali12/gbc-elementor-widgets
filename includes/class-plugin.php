<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * GBC Elementor Widgets Plugin Class
 */
class GBC_EW_Plugin {

    /**
     * Initialize the plugin
     */
    public static function init() {
        // Prevent double initialization
        if ( did_action( 'gbc_ew_initialized' ) ) {
            return;
        }

        // Load textdomain
        self::load_textdomain();

        // Register assets
        self::register_assets();

        // Register widget hook
        add_action( 'elementor/widgets/register', [ __CLASS__, 'register_widgets' ], 10, 1 );

        // Register AJAX handlers
        add_action( 'wp_ajax_gbc_contact_form_submit', [ __CLASS__, 'handle_contact_form' ] );
        add_action( 'wp_ajax_nopriv_gbc_contact_form_submit', [ __CLASS__, 'handle_contact_form' ] );

        // Mark as initialized
        do_action( 'gbc_ew_initialized' );
    }

    /**
     * Load plugin textdomain
     */
    public static function load_textdomain() {
        load_plugin_textdomain(
            'gbc-elementor-widgets',
            false,
            dirname( plugin_basename( GBC_EW_FILE ) ) . '/languages'
        );
    }

    /**
     * Register CSS and JS assets
     */
    public static function register_assets() {
        // Register Tailwind CSS from CDN first
        wp_register_style(
            'tailwindcss',
            'https://cdn.tailwindcss.com?plugins=forms,typography',
            [],
            '3.0',
            'all'
        );

        // Register Google Fonts
        wp_register_style(
            'google-fonts-manrope',
            'https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap',
            [],
            '1.0',
            'all'
        );

        wp_register_style(
            'google-fonts-plus',
            'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
            [],
            '1.0',
            'all'
        );

        wp_register_style(
            'google-fonts-probate',
            'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@500;600;700;800&display=swap',
            [],
            '1.0',
            'all'
        );

        // Register Material Symbols Outlined
        wp_register_style(
            'material-symbols-outlined',
            'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap',
            [],
            '1.0',
            'all'
        );

        // Register Font Awesome
        wp_register_style(
            'font-awesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
            [],
            '6.4.0',
            'all'
        );

        // Register custom frontend CSS
        wp_register_style(
            'gbc-ew-frontend',
            GBC_EW_URL . 'assets/css/frontend.css',
            [
                'tailwindcss',
                'google-fonts-manrope',
                'google-fonts-plus',
                'material-symbols-outlined',
                'font-awesome'
            ],
            GBC_EW_VERSION,
            'all'
        );

        wp_register_style(
            'gbc-ew-probate-pages',
            GBC_EW_URL . 'assets/css/probate-pages.css',
            [ 'google-fonts-probate' ],
            GBC_EW_VERSION,
            'all'
        );

        // Register frontend JS
        wp_register_script(
            'gbc-ew-frontend',
            GBC_EW_URL . 'assets/js/frontend.js',
            [ 'jquery' ],
            GBC_EW_VERSION,
            true
        );

        // Localize script with nonce and ajaxurl
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

        // Enqueue Tailwind config inline
        add_action( 'wp_head', [ __CLASS__, 'enqueue_tailwind_config' ] );
    }

    /**
     * Enqueue Tailwind configuration
     */
    public static function enqueue_tailwind_config() {
        ?>
        <script>
            if (window.tailwind) {
                window.tailwind.config = {
                    darkMode: "class",
                    theme: {
                        extend: {
                            colors: {
                                primary: "#5A1E96",
                                secondary: "#8B5CF6",
                                accent: "#E9D8FD",
                                "background-light": "#FDFBFD",
                                "background-dark": "#0F0A15",
                                "surface-light": "#FFFFFF",
                                "surface-dark": "#1A1523",
                                "text-light": "#1A202C",
                                "text-dark": "#E2E8F0",
                                "accent-gray": "#F8FAFC",
                                "accent-dark-gray": "#231E2E"
                            },
                            fontFamily: {
                                display: ["Manrope", "sans-serif"],
                                sans: ["'Plus Jakarta Sans'", "sans-serif"]
                            },
                            backgroundImage: {
                                "hero-gradient": "linear-gradient(135deg, #0F0518 0%, #2E1065 100%)",
                                "purple-gradient": "linear-gradient(135deg, #6B21A8 0%, #A855F7 100%)",
                                "card-gradient": "linear-gradient(180deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 100%)"
                            },
                            boxShadow: {
                                'glow': '0 0 20px rgba(139, 92, 246, 0.3)',
                                'card': '0 10px 30px -5px rgba(0, 0, 0, 0.05)'
                            }
                        }
                    }
                };
            }
        </script>
        <?php
    }

    /**
     * Register all widgets
     * 
     * @param object $widgets_manager Elementor widgets manager
     */
    public static function register_widgets( $widgets_manager ) {
        // Check if method exists
        if ( ! method_exists( $widgets_manager, 'register' ) ) {
            return;
        }

        // Define all widgets
        $widgets = [
            [
                'file'  => 'class-hero.php',
                'class' => 'GBC_EW_Hero_Widget',
            ],
            [
                'file'  => 'class-services.php',
                'class' => 'GBC_EW_Services_Widget',
            ],
            [
                'file'  => 'class-about.php',
                'class' => 'GBC_EW_About_Widget',
            ],
            [
                'file'  => 'class-properties.php',
                'class' => 'GBC_EW_Properties_Widget',
            ],
            [
                'file'  => 'class-cta.php',
                'class' => 'GBC_EW_CTA_Widget',
            ],
            [
                'file'  => 'class-testimonials.php',
                'class' => 'GBC_EW_Testimonials_Widget',
            ],
            [
                'file'  => 'class-about-hero.php',
                'class' => 'GBC_EW_About_Hero_Widget',
            ],
            [
                'file'  => 'class-about-badges.php',
                'class' => 'GBC_EW_About_Badges_Widget',
            ],
            [
                'file'  => 'class-about-philosophy.php',
                'class' => 'GBC_EW_About_Philosophy_Widget',
            ],
            [
                'file'  => 'class-about-cta.php',
                'class' => 'GBC_EW_About_CTA_Widget',
            ],
            [
                'file'  => 'class-contact.php',
                'class' => 'GBC_EW_Contact_Widget',
            ],
            [
                'file'  => 'class-probate-understanding.php',
                'class' => 'GBC_EW_Probate_Understanding_Widget',
            ],
            [
                'file'  => 'class-probate-selling.php',
                'class' => 'GBC_EW_Probate_Selling_Widget',
            ],
            [
                'file'  => 'class-probate-preparing.php',
                'class' => 'GBC_EW_Probate_Preparing_Widget',
            ],
        ];

        // Register each widget
        foreach ( $widgets as $widget ) {
            $file_path = GBC_EW_PATH . 'includes/widgets/' . $widget['file'];
            
            // Check file exists
            if ( ! file_exists( $file_path ) ) {
                continue;
            }

            // Load widget file
            require_once $file_path;

            // Check class exists
            if ( ! class_exists( $widget['class'] ) ) {
                continue;
            }

            // Register widget
            try {
                $widgets_manager->register( new $widget['class']() );
            } catch ( Exception $e ) {
                // Silently skip on error
                error_log( 'GBC Elementor Widget Error: ' . $e->getMessage() );
            }
        }
    }

    /**
     * Handle contact form submission via AJAX
     */
    public static function handle_contact_form() {
        // Verify nonce
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'gbc_contact_nonce' ) ) {
            wp_send_json_error( 'Invalid security token' );
        }

        // Sanitize and validate inputs
        $name = sanitize_text_field( $_POST['name'] ?? '' );
        $email = sanitize_email( $_POST['email'] ?? '' );
        $message = sanitize_textarea_field( $_POST['message'] ?? '' );
        $admin_email = sanitize_email( $_POST['admin_email'] ?? get_option( 'admin_email' ) );

        if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
            wp_send_json_error( 'Please fill in all fields' );
        }

        if ( ! is_email( $email ) ) {
            wp_send_json_error( 'Invalid email address' );
        }

        // Prepare email
        $subject = 'New Contact Form Submission from ' . $name;
        $body = "New contact form submission:\n\n";
        $body .= "Name: " . $name . "\n";
        $body .= "Email: " . $email . "\n";
        $body .= "Message:\n" . $message . "\n\n";
        $body .= "---\n";
        $body .= "Sent from contact form at " . get_site_url();

        $headers = array(
            'From: ' . $name . ' <' . $email . '>',
            'Reply-To: ' . $email,
            'Content-Type: text/plain; charset=UTF-8'
        );

        // Send email to admin
        $mail_sent = wp_mail( $admin_email, $subject, $body, $headers );

        if ( $mail_sent ) {
            // Send confirmation email to user
            $user_subject = 'We received your message - ' . get_bloginfo( 'name' );
            $user_body = "Hi " . $name . ",\n\n";
            $user_body .= "Thank you for reaching out! We received your message and will get back to you shortly.\n\n";
            $user_body .= "Best regards,\n";
            $user_body .= get_bloginfo( 'name' );

            wp_mail( $email, $user_subject, $user_body );

            wp_send_json_success( 'Message sent successfully' );
        } else {
            wp_send_json_error( 'Failed to send message. Please try again later.' );
        }
    }
}


