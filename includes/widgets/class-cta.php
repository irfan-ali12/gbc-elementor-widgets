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
                'default' => 'Ready to define what\'s next?',
            ]
        );

        $this->add_control(
            'cta_subtitle',
            [
                'label'   => __( 'Subtitle', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'Whether you are looking to hire or looking to be hired, we are your partner in success.',
            ]
        );

        // Primary Button
        $this->add_control(
            'primary_button_text',
            [
                'label'   => __( 'Primary Button Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Start Hiring',
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
                'default' => 'Contact Team',
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

        // Contact Image
        $this->add_control(
            'contact_image',
            [
                'label'   => __( 'Contact Image', 'gbc-elementor-widgets' ),
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

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        wp_enqueue_style( 'gbc-ew-frontend' );

        ?>
        <section class="py-32 relative bg-background overflow-hidden">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-white skew-x-12 translate-x-32 z-0 shadow-[-20px_0_40px_-10px_rgba(0,0,0,0.05)]"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col md:flex-row items-center justify-between gap-16">
                    <div class="md:w-1/2">
                        <h2 class="font-display text-4xl md:text-5xl font-medium text-text mb-6 leading-tight">
                            <?php echo esc_html( $settings['cta_title'] ); ?> <br/>
                            <span class="text-primary-dark">what's next?</span>
                        </h2>
                        <p class="text-lg text-gray-500 mb-10 max-w-lg font-light">
                            <?php echo esc_html( $settings['cta_subtitle'] ); ?>
                        </p>
                        <div class="flex flex-col sm:flex-row gap-6">
                            <?php if ( ! empty( $settings['primary_button_url']['url'] ) ) : ?>
                                <button class="px-8 py-4 bg-primary text-white font-bold uppercase tracking-widest text-xs hover:bg-text hover:text-white rounded-full transition-all duration-300 shadow-lg">
                                    <a style="text-decoration: none; color: inherit;" href="<?php echo esc_url( $settings['primary_button_url']['url'] ); ?>">
                                        <?php echo esc_html( $settings['primary_button_text'] ); ?>
                                    </a>
                                </button>
                            <?php endif; ?>
                            <?php if ( ! empty( $settings['secondary_button_url']['url'] ) ) : ?>
                                <button class="px-8 py-4 bg-transparent border border-gray-300 text-text font-bold uppercase tracking-widest text-xs hover:border-primary hover:text-primary rounded-full transition-all duration-300">
                                    <a style="text-decoration: none; color: inherit;" href="<?php echo esc_url( $settings['secondary_button_url']['url'] ); ?>">
                                        <?php echo esc_html( $settings['secondary_button_text'] ); ?>
                                    </a>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="md:w-1/2 flex justify-center md:justify-end">
                        <div class="relative w-full max-w-sm group">
                            <div class="absolute -inset-4 border border-primary/20 rounded-full group-hover:scale-105 transition-transform duration-700"></div>
                            <div class="absolute -inset-8 border border-primary/10 rounded-full group-hover:scale-110 transition-transform duration-700 delay-75"></div>
                            <div class="relative rounded-full overflow-hidden aspect-square border-4 border-white shadow-2xl">
                                <div class="absolute inset-0 bg-primary/20 mix-blend-multiply z-10"></div>
                                <?php if ( ! empty( $settings['contact_image']['url'] ) ) : ?>
                                    <img alt="Contact us" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" src="<?php echo esc_url( $settings['contact_image']['url'] ); ?>" />
                                <?php else : ?>
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-6xl text-gray-400">image</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
