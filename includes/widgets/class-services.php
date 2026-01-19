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
                'default' => 'Core Disciplines',
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label'   => __( 'Section Description', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'Our expertise spans across critical technology vectors, enabling us to pinpoint talent that drives innovation.',
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
                        'service_icon' => 'public',
                        'service_title' => 'Global Localization',
                        'service_description' => 'Connecting tech leads capable of bridging markets between Japan, Europe, and the US.',
                        'service_link_text' => 'Learn More',
                        'service_link_url' => [ 'url' => '#' ],
                    ],
                    [
                        'service_icon' => 'analytics',
                        'service_title' => 'Technical SEO',
                        'service_description' => 'Finding the rare blend of technical prowess and marketing acumen for growth roles.',
                        'service_link_text' => 'Learn More',
                        'service_link_url' => [ 'url' => '#' ],
                    ],
                    [
                        'service_icon' => 'smartphone',
                        'service_title' => 'Mobile Development',
                        'service_description' => 'Sourcing architects for high-scale iOS and Android ecosystems.',
                        'service_link_text' => 'Learn More',
                        'service_link_url' => [ 'url' => '#' ],
                    ],
                    [
                        'service_icon' => 'ads_click',
                        'service_title' => 'Performance Marketing',
                        'service_description' => 'Data-driven leaders for Google Ads, Social, and programmatic campaigns.',
                        'service_link_text' => 'Learn More',
                        'service_link_url' => [ 'url' => '#' ],
                    ],
                    [
                        'service_icon' => 'diversity_3',
                        'service_title' => 'Community Mgmt',
                        'service_description' => 'Bilingual managers to foster engagement in global Web3 and Tech communities.',
                        'service_link_text' => 'Learn More',
                        'service_link_url' => [ 'url' => '#' ],
                    ],
                    [
                        'service_icon' => 'link',
                        'service_title' => 'Backlink & Outreach',
                        'service_description' => 'Specialists in building high-authority digital footprints for enterprise brands.',
                        'service_link_text' => 'Learn More',
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

        ?>
        <section class="py-32 bg-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
                    <div>
                        <h2 class="font-display text-4xl md:text-5xl text-text mb-6"><?php echo esc_html( $settings['section_title'] ); ?></h2>
                        <p class="text-gray-500 max-w-xl font-light text-lg"><?php echo esc_html( $settings['section_description'] ); ?></p>
                    </div>
                    <div class="hidden md:block">
                        <a class="group inline-flex items-center gap-2 text-primary font-bold uppercase text-xs tracking-widest border-b border-primary/30 pb-1 hover:text-primary-dark transition-colors" href="#">
                            View All Categories <span class="material-symbols-outlined text-base group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ( $settings['services'] as $service ) : ?>
                        <a class="group relative p-8 bg-[#FAFAFA] rounded-2xl border border-gray-100 hover:bg-text hover:border-text transition-all duration-300 flex flex-col justify-between min-h-[280px]" href="#">
                            <div class="flex justify-between items-start w-full mb-6">
                                <div class="w-10 h-10 flex items-center justify-center text-primary bg-white rounded-full shadow-sm group-hover:bg-white/10 group-hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-xl"><?php echo esc_attr( $service['service_icon'] ); ?></span>
                                </div>
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="material-symbols-outlined text-gray-700 text-6xl group-hover:text-white/5"><?php echo esc_attr( $service['service_icon'] ); ?></span>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-display text-2xl text-text mb-3 group-hover:text-white transition-colors"><?php echo esc_html( $service['service_title'] ); ?></h3>
                                <p class="text-sm text-gray-500 mb-6 leading-relaxed group-hover:text-gray-400"><?php echo esc_html( $service['service_description'] ); ?></p>
                                <div class="w-8 h-[2px] bg-gray-200 group-hover:bg-primary transition-colors"></div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
