<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_About_Badges_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-about-badges';
    }

    public function get_title() {
        return __( 'GBC About Badges Section', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-featured-image';
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

        // Badges Repeater
        $repeater = new Repeater();

        $repeater->add_control(
            'badge_icon',
            [
                'label'   => __( 'Icon (Material Icons name)', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'award_star',
                'description' => __( 'Use Material Icons names', 'gbc-elementor-widgets' ),
            ]
        );

        $repeater->add_control(
            'badge_title',
            [
                'label'   => __( 'Badge Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Award Winning',
            ]
        );

        $repeater->add_control(
            'badge_subtitle',
            [
                'label'   => __( 'Badge Subtitle', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Consistent Top Producer',
            ]
        );

        $this->add_control(
            'badges',
            [
                'label'   => __( 'Badges', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'badge_icon' => 'award_star',
                        'badge_title' => 'Award Winning',
                        'badge_subtitle' => 'Consistent Top Producer',
                    ],
                    [
                        'badge_icon' => 'location_city',
                        'badge_title' => 'Pasadena Native',
                        'badge_subtitle' => 'Deep Local Roots',
                    ],
                    [
                        'badge_icon' => 'verified',
                        'badge_title' => 'Certified Luxury',
                        'badge_subtitle' => 'Marketing Specialist',
                    ],
                    [
                        'badge_icon' => 'handshake',
                        'badge_title' => 'Master Negotiator',
                        'badge_subtitle' => 'Strategic Advocacy',
                    ],
                ],
                'title_field' => '{{{ badge_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        wp_enqueue_style( 'gbc-ew-frontend' );
        ?>
        <section class="border-y border-gray-100 bg-gray-50/50 dark:border-white/10 dark:bg-surface-dark/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <?php foreach ( $settings['badges'] as $badge ) : ?>
                        <div class="flex items-start gap-3">
                            <div class="w-12 h-12 rounded-xl bg-white dark:bg-surface-dark shadow-sm flex items-center justify-center text-primary flex-shrink-0">
                                <span class="material-symbols-outlined text-xl"><?php echo esc_attr( $badge['badge_icon'] ); ?></span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 dark:text-white text-sm mb-0.5"><?php echo esc_html( $badge['badge_title'] ); ?></h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo esc_html( $badge['badge_subtitle'] ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
