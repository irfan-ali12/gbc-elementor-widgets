<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_About_CTA_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-about-cta';
    }

    public function get_title() {
        return __( 'GBC About CTA Section', 'gbc-elementor-widgets' );
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
            'main_title',
            [
                'label'   => __( 'Main Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Let\'s Find Your Perfect Home',
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => __( 'Description', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Ready to start your real estate journey? Let\'s talk about your goals.',
            ]
        );

        // CTA Buttons Repeater
        $repeater = new Repeater();

        $repeater->add_control(
            'button_text',
            [
                'label'   => __( 'Button Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Schedule a Consultation',
            ]
        );

        $repeater->add_control(
            'button_url',
            [
                'label'   => __( 'Button URL', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $repeater->add_control(
            'button_style',
            [
                'label'   => __( 'Button Style', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'solid'    => __( 'Solid (White)', 'gbc-elementor-widgets' ),
                    'glass'    => __( 'Glass Effect', 'gbc-elementor-widgets' ),
                ],
                'default' => 'solid',
            ]
        );

        $this->add_control(
            'buttons',
            [
                'label'   => __( 'CTA Buttons', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'button_text' => 'Schedule a Consultation',
                        'button_url' => '#',
                        'button_style' => 'solid',
                    ],
                    [
                        'button_text' => 'Send Message',
                        'button_url' => '#',
                        'button_style' => 'glass',
                    ],
                ],
                'title_field' => '{{{ button_text }}}',
            ]
        );

        $this->add_control(
            'mascot_image_url',
            [
                'label'   => __( 'Mascot Image URL', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'description' => __( 'Leave empty to hide mascot', 'gbc-elementor-widgets' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        wp_enqueue_style( 'gbc-ew-frontend' );
        ?>
        <section class="py-16 bg-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="relative bg-purple-gradient rounded-[2.5rem] p-10 md:p-16 shadow-2xl overflow-hidden flex flex-col md:flex-row items-center justify-between">
                    <!-- Pattern Overlay -->
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay z-0"></div>
                    
                    <!-- Blur Decoration -->
                    <div class="absolute top-0 right-0 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>

                    <!-- Left Content -->
                    <div class="relative z-10 max-w-2xl text-center md:text-left mb-10 md:mb-0">
                        <h2 class="font-display text-3xl md:text-4xl font-bold text-white mb-6">
                            <?php echo wp_kses_post( $settings['main_title'] ); ?>
                        </h2>

                        <p class="text-lg text-purple-100 mb-8 font-light max-w-xl">
                            <?php echo wp_kses_post( $settings['description'] ); ?>
                        </p>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start mt-4">
                            <?php foreach ( $settings['buttons'] as $button ) : 
                                $url = $button['button_url']['url'] ?? '#';
                                $target = ( isset( $button['button_url']['is_external'] ) && $button['button_url']['is_external'] ) ? 'target="_blank"' : '';
                                $is_solid = $button['button_style'] === 'solid';
                            ?>
                                <a href="<?php echo esc_url( $url ); ?>" <?php echo $target; ?> class="inline-flex justify-center items-center px-8 py-3.5 border <?php echo $is_solid ? 'border-transparent text-primary bg-white hover:bg-gray-100 shadow-lg hover:shadow-xl hover:-translate-y-0.5' : 'border-white/30 text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm'; ?> text-base font-bold rounded-full transition-all">
                                    <?php echo esc_html( $button['button_text'] ); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Right Image (Mascot) -->
                    <?php if ( ! empty( $settings['mascot_image_url'] ) ) : ?>
                        <div class="relative z-10 w-48 md:w-56 lg:w-64 transform md:translate-y-10 lg:translate-y-6">
                            <img alt="Mascot" class="w-full h-auto drop-shadow-2xl" src="<?php echo esc_url( $settings['mascot_image_url'] ); ?>" />
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
