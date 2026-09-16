<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_CTA_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-cta';
    }

    public function get_title() {
        return __( 'GBC CTA Section', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_style_depends() {
        return [ 'gbc-ew-frontend' ];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'gbc-elementor-widgets' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'cta_title',
            [
                'label'   => __( 'Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Ready to Find Your Way Home?',
            ]
        );

        $this->add_control(
            'cta_subtitle',
            [
                'label'   => __( 'Subtitle', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'Let\'s discuss your goals. Whether you\'re buying, selling, or just curious about the market, I\'m here to provide honest, expert advice.',
            ]
        );

        // Primary Button
        $this->add_control(
            'primary_button_text',
            [
                'label'   => __( 'Primary Button Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Schedule a Free Consultation',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'primary_button_url',
            [
                'label' => __( 'Primary Button URL', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::URL,
                'default' => [ 'url' => '#' ],
            ]
        );

        // Secondary Button
        $this->add_control(
            'secondary_button_text',
            [
                'label'   => __( 'Secondary Button Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Download Buyers Guide',
            ]
        );

        $this->add_control(
            'secondary_button_url',
            [
                'label' => __( 'Secondary Button URL', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::URL,
                'default' => [ 'url' => '#' ],
            ]
        );

        // Mascot Image
        $this->add_control(
            'mascot_image',
            [
                'label'   => __( 'Mascot/Decorative Image', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'gbc-elementor-widgets' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_layout',
            [
                'label'   => __( 'Button Layout', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'row',
                'options' => [
                    'row' => __( 'Horizontal', 'gbc-elementor-widgets' ),
                    'column' => __( 'Vertical', 'gbc-elementor-widgets' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        wp_enqueue_style( 'gbc-ew-frontend' );

        $button_direction = ( $settings['button_layout'] === 'column' ) ? 'flex-col' : 'sm:flex-row';
        ?>
        <section class="relative py-12 sm:py-16 lg:py-24 overflow-hidden bg-primary">
            <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary to-[#2E1065] opacity-100"></div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
            <div class="absolute right-0 bottom-0 opacity-10 transform translate-y-1/4 translate-x-1/4 pointer-events-none hidden md:block">
                <div class="w-64 sm:w-80 md:w-96 h-64 sm:h-80 md:h-96 bg-white rounded-full blur-[80px] sm:blur-[100px]"></div>
            </div>

            <?php if ( ! empty( $settings['mascot_image']['url'] ) ) : ?>
                <div class="absolute -top-8 sm:-top-12 md:-top-16 left-1/2 transform -translate-x-1/2 w-12 sm:w-16 md:w-20 opacity-90 hover:opacity-100 transition-opacity duration-300 z-10 pointer-events-none">
                    <img alt="Mascot" class="w-full h-auto drop-shadow-lg mascot-float" src="<?php echo esc_url( $settings['mascot_image']['url'] ); ?>" />
                </div>
            <?php endif; ?>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <div class="mx-auto w-12 h-12 sm:w-16 sm:h-16 lg:w-20 lg:h-20 bg-white/10 rounded-full flex items-center justify-center mb-4 sm:mb-6 lg:mb-8 backdrop-blur-md border border-white/20 shadow-glow">
                    <i class="fas fa-key text-white text-lg sm:text-2xl lg:text-3xl"></i>
                </div>

                <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold text-white mb-4 sm:mb-6 lg:mb-8 tracking-tight">
                    <?php echo esc_html( $settings['cta_title'] ); ?>
                </h2>

                <p class="text-sm sm:text-base lg:text-lg xl:text-xl text-purple-100 mb-8 sm:mb-12 lg:mb-16 max-w-2xl mx-auto font-light leading-relaxed px-2 sm:px-0">
                    <?php echo esc_html( $settings['cta_subtitle'] ); ?>
                </p>

                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 lg:gap-6 justify-center mt-6 sm:mt-8 lg:mt-10 px-2 sm:px-0">
                    <?php if ( ! empty( $settings['primary_button_url']['url'] ) ) : ?>
                        <a href="<?php echo esc_url( $settings['primary_button_url']['url'] ); ?>" class="px-6 sm:px-8 lg:px-10 py-2.5 sm:py-3 lg:py-4 bg-white text-primary font-bold text-sm sm:text-base lg:text-lg rounded-lg sm:rounded-xl shadow-xl hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300 inline-block whitespace-nowrap">
                            <?php echo esc_html( $settings['primary_button_text'] ); ?>
                        </a>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['secondary_button_url']['url'] ) ) : ?>
                        <a href="<?php echo esc_url( $settings['secondary_button_url']['url'] ); ?>" class="px-6 sm:px-8 lg:px-10 py-2.5 sm:py-3 lg:py-4 bg-transparent border-2 border-white/30 text-white font-bold text-sm sm:text-base lg:text-lg rounded-lg sm:rounded-xl hover:bg-white/10 hover:-translate-y-1 transition-all duration-300 backdrop-blur-sm inline-block whitespace-nowrap">
                            <?php echo esc_html( $settings['secondary_button_text'] ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
