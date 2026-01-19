<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_Hero_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-hero';
    }

    public function get_title() {
        return __( 'GBC Hero Section', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    public function get_style_depends() {
        return [ 'gbc-ew-frontend' ];
    }

    public function get_script_depends() {
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
            'badge_text',
            [
                'label'   => __( 'Badge Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Premium IT Recruitment',
            ]
        );

        $this->add_control(
            'heading_part1',
            [
                'label'   => __( 'Heading Part 1', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Elevating',
            ]
        );

        $this->add_control(
            'heading_part2',
            [
                'label'   => __( 'Heading Part 2 (Gradient)', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Digital Leadership',
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => __( 'Description', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => 'We architect the future of organizations by connecting visionary enterprises with elite technology executives through a bespoke, high-touch consultancy.',
            ]
        );

        // Primary Button
        $this->add_control(
            'button_text',
            [
                'label'   => __( 'Primary Button Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Find a Job Now',
            ]
        );

        $this->add_control(
            'button_url',
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
                'default' => 'View Opportunities',
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

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'gbc-elementor-widgets' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'hero_bg',
                'selector' => '{{WRAPPER}} .gbc-hero',
                'default' => 'gradient',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        wp_enqueue_style( 'gbc-ew-frontend' );
        wp_enqueue_script( 'gbc-ew-frontend' );

        ?>
        <section class="relative pt-40 pb-24 lg:pt-52 lg:pb-32 overflow-hidden bg-background">
            <div class="absolute top-0 left-0 w-full h-full pointer-events-none z-0">
                <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-[#E6C88B]/10 rounded-full blur-[120px] opacity-60"></div>
                <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-gray-200/40 rounded-full blur-[100px] opacity-50"></div>
            </div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 border border-primary/20 rounded-full mb-8 bg-white shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                    <span class="text-primary-dark text-xs font-semibold uppercase tracking-widest"><?php echo esc_html( $settings['badge_text'] ); ?></span>
                </div>
                <h1 class="font-display text-5xl md:text-7xl lg:text-8xl font-medium text-text leading-[1.1] mb-8 tracking-tight">
                    <?php echo esc_html( $settings['heading_part1'] ); ?> <br/>
                    <span class="text-gold-gradient italic pr-2"><?php echo esc_html( $settings['heading_part2'] ); ?></span>
                </h1>
                <p class="mt-6 max-w-2xl mx-auto text-lg md:text-xl text-gray-600 font-light leading-relaxed">
                    <?php echo esc_html( $settings['description'] ); ?>
                </p>
                <div class="mt-20 max-w-5xl mx-auto">
                    <div class="relative grid md:grid-cols-2 gap-8">
                        <div class="group relative p-10 md:p-14 bg-surface rounded-[2.5rem] shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 cursor-pointer overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-bl-[4rem] -mr-8 -mt-8 transition-all group-hover:bg-primary/5"></div>
                            <div class="flex flex-col items-center relative z-10">
                                <div class="mb-6 p-5 rounded-full bg-gray-50 text-gray-400 group-hover:bg-primary group-hover:text-white transition-all duration-300 shadow-inner">
                                    <span class="material-symbols-outlined text-3xl">person</span>
                                </div>
                                <h3 class="font-display text-3xl text-text mb-3">For Candidates</h3>
                                <p class="text-sm text-gray-500 mb-8 leading-relaxed max-w-xs mx-auto text-center">
                                    Discover exclusive opportunities that align with your career trajectory.
                                </p>
                                <span class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center group-hover:border-primary group-hover:text-primary transition-all">
                                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                                </span>
                            </div>
                        </div>
                        <div class="group relative p-10 md:p-14 bg-text rounded-[2.5rem] shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 cursor-pointer overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-bl-[4rem] -mr-8 -mt-8 transition-all group-hover:bg-primary/20"></div>
                            <div class="flex flex-col items-center relative z-10">
                                <div class="mb-6 p-5 rounded-full bg-white/10 text-white/70 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                    <span class="material-symbols-outlined text-3xl">business</span>
                                </div>
                                <h3 class="font-display text-3xl text-white mb-3">For Organizations</h3>
                                <p class="text-sm text-white/60 mb-8 leading-relaxed max-w-xs mx-auto text-center">
                                    Access a curated network of vetted technology leaders ready to drive impact.
                                </p>
                                <span class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white group-hover:border-primary group-hover:bg-primary transition-all">
                                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 text-center">
                        <a class="text-sm text-gray-500 hover:text-primary transition-colors border-b border-gray-300 hover:border-primary pb-0.5" href="#">View current open roles directly</a>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

