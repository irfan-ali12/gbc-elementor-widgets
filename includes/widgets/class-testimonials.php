<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_Testimonials_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-testimonials';
    }

    public function get_title() {
        return __( 'GBC Testimonials', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
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
                'default' => 'Client Stories',
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label'   => __( 'Section Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'What They Say About Mike',
            ]
        );

        // Testimonials Repeater
        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial_text',
            [
                'label'   => __( 'Testimonial Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => 'Mike made the impossible happen. In a tough market, he found us a hidden gem and negotiated a price well below asking. His dedication is unmatched.',
            ]
        );

        $repeater->add_control(
            'rating',
            [
                'label'   => __( 'Rating', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '5',
                'options' => [
                    '1' => __( '1 Star', 'gbc-elementor-widgets' ),
                    '2' => __( '2 Stars', 'gbc-elementor-widgets' ),
                    '3' => __( '3 Stars', 'gbc-elementor-widgets' ),
                    '4' => __( '4 Stars', 'gbc-elementor-widgets' ),
                    '5' => __( '5 Stars', 'gbc-elementor-widgets' ),
                ],
            ]
        );

        $repeater->add_control(
            'client_image',
            [
                'label'   => __( 'Client Image', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [],
            ]
        );

        $repeater->add_control(
            'client_name',
            [
                'label'   => __( 'Client Name', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Sarah Jenkins',
            ]
        );

        $repeater->add_control(
            'client_role',
            [
                'label'   => __( 'Client Role/Description', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Bought in Silver Lake',
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label'   => __( 'Testimonials', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_text' => 'Mike made the impossible happen. In a tough market, he found us a hidden gem and negotiated a price well below asking. His dedication is unmatched.',
                        'rating' => '5',
                        'client_name' => 'Sarah Jenkins',
                        'client_role' => 'Bought in Silver Lake',
                    ],
                    [
                        'testimonial_text' => 'Professional, polished, and incredibly knowledgeable. Mike sold our home in 5 days for over asking price. The marketing materials were stunning.',
                        'rating' => '5',
                        'client_name' => 'David Miller',
                        'client_role' => 'Sold in Pasadena',
                    ],
                    [
                        'testimonial_text' => 'As an investor, I need hard numbers and honesty. Mike delivers both. He\'s my go-to for all real estate ventures in the area.',
                        'rating' => '5',
                        'client_name' => 'Robert Chen',
                        'client_role' => 'Real Estate Investor',
                    ],
                ],
                'title_field' => '{{{ client_name }}}',
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
            'columns',
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

        $columns = intval( $settings['columns'] );
        ?>
        <section class="py-16 sm:py-24 lg:py-28 bg-white dark:bg-background-dark">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                    <span class="text-secondary font-bold tracking-widest uppercase text-xs sm:text-sm"><?php echo esc_html( $settings['section_tag'] ); ?></span>
                    <h2 class="font-display text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mt-2 sm:mt-3 lg:mt-4"><?php echo esc_html( $settings['section_title'] ); ?></h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-<?php echo intval( $columns ); ?> lg:grid-cols-<?php echo intval( $columns ); ?> gap-6 sm:gap-8 lg:gap-10">
                    <?php foreach ( $settings['testimonials'] as $testimonial ) : ?>
                        <div class="bg-white dark:bg-surface-dark p-6 sm:p-8 lg:p-10 rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 dark:border-white/5 relative hover:shadow-md transition-shadow duration-300">
                            <!-- Star Rating -->
                            <div class="flex items-center gap-1 text-yellow-400 mb-4 sm:mb-5 lg:mb-6">
                                <?php for ( $i = 0; $i < intval( $testimonial['rating'] ); $i++ ) : ?>
                                    <i class="fas fa-star text-lg sm:text-xl"></i>
                                <?php endfor; ?>
                            </div>

                            <!-- Testimonial Text -->
                            <p class="text-gray-600 dark:text-gray-300 mb-6 sm:mb-7 lg:mb-8 italic leading-relaxed text-sm sm:text-base lg:text-lg">
                                "<?php echo esc_html( $testimonial['testimonial_text'] ); ?>"
                            </p>

                            <!-- Client Info -->
                            <div class="flex items-center gap-3 sm:gap-4 mt-auto pt-4 sm:pt-6 border-t border-gray-100 dark:border-white/10">
                                <?php if ( ! empty( $testimonial['client_image']['url'] ) ) : ?>
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border-3 border-purple-300 overflow-hidden flex-shrink-0">
                                        <img alt="<?php echo esc_attr( $testimonial['client_name'] ); ?>" class="w-full h-full object-cover" src="<?php echo esc_url( $testimonial['client_image']['url'] ); ?>" />
                                    </div>
                                <?php else : ?>
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-purple-100 flex items-center justify-center border-3 border-purple-300 flex-shrink-0">
                                        <i class="fas fa-user text-purple-500 text-sm sm:text-lg"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white text-sm sm:text-base"><?php echo esc_html( $testimonial['client_name'] ); ?></p>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide"><?php echo esc_html( $testimonial['client_role'] ); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
