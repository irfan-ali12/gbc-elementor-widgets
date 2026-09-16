<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_About_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-about';
    }

    public function get_title() {
        return __( 'GBC About Section', 'gbc-elementor-widgets' );
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
                'default' => 'Why Choose Mike K',
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label'   => __( 'Section Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Experience That Moves You Forward.',
            ]
        );

        $this->add_control(
            'paragraph_1',
            [
                'label'   => __( 'Paragraph 1', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => 'I believe real estate is more than just transactions; it\'s about life transitions. With over 15 years in the local market, I bring a depth of knowledge that ensures you\'re making the smartest decisions for your future.',
            ]
        );

        $this->add_control(
            'paragraph_2',
            [
                'label'   => __( 'Paragraph 2', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => 'From first-time homebuyers to seasoned investors, my approach is always personal, transparent, and tenaciously focused on your success. I don\'t just sell homes; I curate lifestyles.',
            ]
        );

        $this->add_control(
            'signature_heading',
            [
                'label' => __( 'Signature Section', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'signature_image',
            [
                'label'   => __( 'Signature Image', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [],
            ]
        );

        $this->add_control(
            'clients_count',
            [
                'label'   => __( 'Clients Count Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Trusted by 500+ locals',
            ]
        );

        $this->add_control(
            'client_avatars_heading',
            [
                'label' => __( 'Client Avatars', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Client Avatars Repeater
        $repeater = new Repeater();

        $repeater->add_control(
            'client_avatar',
            [
                'label'   => __( 'Avatar Image', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [],
            ]
        );

        $this->add_control(
            'client_avatars',
            [
                'label'   => __( 'Client Avatars', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [ 'client_avatar' => [] ],
                    [ 'client_avatar' => [] ],
                    [ 'client_avatar' => [] ],
                ],
                'title_field' => __( 'Avatar', 'gbc-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'gallery_heading',
            [
                'label' => __( 'Gallery Images', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Gallery Images - Left Column
        $this->add_control(
            'gallery_left_heading',
            [
                'label' => __( 'Left Column Images', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'gallery_left_image_1',
            [
                'label'   => __( 'Image 1 (Top)', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [],
            ]
        );

        $this->add_control(
            'gallery_stat_box',
            [
                'label'   => __( 'Stat Box Number (e.g., 98%)', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '98%',
            ]
        );

        $this->add_control(
            'gallery_stat_label',
            [
                'label'   => __( 'Stat Box Label', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'List-to-Sale Ratio',
            ]
        );

        // Right Column
        $this->add_control(
            'gallery_right_heading',
            [
                'label' => __( 'Right Column', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'gallery_quote_text',
            [
                'label'   => __( 'Testimonial Quote', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 2,
                'default' => 'Mike is simply the best in the business.',
            ]
        );

        $this->add_control(
            'gallery_right_image',
            [
                'label'   => __( 'Right Image', 'gbc-elementor-widgets' ),
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
                'default' => 'left-content',
                'options' => [
                    'left-content' => __( 'Content on Left', 'gbc-elementor-widgets' ),
                    'right-content' => __( 'Content on Right', 'gbc-elementor-widgets' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        wp_enqueue_style( 'gbc-ew-frontend' );

        $flex_direction = ( $settings['layout_type'] === 'right-content' ) ? 'lg:flex-row-reverse' : 'lg:flex-row';
        ?>
        <section class="py-16 sm:py-20 lg:py-24 bg-accent-gray dark:bg-[#130d1c] overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col <?php echo esc_attr( $flex_direction ); ?> items-center gap-12 sm:gap-16 lg:gap-20 xl:gap-24">
                    <!-- Gallery Section -->
                    <div class="w-full lg:w-1/2 relative">
                        <div class="absolute -top-12 -left-12 w-48 sm:w-64 h-48 sm:h-64 bg-secondary/10 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-12 -right-12 w-48 sm:w-64 h-48 sm:h-64 bg-primary/10 rounded-full blur-3xl"></div>
                        <div class="relative z-10 grid grid-cols-2 gap-4 sm:gap-6">
                            <!-- Left Column -->
                            <div class="space-y-4 sm:space-y-6 mt-8 sm:mt-12">
                                <?php if ( ! empty( $settings['gallery_left_image_1']['url'] ) ) : ?>
                                    <img alt="Gallery Image" class="rounded-2xl sm:rounded-3xl shadow-xl w-full h-48 sm:h-64 object-cover hover:scale-[1.02] transition-transform duration-500" src="<?php echo esc_url( $settings['gallery_left_image_1']['url'] ); ?>" />
                                <?php endif; ?>

                                <div class="bg-white dark:bg-surface-dark p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-lg border border-gray-100 dark:border-white/5">
                                    <p class="font-display font-bold text-4xl sm:text-5xl text-primary mb-2"><?php echo esc_html( $settings['gallery_stat_box'] ); ?></p>
                                    <p class="text-xs sm:text-sm text-gray-500 uppercase tracking-wider font-semibold"><?php echo esc_html( $settings['gallery_stat_label'] ); ?></p>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-4 sm:space-y-6">
                                <div class="bg-primary p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-lg text-white h-auto sm:h-auto">
                                    <i class="fas fa-quote-left text-2xl sm:text-3xl text-secondary mb-3 sm:mb-4 block"></i>
                                    <p class="font-medium text-base sm:text-lg italic leading-relaxed">"<?php echo esc_html( $settings['gallery_quote_text'] ); ?>"</p>
                                </div>

                                <?php if ( ! empty( $settings['gallery_right_image']['url'] ) ) : ?>
                                    <img alt="Gallery Image" class="rounded-2xl sm:rounded-3xl shadow-xl w-full h-48 sm:h-64 md:h-72 object-cover hover:scale-[1.02] transition-transform duration-500" src="<?php echo esc_url( $settings['gallery_right_image']['url'] ); ?>" />
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="w-full lg:w-1/2">
                        <span class="inline-block py-2 px-4 rounded-lg bg-primary/10 text-primary font-bold tracking-wider uppercase text-xs mb-6 sm:mb-8"><?php echo esc_html( $settings['section_tag'] ); ?></span>
                        <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6 sm:mb-8 leading-[1.2]">
                            <?php echo esc_html( $settings['section_title'] ); ?>
                        </h2>
                        <div class="space-y-4 sm:space-y-6 text-base sm:text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                            <p>
                                <?php echo esc_html( $settings['paragraph_1'] ); ?>
                            </p>
                            <p>
                                <?php echo esc_html( $settings['paragraph_2'] ); ?>
                            </p>
                        </div>

                        <div class="mt-8 sm:mt-10 lg:mt-12 flex flex-col sm:flex-row items-start sm:items-center gap-6 sm:gap-8 pt-8 sm:pt-10 border-t border-gray-200 dark:border-white/10">
                            <?php if ( ! empty( $settings['signature_image']['url'] ) ) : ?>
                                <img alt="Signature" class="h-10 sm:h-12 lg:h-14 opacity-70 dark:invert" src="<?php echo esc_url( $settings['signature_image']['url'] ); ?>" />
                            <?php endif; ?>

                            <?php if ( ! empty( $settings['client_avatars'] ) ) : ?>
                                <div class="gbc-client-avatars">
                                    <div class="gbc-avatars-group">
                                        <?php foreach ( $settings['client_avatars'] as $avatar ) : ?>
                                            <?php if ( ! empty( $avatar['client_avatar']['url'] ) ) : ?>
                                                <img alt="Client" src="<?php echo esc_url( $avatar['client_avatar']['url'] ); ?>" />
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <span class="text-xs sm:text-sm font-semibold text-gray-600 dark:text-gray-300 whitespace-nowrap"><?php echo esc_html( $settings['clients_count'] ); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
