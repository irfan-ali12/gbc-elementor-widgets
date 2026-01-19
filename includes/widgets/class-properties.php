<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_Properties_Widget extends Widget_Base {

    public function get_name() {
        return 'gbc-properties';
    }

    public function get_title() {
        return __( 'GBC Featured Properties', 'gbc-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
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
            'section_title',
            [
                'label'   => __( 'Section Title', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Featured Properties',
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label'   => __( 'Section Description', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 2,
                'default' => 'Curated selection of premium homes currently on the market.',
            ]
        );

        $this->add_control(
            'view_all_text',
            [
                'label'   => __( 'View All Link Text', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'View All Listings',
            ]
        );

        $this->add_control(
            'view_all_url',
            [
                'label' => __( 'View All Link URL', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::URL,
                'default' => [ 'url' => '#' ],
            ]
        );

        // Properties Repeater
        $repeater = new Repeater();

        $repeater->add_control(
            'property_image',
            [
                'label'   => __( 'Property Image', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [],
            ]
        );

        $repeater->add_control(
            'property_status',
            [
                'label'   => __( 'Status', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'for-sale',
                'options' => [
                    'for-sale' => __( 'For Sale', 'gbc-elementor-widgets' ),
                    'new' => __( 'New', 'gbc-elementor-widgets' ),
                    'sold' => __( 'Sold', 'gbc-elementor-widgets' ),
                ],
            ]
        );

        $repeater->add_control(
            'property_price',
            [
                'label'   => __( 'Price', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '$1,250,000',
            ]
        );

        $repeater->add_control(
            'property_location',
            [
                'label'   => __( 'Location', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Beverly Hills, CA',
            ]
        );

        $repeater->add_control(
            'property_name',
            [
                'label'   => __( 'Property Name', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Sunset Boulevard Estate',
            ]
        );

        $repeater->add_control(
            'property_beds',
            [
                'label'   => __( 'Bedrooms', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );

        $repeater->add_control(
            'property_baths',
            [
                'label'   => __( 'Bathrooms', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );

        $repeater->add_control(
            'property_sqft',
            [
                'label'   => __( 'Square Feet', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '3,200 SqFt',
            ]
        );

        $repeater->add_control(
            'property_url',
            [
                'label' => __( 'Property URL', 'gbc-elementor-widgets' ),
                'type'  => Controls_Manager::URL,
                'default' => [ 'url' => '#' ],
            ]
        );

        $this->add_control(
            'properties',
            [
                'label'   => __( 'Properties', 'gbc-elementor-widgets' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'property_status' => 'for-sale',
                        'property_price' => '$1,250,000',
                        'property_location' => 'Beverly Hills, CA',
                        'property_name' => 'Sunset Boulevard Estate',
                        'property_beds' => 4,
                        'property_baths' => 3,
                        'property_sqft' => '3,200 SqFt',
                    ],
                    [
                        'property_status' => 'new',
                        'property_price' => '$850,000',
                        'property_location' => 'Downtown LA, CA',
                        'property_name' => 'Downtown Skyline Loft',
                        'property_beds' => 2,
                        'property_baths' => 2,
                        'property_sqft' => '1,450 SqFt',
                    ],
                    [
                        'property_status' => 'sold',
                        'property_price' => '$2,100,000',
                        'property_location' => 'Malibu, CA',
                        'property_name' => 'Coastal Retreat',
                        'property_beds' => 5,
                        'property_baths' => 4,
                        'property_sqft' => '4,100 SqFt',
                    ],
                ],
                'title_field' => '{{{ property_name }}}',
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
        
        // Query latest 6 properties
        $properties_query = new \WP_Query( [
            'post_type' => 'property',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC',
        ] );
        
        ?>
        <section class="py-24 bg-background-light dark:bg-background-dark">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6 relative">
                    <div>
                        <h2 class="font-display text-4xl font-bold text-gray-900 dark:text-white"><?php echo esc_html( $settings['section_title'] ); ?></h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-3 text-lg"><?php echo esc_html( $settings['section_description'] ); ?></p>
                    </div>
                    <?php if ( ! empty( $settings['view_all_url']['url'] ) ) : ?>
                        <a style="color: inherit; text-decoration: none; border-color: currentColor; background-color: transparent;" class="hidden md:flex items-center gap-2 px-6 py-3 rounded-lg border border-gray-200 dark:border-white/10 text-gray-900 dark:text-white font-semibold hover:bg-gray-50 dark:hover:bg-white/5 transition-colors" href="<?php echo esc_url( $settings['view_all_url']['url'] ); ?>">
                            <?php echo esc_html( $settings['view_all_text'] ); ?> <i class="fas fa-arrow-right text-primary"></i>
                        </a>
                    <?php endif; ?>
                </div>

                <?php if ( $properties_query->have_posts() ) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-<?php echo intval( $columns ); ?> lg:grid-cols-<?php echo intval( $columns ); ?> gap-10">
                        <?php while ( $properties_query->have_posts() ) : $properties_query->the_post();
                            $property_id = get_the_ID();
                            $price = get_post_meta( $property_id, 'property_price', true );
                            $rent_price = get_post_meta( $property_id, 'property_rent_price', true );
                            $listing_type_prop = get_post_meta( $property_id, 'property_listing_type', true ) ?: 'sale';
                            $address = get_post_meta( $property_id, 'property_address', true );
                            $beds = get_post_meta( $property_id, 'property_beds', true );
                            $baths = get_post_meta( $property_id, 'property_baths', true );
                            $sqft = get_post_meta( $property_id, 'property_sqft', true );
                            $property_type = get_post_meta( $property_id, 'property_type', true );
                            $thumbnail = get_the_post_thumbnail_url( $property_id, 'large' ) ?: 'https://via.placeholder.com/600x400';
                            $permalink = get_the_permalink();
                            $display_price = $listing_type_prop === 'rent' ? $rent_price : $price;
                        ?>
                            <div class="group bg-white dark:bg-surface-dark rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-white/5 hover:-translate-y-2">
                                <div class="relative h-72 overflow-hidden">
                                    <?php if ( $listing_type_prop === 'sale' ) : ?>
                                        <div class="absolute top-4 left-4 z-10 bg-white/95 dark:bg-secondary backdrop-blur text-primary dark:text-white text-xs font-bold px-3 py-1.5 rounded-md uppercase tracking-wide shadow-sm flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> For Sale
                                        </div>
                                    <?php else : ?>
                                        <div class="absolute top-4 left-4 z-10 bg-white/95 dark:bg-secondary backdrop-blur text-primary dark:text-white text-xs font-bold px-3 py-1.5 rounded-md uppercase tracking-wide shadow-sm flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> For Rent
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ( ! empty( $property_type ) ) : ?>
                                        <div class="absolute top-4 right-4 z-10 bg-primary/10 dark:bg-white/10 backdrop-blur text-primary dark:text-secondary text-xs font-bold px-3 py-1.5 rounded-md uppercase tracking-wide shadow-sm">
                                            <?php echo esc_html( $property_type ); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <img alt="<?php the_title(); ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" src="<?php echo esc_url( $thumbnail ); ?>"/>
                                    
                                    <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-black/80 to-transparent"></div>
                                    <div class="absolute bottom-5 left-6 text-white">
                                        <p class="font-display font-bold text-2xl">
                                            <?php echo esc_html( $display_price ?: 'Contact for Price' ); ?>
                                            <?php if ( $listing_type_prop === 'rent' ) : ?>
                                                <span class="text-base font-normal">/month</span>
                                            <?php endif; ?>
                                        </p>
                                        <p class="text-gray-300 text-sm font-medium"><?php echo esc_html( $address ?: 'Address not available' ); ?></p>
                                    </div>
                                </div>
                                
                                <div class="p-6">
                                    <h3 class="font-display text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 line-clamp-2"><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>
                                    
                                    <div class="grid grid-cols-3 gap-4 py-4 border-y border-gray-100 dark:border-white/5 text-sm text-gray-600 dark:text-gray-300">
                                        <div class="flex flex-col items-center">
                                            <span class="text-primary text-lg mb-1"><i class="fas fa-bed"></i></span>
                                            <span class="font-bold text-lg text-gray-900 dark:text-white"><?php echo intval( $beds ); ?></span>
                                            <span class="text-xs uppercase text-gray-400 mt-1">Beds</span>
                                        </div>
                                        <div class="flex flex-col items-center border-l border-gray-100 dark:border-white/5">
                                            <span class="text-primary text-lg mb-1"><i class="fas fa-bath"></i></span>
                                            <span class="font-bold text-lg text-gray-900 dark:text-white"><?php echo esc_html( $baths ); ?></span>
                                            <span class="text-xs uppercase text-gray-400 mt-1">Baths</span>
                                        </div>
                                        <div class="flex flex-col items-center border-l border-gray-100 dark:border-white/5">
                                            <span class="text-primary text-lg mb-1"><i class="fas fa-ruler"></i></span>
                                            <span class="font-bold text-lg text-gray-900 dark:text-white"><?php echo esc_html( $sqft ); ?></span>
                                            <span class="text-xs uppercase text-gray-400 mt-1">SqFt</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6">
                                        <a class="block w-full py-3 text-center rounded-xl bg-primary text-white font-bold hover:bg-secondary transition-colors" href="<?php echo esc_url( $permalink ); ?>">View Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                <?php else : ?>
                    <div class="bg-gray-50 dark:bg-surface-dark rounded-3xl p-12 border border-gray-100 dark:border-white/10 text-center">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center">
                                <i class="fas fa-home text-2xl text-gray-400 dark:text-gray-600"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No Properties Found</h3>
                        <p class="text-gray-600 dark:text-gray-400">There are currently no properties available. Please check back soon for new listings.</p>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $settings['view_all_url']['url'] ) ) : ?>
                    <div class="mt-12 text-center md:hidden">
                        <a style="color: #5A1E96; text-decoration: none; border: none; background: none;" class="inline-flex items-center gap-2 text-primary font-bold hover:text-secondary transition-colors" href="<?php echo esc_url( $settings['view_all_url']['url'] ); ?>">
                            <?php echo esc_html( $settings['view_all_text'] ); ?> <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
