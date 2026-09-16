<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_Services_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-services';
    }

    public function get_title() {
        return __( 'GBC Services Section', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-apps';
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
            'section_title',
            [
                'label'   => __( 'Section Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'How Can I Help You?',
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label'   => __( 'Section Description', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'Providing a comprehensive suite of real estate services tailored to your specific needs.',
            ]
        );

        // Services Repeater
        $repeater = new Repeater();

        $repeater->add_control(
            'service_icon',
            [
                'label'   => __( 'Icon (Material Symbols name)', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'home',
                'description' => __( 'Use Material Symbols names like: home, sell, trending_up, etc.', 'gbc-elementor-widgets' ),
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label'   => __( 'Service Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Buy a Home',
            ]
        );

        $repeater->add_control(
            'service_description',
            [
                'label'   => __( 'Service Description', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'Find your dream property with exclusive access to off-market listings and expert negotiation strategies tailored for you.',
            ]
        );

        $repeater->add_control(
            'service_link_text',
            [
                'label'   => __( 'Link Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Start Search',
            ]
        );

        $repeater->add_control(
            'service_link_url',
            [
                'label' => __( 'Link URL', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::URL,
                'default' => [ 'url' => '#' ],
            ]
        );

        $this->add_control(
            'services',
            [
                'label'   => __( 'Services', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'service_icon' => 'home',
                        'service_title' => 'Buy a Home',
                        'service_description' => 'Find your dream property with exclusive access to off-market listings and expert negotiation strategies tailored for you.',
                        'service_link_text' => 'Start Search',
                        'service_link_url' => [ 'url' => '#' ],
                    ],
                    [
                        'service_icon' => 'sell',
                        'service_title' => 'Sell Property',
                        'service_description' => 'Maximize your property\'s value with premium marketing, professional staging, and global exposure to qualified buyers.',
                        'service_link_text' => 'Get Valuation',
                        'service_link_url' => [ 'url' => '#' ],
                    ],
                    [
                        'service_icon' => 'trending_up',
                        'service_title' => 'Invest Wisely',
                        'service_description' => 'Build your portfolio with data-driven insights into emerging markets and high-yield investment opportunities.',
                        'service_link_text' => 'Explore Options',
                        'service_link_url' => [ 'url' => '#' ],
                    ],
                ],
                'title_field' => '{{{ service_title }}}',
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
            'card_columns',
            [
                'label'   => __( 'Columns', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => __( '1 Column', 'gbc-elementor-widgets' ),
                    '2' => __( '2 Columns', 'gbc-elementor-widgets' ),
                    '3' => __( '3 Columns', 'gbc-elementor-widgets' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        wp_enqueue_style( 'gbc-ew-frontend' );

        $columns = 'md:grid-cols-' . esc_attr( $settings['card_columns'] );
        ?>
        <section class="py-16 sm:py-20 lg:py-24 bg-background-light dark:bg-background-dark relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 sm:mb-16 lg:mb-20 relative">
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4"><?php echo esc_html( $settings['section_title'] ); ?></h2>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-base sm:text-lg"><?php echo esc_html( $settings['section_description'] ); ?></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-<?php echo intval( $settings['card_columns'] ); ?> gap-6 sm:gap-8">
                    <?php foreach ( $settings['services'] as $service ) : ?>
                        <div class="group relative bg-white dark:bg-surface-dark rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-10 shadow-card hover:shadow-glow transition-all duration-500 border border-gray-100 dark:border-white/5 hover:-translate-y-2">
                            <div class="w-14 h-14 sm:w-16 sm:h-16 bg-accent/20 dark:bg-primary/20 rounded-xl sm:rounded-2xl flex items-center justify-center mb-6 sm:mb-8 text-primary group-hover:bg-primary group-hover:text-white transition-all duration-500">
                                <span class="material-symbols-outlined text-2xl sm:text-3xl"><?php echo esc_attr( $service['service_icon'] ); ?></span>
                            </div>
                            <h3 class="font-display text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4"><?php echo esc_html( $service['service_title'] ); ?></h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6 sm:mb-8 leading-relaxed text-sm sm:text-base">
                                <?php echo esc_html( $service['service_description'] ); ?>
                            </p>
                            <?php if ( ! empty( $service['service_link_url']['url'] ) ) : ?>
                                <a style="color: #5A1E96 !important; text-decoration: none !important; border: none !important; background: none !important;" class="inline-flex items-center text-primary font-bold hover:text-secondary transition-colors text-sm sm:text-base" href="<?php echo esc_url( $service['service_link_url']['url'] ); ?>">
                                    <?php echo esc_html( $service['service_link_text'] ); ?> <i class="fas fa-arrow-right ml-2 text-xs sm:text-sm transform group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
