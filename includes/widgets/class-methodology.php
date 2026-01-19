<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_Methodology_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-methodology';
    }

    public function get_title() {
        return __( 'GBC Methodology Section', 'gbc-elementor-widgets' );
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
                'default' => 'Our methodology',
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label'   => __( 'Section Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Refining the Search Experience',
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label'   => __( 'Section Description', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => 'Moving beyond the transactional. We provide a boutique experience grounded in deep industry knowledge. We don\'t just fill positions; we craft the architecture of your team\'s future success.',
            ]
        );

        // Steps Repeater
        $repeater = new Repeater();

        $repeater->add_control(
            'step_title',
            [
                'label'   => __( 'Step Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Curated Selection',
            ]
        );

        $repeater->add_control(
            'step_description',
            [
                'label'   => __( 'Step Description', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 3,
                'default' => 'Every candidate is rigorously vetted for technical prowess, soft skills, and deep cultural alignment with your mission.',
            ]
        );

        $this->add_control(
            'steps',
            [
                'label'   => __( 'Methodology Steps', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'step_title' => 'Curated Selection',
                        'step_description' => 'Every candidate is rigorously vetted for technical prowess, soft skills, and deep cultural alignment with your mission.',
                    ],
                    [
                        'step_title' => 'Discreet & Secure',
                        'step_description' => 'Encrypted platforms and strict NDA protocols protect your interests. We operate in the shadows so you can shine.',
                    ],
                    [
                        'step_title' => 'Advisory First',
                        'step_description' => 'Access to 24/7 strategic counsel to design your organizational chart for future scale before hiring begins.',
                    ],
                ],
                'title_field' => '{{{ step_title }}}',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'   => __( 'Button Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Our Process',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label' => __( 'Button URL', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::URL,
                'default' => [ 'url' => '#' ],
            ]
        );

        $this->add_control(
            'image_heading',
            [
                'label' => __( 'Image Section', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'methodology_image',
            [
                'label'   => __( 'Methodology Image', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [],
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
            'layout_type',
            [
                'label'   => __( 'Layout', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left-image',
                'options' => [
                    'left-image' => __( 'Image on Left', 'gbc-elementor-widgets' ),
                    'right-image' => __( 'Image on Right', 'gbc-elementor-widgets' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        wp_enqueue_style( 'gbc-ew-frontend' );

        $flex_direction = ( $settings['layout_type'] === 'right-image' ) ? 'lg:flex-row-reverse' : 'lg:flex-row';
        $image_order = ( $settings['layout_type'] === 'right-image' ) ? 'order-2' : 'order-1';
        $content_order = ( $settings['layout_type'] === 'right-image' ) ? 'order-1' : 'order-2';
        ?>
        <section class="py-32 bg-background relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="<?php echo esc_attr( $image_order ); ?>">
                        <div class="inline-block mb-4">
                            <span class="text-primary font-display italic text-xl"><?php echo esc_html( $settings['section_tag'] ); ?></span>
                        </div>
                        <h2 class="font-display text-4xl md:text-5xl text-text mb-8 leading-tight">
                            <?php 
                                $title_parts = explode( ' ', $settings['section_title'] );
                                $last_word = array_pop( $title_parts );
                                echo esc_html( implode( ' ', $title_parts ) ) . '<br/>';
                            ?>
                            <span class="text-primary-dark"><?php echo esc_html( $last_word ); ?></span>
                        </h2>
                        <p class="text-lg text-gray-500 mb-10 leading-relaxed font-light">
                            <?php echo esc_html( $settings['section_description'] ); ?>
                        </p>
                        <div class="relative pl-8 border-l border-gray-200 space-y-12">
                            <?php foreach ( $settings['steps'] as $step ) : ?>
                                <div class="relative group">
                                    <span class="absolute -left-[39px] top-1 h-5 w-5 rounded-full border-4 border-white bg-gray-300 group-hover:bg-primary transition-colors duration-300 shadow-md"></span>
                                    <h4 class="text-xl font-display text-text mb-2 group-hover:text-primary transition-colors"><?php echo esc_html( $step['step_title'] ); ?></h4>
                                    <p class="text-sm text-gray-500 leading-relaxed max-w-md"><?php echo esc_html( $step['step_description'] ); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-12">
                            <?php if ( ! empty( $settings['button_url']['url'] ) ) : ?>
                                <a href="<?php echo esc_url( $settings['button_url']['url'] ); ?>" class="px-8 py-3 bg-text text-white font-bold uppercase tracking-widest text-xs hover:bg-primary rounded-full transition-all duration-300 shadow-lg hover:shadow-xl inline-block">
                                    <?php echo esc_html( $settings['button_text'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="<?php echo esc_attr( $content_order ); ?> relative h-full min-h-[500px]">
                        <div class="relative z-10 w-full h-full rounded-[3rem] overflow-hidden shadow-2xl">
                            <?php if ( ! empty( $settings['methodology_image']['url'] ) ) : ?>
                                <img alt="Methodology" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700 transform hover:scale-105" src="<?php echo esc_url( $settings['methodology_image']['url'] ); ?>" />
                            <?php else : ?>
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-6xl text-gray-400">image</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="absolute -bottom-10 -right-10 z-20 hidden md:block">
                            <div class="relative w-40 h-40">
                                <div class="absolute inset-0 bg-white rounded-full shadow-xl flex items-center justify-center z-10">
                                    <div class="w-32 h-32 bg-primary rounded-full flex items-center justify-center text-white">
                                        <span class="material-symbols-outlined text-4xl -rotate-45">arrow_forward</span>
                                    </div>
                                </div>
                                <div class="absolute inset-0 circular-text-container z-20 pointer-events-none">
                                    <svg class="w-full h-full" viewBox="0 0 100 100">
                                        <defs>
                                            <path d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0" id="circle"></path>
                                        </defs>
                                        <text font-size="11" font-weight="bold" letter-spacing="1.2">
                                            <textPath class="fill-text uppercase" xlink:href="#circle">
                                                Start Your Search • Start Your Search •
                                            </textPath>
                                        </text>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-10 -right-10 w-2/3 h-2/3 bg-gray-200 rounded-[3rem] -z-0"></div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

