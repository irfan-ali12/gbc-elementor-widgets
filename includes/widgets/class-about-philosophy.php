<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_About_Philosophy_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-about-philosophy';
    }

    public function get_title() {
        return __( 'GBC About Philosophy Section', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-blockquote';
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
                'default' => 'My Philosophy',
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label'   => __( 'Section Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Your home deserves more than just a real estate agent',
            ]
        );

        $this->add_control(
            'section_content',
            [
                'label'   => __( 'Section Content', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => '<p>I believe in treating every home with the reverence it deserves. My philosophy centers on understanding what makes a property special—the light that streams through morning windows, the potential a space holds for your family\'s future, the genuine value that extends beyond square footage and price tags.</p><p>As someone who has lived here for over 15 years, I know this community intimately. I don\'t just list homes; I shepherd them to the right buyers and help families find their perfect sanctuary.</p>',
            ]
        );

        $this->add_control(
            'quote_text',
            [
                'label'   => __( 'Quote Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Real estate isn\'t about transactions—it\'s about transformations.',
            ]
        );

        $this->add_control(
            'quote_author',
            [
                'label'   => __( 'Quote Author', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Mike K.',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        wp_enqueue_style( 'gbc-ew-frontend' );
        ?>
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                <!-- Left Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <span class="inline-block px-4 py-2 rounded-full bg-purple-100 dark:bg-purple-900/30 text-sm font-semibold text-primary mb-4">
                            <?php echo esc_html( $settings['section_tag'] ); ?>
                        </span>
                        
                        <!-- Quote Box -->
                        <div class="mt-8 pt-8 border-t-4 border-primary dark:border-primary/50">
                            <p class="text-lg italic text-gray-700 dark:text-gray-300 font-light mb-4">
                                "<?php echo wp_kses_post( $settings['quote_text'] ); ?>"
                            </p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                <?php echo esc_html( $settings['quote_author'] ); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="lg:col-span-2">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-8 max-w-2xl">
                        <?php echo wp_kses_post( $settings['section_title'] ); ?>
                    </h2>

                    <div class="prose prose-lg dark:prose-invert max-w-none text-gray-600 dark:text-gray-400">
                        <?php echo wp_kses_post( $settings['section_content'] ); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
