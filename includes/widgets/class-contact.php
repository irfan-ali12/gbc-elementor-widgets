<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_Contact_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-contact';
    }

    public function get_title() {
        return __( 'GBC Contact Section', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-envelope';
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

        // Section Title & Desc
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Section Content', 'gbc-elementor-widgets' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_tag',
            [
                'label'       => __( 'Section Tag', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Contact Us',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label'       => __( 'Section Title', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Let\'s Start a Conversation',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label'       => __( 'Section Description', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Whether you\'re buying, selling, or just curious about the market, I\'m here to help.',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Contact Info
        $this->start_controls_section(
            'contact_info_section',
            [
                'label' => __( 'Contact Information', 'gbc-elementor-widgets' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'info_icon',
            [
                'label'   => __( 'Icon', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'mail',
            ]
        );

        $repeater->add_control(
            'info_title',
            [
                'label'   => __( 'Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Email',
            ]
        );

        $repeater->add_control(
            'info_content',
            [
                'label'   => __( 'Content', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'mike@mikekrealtor.com',
            ]
        );

        $repeater->add_control(
            'info_url',
            [
                'label'   => __( 'Link', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'mailto:mike@mikekrealtor.com',
            ]
        );

        $this->add_control(
            'contact_info',
            [
                'label'   => __( 'Contact Items', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'info_icon'    => 'mail',
                        'info_title'   => 'Email Me',
                        'info_content' => 'mike@mikekrealtor.com',
                        'info_url'     => 'mailto:mike@mikekrealtor.com',
                    ],
                    [
                        'info_icon'    => 'call',
                        'info_title'   => 'Call Office',
                        'info_content' => '(626) 555-0123',
                        'info_url'     => 'tel:(626) 555-0123',
                    ],
                    [
                        'info_icon'    => 'location_on',
                        'info_title'   => 'Visit Office',
                        'info_content' => '123 Realtor Ave, Pasadena, CA 91101',
                        'info_url'     => '#',
                    ],
                ],
                'title_field' => '{{{ info_title }}}',
            ]
        );

        $this->add_control(
            'social_heading',
            [
                'label'   => __( 'Social Links Label', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Follow me:',
            ]
        );

        $this->end_controls_section();

        // Form Section
        $this->start_controls_section(
            'form_section',
            [
                'label' => __( 'Contact Form', 'gbc-elementor-widgets' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'form_title',
            [
                'label'       => __( 'Form Title', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Send me a message',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'admin_email',
            [
                'label'       => __( 'Admin Email', 'gbc-elementor-widgets' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option( 'admin_email' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $contact_info = isset( $settings['contact_info'] ) ? $settings['contact_info'] : [];

        wp_enqueue_style( 'gbc-ew-frontend' );
        wp_enqueue_script( 'gbc-ew-frontend' );
        ?>
        <section class="relative py-12 lg:py-24 overflow-hidden bg-white dark:bg-surface-dark">
            <div class="absolute -top-[20%] -right-[10%] -z-10 h-[500px] w-[500px] rounded-full bg-primary/5 blur-[100px]"></div>
            
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2 lg:gap-20">
                    <!-- Left Column -->
                    <div class="flex flex-col justify-center">
                        <div class="mb-8">
                            <span class="mb-4 inline-block rounded-full bg-primary/10 px-4 py-1.5 text-sm font-bold text-primary dark:bg-primary/20">
                                <?php echo esc_html( $settings['section_tag'] ); ?>
                            </span>
                            <h2 class="mb-6 text-4xl font-bold leading-tight text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
                                <?php echo wp_kses_post( $settings['section_title'] ); ?>
                            </h2>
                            <p class="max-w-lg text-lg text-gray-600 dark:text-gray-400">
                                <?php echo esc_html( $settings['section_description'] ); ?>
                            </p>
                        </div>

                        <!-- Contact Cards -->
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                            <?php foreach ( $contact_info as $item ) : ?>
                                <div class="group flex items-start gap-4 rounded-xl border border-transparent bg-gray-50 dark:bg-white/5 p-6 hover:border-primary/20 hover:bg-white hover:shadow-lg dark:hover:bg-white/10 transition-all">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-white text-primary shadow-sm dark:bg-gray-800 group-hover:bg-primary group-hover:text-white transition-colors">
                                        <span class="material-symbols-outlined"><?php echo esc_attr( $item['info_icon'] ); ?></span>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-gray-900 dark:text-white mb-0"><?php echo esc_html( $item['info_title'] ); ?></h3>
                                        <?php if ( ! empty( $item['info_url'] ) && $item['info_url'] !== '#' ) : ?>
                                            <a class="text-sm text-gray-600 hover:text-primary dark:text-gray-400 transition-colors" href="<?php echo esc_url( $item['info_url'] ); ?>">
                                                <?php echo esc_html( $item['info_content'] ); ?>
                                            </a>
                                        <?php else : ?>
                                            <p class="text-sm text-gray-600 dark:text-gray-400"><?php echo esc_html( $item['info_content'] ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Socials -->
                        <div class="mt-10 flex items-center gap-6">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white"><?php echo esc_html( $settings['social_heading'] ); ?></span>
                            <div class="flex gap-4">
                                <a class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-primary hover:text-white transition-all dark:bg-white/10 dark:text-gray-300" href="https://www.facebook.com/mikekrealtor" title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-primary hover:text-white transition-all dark:bg-white/10 dark:text-gray-300" href="https://www.instagram.com/bruinagent?igsh=NTc4MTIwNjQ2YQ==" title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-primary hover:text-white transition-all dark:bg-white/10 dark:text-gray-300" href="https://www.linkedin.com/in/mike-karamanoukian-321a35381" title="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Form -->
                    <div class="relative">
                        <!-- Mascot -->
                        <div class="absolute -top-12 right-12 z-20 hidden lg:flex">
                            <div class="h-24 w-24 rounded-full bg-purple-100 dark:bg-primary/20 flex items-center justify-center">
                                <span class="material-symbols-outlined text-4xl text-primary">waving_hand</span>
                            </div>
                        </div>

                        <!-- Form Card -->
                        <div class="relative z-10 rounded-2xl bg-white dark:bg-gray-900 p-6 shadow-lg sm:p-8 lg:p-10 border border-gray-200 dark:border-gray-800">
                            <h3 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white"><?php echo esc_html( $settings['form_title'] ); ?></h3>
                            <form class="gbc-contact-form flex flex-col gap-5" data-admin-email="<?php echo esc_attr( $settings['admin_email'] ); ?>">
                                <label class="flex flex-col gap-2">
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Full Name</span>
                                    <input class="h-12 w-full rounded-lg border border-gray-300 bg-gray-50 px-4 text-base text-gray-900 placeholder-gray-500 focus:border-primary focus:bg-white focus:outline-none focus:ring-1 focus:ring-primary dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-colors" placeholder="John Doe" type="text" name="name" required/>
                                </label>

                                <label class="flex flex-col gap-2">
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Email Address</span>
                                    <input class="h-12 w-full rounded-lg border border-gray-300 bg-gray-50 px-4 text-base text-gray-900 placeholder-gray-500 focus:border-primary focus:bg-white focus:outline-none focus:ring-1 focus:ring-primary dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-colors" placeholder="john@example.com" type="email" name="email" required/>
                                </label>

                                <label class="flex flex-col gap-2">
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Your Message</span>
                                    <textarea class="w-full resize-none rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-base text-gray-900 placeholder-gray-500 focus:border-primary focus:bg-white focus:outline-none focus:ring-1 focus:ring-primary dark:bg-gray-800 dark:border-gray-700 dark:text-white transition-colors" placeholder="I'm interested in viewing..." rows="4" name="message" required></textarea>
                                </label>

                                <button class="mt-2 w-full rounded-lg bg-gradient-to-r from-primary to-purple-600 py-4 text-sm font-bold text-white shadow-md transition-all hover:opacity-90 hover:shadow-lg" type="submit">
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
