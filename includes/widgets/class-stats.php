<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_Stats_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-stats';
    }

    public function get_title() {
        return __( 'GBC Stats Section', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-counter';
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

        // Stats Repeater
        $repeater = new Repeater();

        $repeater->add_control(
            'stat_number',
            [
                'label'   => __( 'Stat Number', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '930+',
            ]
        );

        $repeater->add_control(
            'stat_label',
            [
                'label'   => __( 'Stat Label', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Placements',
            ]
        );

        $this->add_control(
            'stats',
            [
                'label'   => __( 'Statistics', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'stat_number' => '930+',
                        'stat_label' => 'Placements',
                    ],
                    [
                        'stat_number' => '640k',
                        'stat_label' => 'Candidates',
                    ],
                    [
                        'stat_number' => '56',
                        'stat_label' => 'Countries',
                    ],
                    [
                        'stat_number' => '98%',
                        'stat_label' => 'Retention',
                    ],
                ],
                'title_field' => '{{{ stat_number }}}',
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
        <div class="py-20 bg-text relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-x divide-white/10">
                    <?php foreach ( $settings['stats'] as $stat ) : ?>
                        <div class="p-4">
                            <div class="text-4xl lg:text-5xl font-display font-medium text-white mb-3"><?php echo esc_html( $stat['stat_number'] ); ?></div>
                            <div class="text-xs text-primary uppercase tracking-[0.2em] font-semibold"><?php echo esc_html( $stat['stat_label'] ); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }
}

