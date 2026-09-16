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
                'default' => 'Top 1% Realtor Nationwide',
            ]
        );

        $this->add_control(
            'heading_part1',
            [
                'label'   => __( 'Heading Part 1', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Your Vision,',
            ]
        );

        $this->add_control(
            'heading_part2',
            [
                'label'   => __( 'Heading Part 2 (Gradient)', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'My Expertise.',
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => __( 'Description', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => 'Navigating the luxury market with confidence. I deliver results-driven strategies tailored to your unique real estate goals with a personal, agency-level touch.',
            ]
        );

        // Primary Button
        $this->add_control(
            'button_text',
            [
                'label'   => __( 'Primary Button Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Book a Consultation',
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
                'default' => 'View Properties',
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

        // Hero Image
        $this->add_control(
            'hero_image',
            [
                'label'   => __( 'Hero Image (Right Side)', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [],
            ]
        );

        // Rating Badge
        $this->add_control(
            'rating_text',
            [
                'label'   => __( 'Rating Badge Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Top Rated Agent',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'rating_stars',
            [
                'label'   => __( 'Rating Stars (1-5)', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 5,
                'min'     => 1,
                'max'     => 5,
            ]
        );

        // Stats Section
        $this->add_control(
            'stats_heading',
            [
                'label' => __( 'Stats Section', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'stat_number',
            [
                'label'   => __( 'Number', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '15+',
            ]
        );

        $repeater->add_control(
            'stat_label',
            [
                'label'   => __( 'Label', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Years Exp.',
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
                        'stat_number' => '15+',
                        'stat_label' => 'Years Exp.',
                    ],
                    [
                        'stat_number' => '$250M',
                        'stat_label' => 'Volume Sold',
                    ],
                    [
                        'stat_number' => '500+',
                        'stat_label' => 'Clients',
                    ],
                ],
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
        <section class="gbc-hero relative min-h-screen flex items-center overflow-hidden pt-24 bg-background-dark">
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-hero-gradient opacity-95 z-10"></div>
                <?php if ( ! empty( $settings['hero_image']['url'] ) ) : ?>
                    <img alt="Hero Background" class="w-full h-full object-cover grayscale opacity-30" src="<?php echo esc_url( $settings['hero_image']['url'] ); ?>" />
                <?php endif; ?>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 w-full pt-10 pb-20">
                <div class="flex flex-col-reverse lg:flex-row items-center justify-between gap-8 lg:gap-12">
                    <div class="w-full lg:w-1/2 text-center lg:text-left space-y-6 lg:space-y-8">
                        <div class="inline-flex items-center gap-2 px-3 py-1 lg:px-4 lg:py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm self-center lg:self-start text-xs lg:text-xs">
                            <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                            <span class="font-semibold tracking-widest uppercase text-gray-300"><?php echo esc_html( $settings['badge_text'] ); ?></span>
                        </div>

                        <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold leading-tight text-white tracking-tight">
                            <?php echo esc_html( $settings['heading_part1'] ); ?> <br/>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary to-white"><?php echo esc_html( $settings['heading_part2'] ); ?></span>
                        </h1>

                        <p class="text-base sm:text-lg text-gray-400 max-w-xl mx-auto lg:mx-0 leading-relaxed font-light">
                            <?php echo esc_html( $settings['description'] ); ?>
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 sm:gap-5 justify-center lg:justify-start pt-4">
                            <?php if ( ! empty( $settings['button_url']['url'] ) ) : ?>
                                <a style="background: linear-gradient(135deg, #5A1E96 0%, #8B5CF6 100%) !important; color: white !important; border: none !important; text-decoration: none !important; padding: 0.75rem 2rem;" class="px-6 sm:px-8 py-3 sm:py-4 bg-purple-gradient text-white font-bold rounded-lg sm:rounded-xl shadow-glow hover:shadow-primary/60 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2 text-sm sm:text-base inline-block" href="<?php echo esc_url( $settings['button_url']['url'] ); ?>">
                                    <span><?php echo esc_html( $settings['button_text'] ); ?></span>
                                </a>
                            <?php endif; ?>

                            <?php if ( ! empty( $settings['secondary_button_url']['url'] ) ) : ?>
                                <a style="background-color: transparent !important; color: white !important; border: 1px solid rgba(255,255,255,0.2) !important; text-decoration: none !important; padding: 0.75rem 2rem;" class="px-6 sm:px-8 py-3 sm:py-4 bg-transparent border border-white/20 text-white font-semibold rounded-lg sm:rounded-xl hover:bg-white/5 transition-all backdrop-blur-sm flex items-center justify-center gap-2 group text-sm sm:text-base inline-block" href="<?php echo esc_url( $settings['secondary_button_url']['url'] ); ?>">
                                    <span><?php echo esc_html( $settings['secondary_button_text'] ); ?></span>
                                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform text-secondary"></i>
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if ( ! empty( $settings['stats'] ) ) : ?>
                            <div class="grid grid-cols-3 gap-6 sm:gap-8 pt-8 lg:pt-12 border-t border-white/10 mt-8 max-w-lg mx-auto lg:mx-0">
                                <?php foreach ( $settings['stats'] as $stat ) : ?>
                                    <div>
                                        <p class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold text-white"><?php echo esc_html( $stat['stat_number'] ); ?></p>
                                        <p class="text-xs uppercase tracking-wide text-gray-500 mt-2 sm:mt-3"><?php echo esc_html( $stat['stat_label'] ); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ( ! empty( $settings['hero_image']['url'] ) ) : ?>
                        <div class="w-full lg:w-1/2 relative flex justify-center items-end">
                            <div class="relative w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-[500px]">
                                <div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent rounded-full filter blur-[60px] transform translate-y-10"></div>
                                <div class="relative z-10 transition-transform duration-700 hover:scale-[1.02]">
                                    <img alt="Hero Portrait" class="w-full h-auto drop-shadow-2xl rounded-2xl sm:rounded-3xl" src="<?php echo esc_url( $settings['hero_image']['url'] ); ?>" />
                                </div>
                                <!-- Rating Badge -->
                                <?php if ( ! empty( $settings['rating_text'] ) ) : ?>
                                    <div class="absolute bottom-6 sm:bottom-10 -left-2 sm:-left-4 md:-left-8 lg:-left-10 p-3 sm:p-4 glass-panel rounded-lg sm:rounded-2xl flex items-center gap-3 animate-[float_4s_ease-in-out_infinite] shadow-2xl z-20">
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-purple-gradient flex items-center justify-center text-white shadow-lg flex-shrink-0">
                                            <i class="fas fa-certificate text-sm sm:text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="font-display font-bold text-white text-xs sm:text-sm"><?php echo esc_html( $settings['rating_text'] ); ?></p>
                                            <div class="flex gap-0.5 mt-0.5 sm:mt-1">
                                                <?php for ( $i = 0; $i < intval( $settings['rating_stars'] ); $i++ ) : ?>
                                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </section>
        <?php
    }
}

