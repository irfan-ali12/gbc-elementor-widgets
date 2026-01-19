<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_About_Hero_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-about-hero';
    }

    public function get_title() {
        return __( 'GBC About Hero', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-image-box';
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
            'section_tag',
            [
                'label'   => __( 'Section Tag', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Meet Your Agent',
            ]
        );

        $this->add_control(
            'main_title_line1',
            [
                'label'   => __( 'Title Line 1', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'The Intersection of',
            ]
        );

        $this->add_control(
            'main_title_highlight1',
            [
                'label'   => __( 'Highlight Word 1 (e.g., Vision)', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Vision',
            ]
        );

        $this->add_control(
            'main_title_highlight2',
            [
                'label'   => __( 'Highlight Word 2 (e.g., Expertise)', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Expertise',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'   => __( 'Subtitle', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'More than a realtor, I am your strategic partner in building wealth and finding the perfect backdrop for your life\'s best moments.',
            ]
        );

        $this->add_control(
            'stat_1_number',
            [
                'label'   => __( 'Stat 1 - Number', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '15+',
            ]
        );

        $this->add_control(
            'stat_1_label',
            [
                'label'   => __( 'Stat 1 - Label', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Years Active',
            ]
        );

        $this->add_control(
            'stat_2_number',
            [
                'label'   => __( 'Stat 2 - Number', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '$500M',
            ]
        );

        $this->add_control(
            'stat_2_label',
            [
                'label'   => __( 'Stat 2 - Label', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Lifetime Sales',
            ]
        );

        $this->add_control(
            'stat_3_number',
            [
                'label'   => __( 'Stat 3 - Number', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Top 1%',
            ]
        );

        $this->add_control(
            'stat_3_label',
            [
                'label'   => __( 'Stat 3 - Label', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Nationwide',
            ]
        );

        $this->add_control(
            'profile_image',
            [
                'label'   => __( 'Profile Image', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [],
            ]
        );

        $this->add_control(
            'profile_name',
            [
                'label'   => __( 'Profile Name', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Mike K.',
            ]
        );

        $this->add_control(
            'profile_title',
            [
                'label'   => __( 'Profile Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Senior Partner, KW Pasadena',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        wp_enqueue_style( 'gbc-ew-frontend' );
        ?>
        <section class="pt-40 pb-16 md:pt-48 md:pb-24 bg-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-subtle-pattern opacity-60 pointer-events-none"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                    <!-- Left Content -->
                    <div class="lg:col-span-6 space-y-8">
                        <!-- Tag -->
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-50 border border-purple-100 text-primary text-xs font-bold tracking-widest uppercase">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            <?php echo esc_html( $settings['section_tag'] ); ?>
                        </div>

                        <!-- Title with Gradients -->
                        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                            <?php echo esc_html( $settings['main_title_line1'] ); ?> <br/>
                            <span class="text-gradient"><?php echo esc_html( $settings['main_title_highlight1'] ); ?></span> and <span class="text-gradient"><?php echo esc_html( $settings['main_title_highlight2'] ); ?></span>.
                        </h1>

                        <!-- Subtitle -->
                        <p class="text-xl text-gray-500 font-light leading-relaxed max-w-lg">
                            <?php echo esc_html( $settings['subtitle'] ); ?>
                        </p>

                        <!-- Stats -->
                        <div class="flex flex-wrap gap-6 pt-4">
                            <div class="flex flex-col">
                                <span class="font-display text-3xl font-bold text-gray-900"><?php echo esc_html( $settings['stat_1_number'] ); ?></span>
                                <span class="text-sm text-gray-500 font-medium"><?php echo esc_html( $settings['stat_1_label'] ); ?></span>
                            </div>
                            <div class="w-px h-12 bg-gray-200"></div>
                            <div class="flex flex-col">
                                <span class="font-display text-3xl font-bold text-gray-900"><?php echo esc_html( $settings['stat_2_number'] ); ?></span>
                                <span class="text-sm text-gray-500 font-medium"><?php echo esc_html( $settings['stat_2_label'] ); ?></span>
                            </div>
                            <div class="w-px h-12 bg-gray-200"></div>
                            <div class="flex flex-col">
                                <span class="font-display text-3xl font-bold text-gray-900"><?php echo esc_html( $settings['stat_3_number'] ); ?></span>
                                <span class="text-sm text-gray-500 font-medium"><?php echo esc_html( $settings['stat_3_label'] ); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Profile Image -->
                    <div class="lg:col-span-6 relative">
                        <div class="absolute -top-12 -right-12 w-64 h-64 bg-accent/30 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-secondary/10 rounded-full blur-3xl"></div>
                        
                        <?php if ( ! empty( $settings['profile_image']['url'] ) ) : ?>
                            <div class="relative rounded-2xl overflow-hidden border border-gray-100 shadow-2xl bg-white max-w-md mx-auto lg:ml-auto transform rotate-2 hover:rotate-0 transition-transform duration-700">
                                <img alt="Profile" class="w-full h-full object-cover object-center grayscale hover:grayscale-0 transition-all duration-700" src="<?php echo esc_url( $settings['profile_image']['url'] ); ?>" />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                <div class="absolute bottom-6 left-6 text-white">
                                    <p class="font-display font-bold text-lg mb-0.5"><?php echo esc_html( $settings['profile_name'] ); ?></p>
                                    <p class="text-sm text-white/80 font-light"><?php echo esc_html( $settings['profile_title'] ); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
