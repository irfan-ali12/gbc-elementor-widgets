<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    primary: "#5A1E96",
                    secondary: "#8B5CF6",
                    "background-light": "#FDFBFD",
                    "background-dark": "#0F0A15",
                    "surface-light": "#FFFFFF",
                    "surface-dark": "#1A1523",
                    "text-light": "#1A202C",
                    "text-dark": "#E2E8F0",
                },
                fontFamily: {
                    display: ["Manrope", "sans-serif"],
                    sans: ["'Plus Jakarta Sans'", "sans-serif"]
                },
                backgroundImage: {
                    "hero-gradient": "linear-gradient(135deg, #0F0518 0%, #2E1065 100%)",
                    "purple-gradient": "linear-gradient(135deg, #6B21A8 0%, #A855F7 100%)",
                    "card-gradient": "linear-gradient(180deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0) 100%)"
                },
                boxShadow: {
                    'glow': '0 0 20px rgba(139, 92, 246, 0.3)',
                    'card': '0 10px 30px -5px rgba(0, 0, 0, 0.05)'
                }
            }
        }
    };
    </script>
    <style>
    .glass-panel { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); }
    .text-gradient { background-clip: text; -webkit-background-clip: text; color: transparent; background-image: linear-gradient(to right, #C084FC, #FFF); }
    .custom-select {
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><path fill="%236B21A8" d="M6 9L1 4h10z"/></svg>');
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        appearance: none;
    }
    </style>
    <?php wp_head(); ?>
</head>
<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark font-sans transition-colors duration-300 antialiased selection:bg-primary selection:text-white">
<?php wp_body_open(); ?>

<!-- Navigation -->
<!--
<nav class="fixed w-full z-50 bg-surface-light/95 dark:bg-[#0F0A15]/90 backdrop-blur-md border-b border-gray-200 dark:border-white/5 transition-all duration-300">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex justify-between items-center h-24">
<div class="flex-shrink-0 flex items-center gap-6">
<a class="block" href="<?php echo home_url(); ?>">
<img alt="Mike K Realtor" class="h-10 md:h-12 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQqfIorZJQlShXJnUShVwYinR6R6_mRrG2bfQltIXKbXurZhuL6GQ21c2ULCG8s9jBVay7uC9jU3P4TzQM5vKqk-zFZQmY7vKBG0FlVAOoz22Wg-XtrCrR-U-20zFJHZEzKgL6M8vLUNeET-dZgiMGau192-ej7g2Naxa0EEb0dyeegXWIB2tQkKszjKuEjWSfi6VzGIHaBfm-_muMggJk2CogYehwlONT_RQHoFK2aZ0gkfixPqQ_nckR0biaQB-Pfs_r-Bxh9MI"/>
</a>
<div class="h-8 w-px bg-gray-300 dark:bg-white/10 hidden sm:block"></div>
<div class="hidden sm:flex flex-col justify-center">
<div class="flex items-center leading-none">
<span class="font-display font-black text-xl text-[#b40101] tracking-tighter mr-0.5">kw</span>
<span class="font-display font-bold text-lg text-gray-800 dark:text-white tracking-tight">PASADENA</span>
</div>
<span class="text-[0.55rem] font-bold tracking-[0.15em] uppercase text-gray-500 dark:text-gray-400 leading-tight">Keller Williams Realty</span>
</div>
</div>
<div class="hidden md:flex space-x-10 items-center">
<a class="text-primary dark:text-white font-bold text-sm tracking-wide transition-colors" href="<?php echo home_url( '/properties/' ); ?>">Properties</a>
<a class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-white font-medium text-sm tracking-wide transition-colors" href="#">Services</a>
<a class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-white font-medium text-sm tracking-wide transition-colors" href="#">About Mike</a>
<a class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-white font-medium text-sm tracking-wide transition-colors" href="#">Testimonials</a>
</div>
<div class="flex items-center gap-4">
<a class="hidden md:inline-flex items-center justify-center px-6 py-2.5 border border-primary/20 text-sm font-semibold rounded-full text-white bg-primary hover:bg-secondary transition-all shadow-glow hover:shadow-primary/50" href="#">
Book Consultation
</a>
</div>
</div>
</div>
</nav>
-->

<!-- Hero Section -->
<section class="relative pt-40 pb-20 bg-background-dark overflow-hidden">
<div class="absolute inset-0 z-0">
<div class="absolute inset-0 bg-hero-gradient opacity-95 z-10"></div>
<img alt="Luxury modern home exterior" class="w-full h-full object-cover grayscale opacity-30" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCl6KxtJ6wckjVdPy27bubNZDySpuUe6gBpp89nfF1074Ap6oSjTfaT6SWt7vwEIXKmyzXNPhIZVaLKBnm6NMzIEOv23gWyAXeqOCXtFd2P27eUnhycLpzZifP0WBwv5XgKrhQcaCu049Wa9E5qlFVLV7eYtEXNiJ1dzcFEbLXMZNEmBf_I42Wm76buONYPbCgChnhFHednarP6RpDVbsB61ev3EA-j9_d8v5UPG6Sy3_YW-qPzEYYzfw6HvUoO6kNUIwtSm48KAoc"/>
<div class="absolute top-0 right-0 w-[800px] h-[800px] bg-primary rounded-full filter blur-[120px] opacity-20 -translate-y-1/2 translate-x-1/3"></div>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 text-center">
<div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm mb-6">
<span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
<span class="text-xs font-semibold tracking-widest uppercase text-gray-300">Curated Portfolio</span>
</div>
<h1 class="font-display text-5xl md:text-6xl font-bold text-white mb-6">Exclusive <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary to-white">Listings</span></h1>
<p class="text-lg text-gray-400 max-w-2xl mx-auto font-light leading-relaxed">
Discover a handpicked selection of premier properties across Los Angeles. From modern masterpieces to historic estates, find the home that speaks to your lifestyle.
</p>
</div>
</section>

<?php
$search = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : '';
$price_range = isset( $_GET['price_range'] ) ? sanitize_text_field( $_GET['price_range'] ) : '';
$property_type = isset( $_GET['property_type'] ) ? sanitize_text_field( $_GET['property_type'] ) : '';
$listing_type = isset( $_GET['listing_type'] ) ? sanitize_text_field( $_GET['listing_type'] ) : '';
$sort = isset( $_GET['sort'] ) ? sanitize_text_field( $_GET['sort'] ) : 'newest';

// Price range mapping
$price_ranges = [
    'under-1m' => [ 0, 1000000 ],
    '1m-3m' => [ 1000000, 3000000 ],
    '3m-5m' => [ 3000000, 5000000 ],
    '5m-plus' => [ 5000000, PHP_INT_MAX ]
];

// Clear filters button
if ( isset( $_GET['clear_filters'] ) ) {
    wp_redirect( home_url( '/properties/' ) );
    exit;
}
?>

<!-- Filters Section -->
<section class="z-40 bg-white/80 dark:bg-[#130d1c]/80 backdrop-blur-lg border-y border-gray-200 dark:border-white/5 py-6 transition-all duration-300 shadow-sm">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<form method="get" class="space-y-4">
<div class="flex flex-col lg:flex-row gap-4 lg:items-center justify-between">
<div class="flex flex-col md:flex-row gap-4 flex-grow">
<div class="relative group flex-grow md:max-w-xs">
<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 group-focus-within:text-primary">
<i class="fas fa-search"></i>
</span>
<input class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all" placeholder="Search properties..." type="text" name="s" value="<?php echo esc_attr( $search ); ?>" style="padding-left: 30px !important;"/>
</div>
<div class="relative min-w-[140px]">
<select class="custom-select w-full pl-4 pr-10 py-2.5 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all cursor-pointer font-medium text-sm" name="listing_type">
<option value="">All Listings</option>
<option value="sale" <?php selected( $listing_type, 'sale' ); ?>>For Sale</option>
<option value="rent" <?php selected( $listing_type, 'rent' ); ?>>For Rent</option>
</select>
</div>
<div class="relative min-w-[140px]">
<select class="custom-select w-full pl-4 pr-10 py-2.5 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all cursor-pointer font-medium text-sm" name="property_type">
<option value="">All Types</option>
<option value="single-family" <?php selected( $property_type, 'single-family' ); ?>>Single Family</option>
<option value="condo" <?php selected( $property_type, 'condo' ); ?>>Condo / Loft</option>
<option value="multi-family" <?php selected( $property_type, 'multi-family' ); ?>>Multi-Family</option>
<option value="land" <?php selected( $property_type, 'land' ); ?>>Land</option>
</select>
</div>
<div class="relative min-w-[140px]">
<select class="custom-select w-full pl-4 pr-10 py-2.5 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition-all cursor-pointer font-medium text-sm" name="price_range">
<option value="">All Prices</option>
<option value="under-1m" <?php selected( $price_range, 'under-1m' ); ?>>Under $1M</option>
<option value="1m-3m" <?php selected( $price_range, '1m-3m' ); ?>>$1M - $3M</option>
<option value="3m-5m" <?php selected( $price_range, '3m-5m' ); ?>>$3M - $5M</option>
<option value="5m-plus" <?php selected( $price_range, '5m-plus' ); ?>>$5M+</option>
</select>
</div>
</div>
<div class="flex items-center gap-3">
<select class="bg-transparent border-none text-gray-900 dark:text-white text-sm font-bold focus:ring-0 cursor-pointer p-0 pr-8 custom-select bg-right" name="sort" onchange="this.form.submit()">
<option value="newest" <?php selected( $sort, 'newest' ); ?>>Newest</option>
<option value="price-high" <?php selected( $sort, 'price-high' ); ?>>Price: High to Low</option>
<option value="price-low" <?php selected( $sort, 'price-low' ); ?>>Price: Low to High</option>
</select>
</div>
</div>
<div class="flex gap-2 pt-2">
<button class="px-6 py-2.5 bg-primary text-white font-bold rounded-xl hover:bg-secondary transition-colors text-sm flex items-center gap-2" type="submit">
<i class="fas fa-filter"></i> Apply Filters
</button>
<?php if ( ! empty( $search ) || ! empty( $price_range ) || ! empty( $property_type ) || ! empty( $listing_type ) ) : ?>
<a class="px-6 py-2.5 bg-gray-200 dark:bg-white/10 text-gray-900 dark:text-white font-bold rounded-xl hover:bg-gray-300 dark:hover:bg-white/20 transition-colors text-sm flex items-center gap-2" href="<?php echo home_url( '/properties/' ); ?>">
<i class="fas fa-times"></i> Clear Filters
</a>
<?php endif; ?>
</div>
</form>
</div>
</section>

<!-- Properties Grid -->
<section class="py-16 bg-background-light dark:bg-background-dark min-h-screen">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex items-center justify-between mb-8">
<?php
// Calculate property count based on current filters
$count_meta_query = [ 'relation' => 'AND' ];

// Add listing type filter (sale/rent)
if ( ! empty( $listing_type ) ) {
    $count_meta_query[] = [
        'key' => 'property_listing_type',
        'value' => $listing_type,
        'compare' => '='
    ];
}

// Add property type filter
if ( ! empty( $property_type ) ) {
    $count_meta_query[] = [
        'key' => 'property_type',
        'value' => $property_type,
        'compare' => '='
    ];
}

$count_args = array(
    'post_type' => 'property',
    'posts_per_page' => -1,
    'fields' => 'ids',
    'meta_query' => $count_meta_query
);

$count_query = new WP_Query( $count_args );
$count_property_ids = $count_query->posts;
wp_reset_postdata();

// Apply search and price range filters to count
$filtered_count_ids = [];
foreach ( $count_property_ids as $pid ) {
    // Apply search filter
    if ( ! empty( $search ) ) {
        $title = get_the_title( $pid );
        $address = get_post_meta( $pid, 'property_address', true );
        $city = get_post_meta( $pid, 'property_city', true );
        
        if ( stripos( $title, $search ) === false && 
             stripos( $address, $search ) === false && 
             stripos( $city, $search ) === false ) {
            continue;
        }
    }
    
    // Apply price range filter
    if ( ! empty( $price_range ) && isset( $price_ranges[ $price_range ] ) ) {
        list( $min_price, $max_price ) = $price_ranges[ $price_range ];
        $check_price = get_post_meta( $pid, 'property_price', true );
        $price_numeric = intval( str_replace( ['$', ','], '', $check_price ) );
        
        if ( $price_numeric < $min_price || $price_numeric > $max_price ) {
            continue;
        }
    }
    
    $filtered_count_ids[] = $pid;
}

$total_filtered = count( $filtered_count_ids );
?>
<h2 class="text-xl font-bold text-gray-900 dark:text-white"><span class="text-primary"><?php echo intval( $total_filtered ); ?></span> Properties Found</h2>
<div class="flex gap-2">
<button class="w-10 h-10 flex items-center justify-center rounded-lg bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 text-primary shadow-sm hover:bg-gray-50 dark:hover:bg-white/10 transition-all">
<i class="fas fa-th-large"></i>
</button>
<button class="w-10 h-10 flex items-center justify-center rounded-lg bg-transparent border border-transparent text-gray-400 hover:text-gray-900 dark:hover:text-white transition-all">
<i class="fas fa-list"></i>
</button>
</div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
<?php
// Build query arguments
$meta_query = [ 'relation' => 'AND' ];
$orderby = 'date';
$order = 'DESC';

// DON'T add search to meta_query, we'll handle it in PHP
// This avoids conflicts between 's' parameter and meta_query

// Add listing type filter (sale/rent)
if ( ! empty( $listing_type ) ) {
    $meta_query[] = [
        'key' => 'property_listing_type',
        'value' => $listing_type,
        'compare' => '='
    ];
}

// Add property type filter
if ( ! empty( $property_type ) ) {
    $meta_query[] = [
        'key' => 'property_type',
        'value' => $property_type,
        'compare' => '='
    ];
}

// Handle sorting
if ( $sort === 'price-high' ) {
    $orderby = 'meta_value_num';
    $order = 'DESC';
} elseif ( $sort === 'price-low' ) {
    $orderby = 'meta_value_num';
    $order = 'ASC';
}

$args = array(
    'post_type' => 'property',
    'posts_per_page' => 200,
    'orderby' => $orderby,
    'order' => $order,
    'meta_query' => $meta_query
);

if ( in_array( $orderby, [ 'meta_value_num', 'meta_value' ] ) ) {
    $args['meta_key'] = 'property_price';
}

$properties = new WP_Query( $args );

// Filter results by search and price range in PHP
$all_properties = [];
if ( $properties->have_posts() ) {
    while ( $properties->have_posts() ) {
        $properties->the_post();
        $property_id = get_the_ID();
        $price = get_post_meta( $property_id, 'property_price', true );
        $rent_price = get_post_meta( $property_id, 'property_rent_price', true );
        $price_numeric = intval( str_replace( ['$', ','], '', $price ) );
        
        // Apply search filter - check title, address, and city
        if ( ! empty( $search ) ) {
            $title = get_the_title();
            $address = get_post_meta( $property_id, 'property_address', true );
            $city = get_post_meta( $property_id, 'property_city', true );
            
            // Check if search term appears anywhere in title, address, or city (case insensitive)
            $search_found = false;
            $search_lower = strtolower( $search );
            
            if ( stripos( $title, $search ) !== false || 
                 stripos( $address, $search ) !== false || 
                 stripos( $city, $search ) !== false ) {
                $search_found = true;
            }
            
            if ( ! $search_found ) {
                continue;
            }
        }
        
        // Apply price filter
        if ( ! empty( $price_range ) && isset( $price_ranges[ $price_range ] ) ) {
            list( $min_price, $max_price ) = $price_ranges[ $price_range ];
            if ( $price_numeric < $min_price || $price_numeric > $max_price ) {
                continue;
            }
        }
        
        $all_properties[] = $property_id;
    }
    wp_reset_postdata();
}

// Re-query with filtered IDs
if ( ! empty( $all_properties ) ) {
    $args = array(
        'post_type' => 'property',
        'post__in' => $all_properties,
        'posts_per_page' => -1,
        'orderby' => $orderby,
        'order' => $order
    );
    if ( in_array( $orderby, [ 'meta_value_num' ] ) ) {
        $args['meta_key'] = 'property_price';
    }
    $properties = new WP_Query( $args );
}

if ( $properties->have_posts() ) {
    while ( $properties->have_posts() ) {
        $properties->the_post();
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
<p class="text-sm text-gray-500 dark:text-gray-400 mb-6 line-clamp-2"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
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
<div class="mt-6 flex gap-3">
<a class="flex-1 py-3 text-center rounded-xl bg-gray-50 dark:bg-white/5 text-gray-900 dark:text-white font-bold hover:bg-gray-100 dark:hover:bg-white/10 transition-colors" href="<?php echo esc_url( $permalink ); ?>">Details</a>
<a class="flex-1 py-3 text-center rounded-xl bg-primary text-white font-bold shadow-glow hover:bg-secondary transition-colors" href="<?php echo esc_url( $permalink ); ?>">Tour</a>
</div>
</div>
</div>
<?php
    }
    wp_reset_postdata();
} else {
    echo '<div class="col-span-full text-center py-20">';
    echo '<p class="text-2xl font-bold text-gray-900 dark:text-white mb-3">No Properties Found</p>';
    echo '<p class="text-gray-500 dark:text-gray-400 mb-6">Try adjusting your filters or search criteria</p>';
    echo '<a href="' . home_url( '/properties/' ) . '" class="inline-block px-6 py-3 bg-primary text-white font-bold rounded-xl hover:bg-secondary transition-colors">View All Properties</a>';
    echo '</div>';
}
?>
</div>
</div>
</section>

<!-- Footer -->
<!--
<footer class="bg-surface-dark text-white pt-16 sm:pt-20 pb-8 sm:pb-10 border-t border-white/5">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-12 lg:gap-16 mb-12 sm:mb-16">
<div class="sm:col-span-2 lg:col-span-1 space-y-6 sm:space-y-8">
<img alt="Logo" class="h-8 w-auto brightness-0 invert opacity-90" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQqfIorZJQlShXJnUShVwYinR6R6_mRrG2bfQltIXKbXurZhuL6GQ21c2ULCG8s9jBVay7uC9jU3P4TzQM5vKqk-zFZQmY7vKBG0FlVAOoz22Wg-XtrCrR-U-20zFJHZEzKgL6M8vLUNeET-dZgiMGau192-ej7g2Naxa0EEb0dyeegXWIB2tQkKszjKuEjWSfi6VzGIHaBfm-_muMggJk2CogYehwlONT_RQHoFK2aZ0gkfixPqQ_nckR0biaQB-Pfs_r-Bxh9MI"/>
<p class="text-gray-400 leading-relaxed text-sm">Elevating the real estate experience with integrity, expertise, and a personal touch. Based in Los Angeles, serving clients worldwide.</p>
<div class="flex gap-3 sm:gap-4">
<a class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary hover:scale-110 transition-all text-white border border-white/10 text-sm" href="#"><i class="fab fa-instagram"></i></a>
<a class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary hover:scale-110 transition-all text-white border border-white/10 text-sm" href="#"><i class="fab fa-linkedin-in"></i></a>
<a class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary hover:scale-110 transition-all text-white border border-white/10 text-sm" href="#"><i class="fab fa-facebook-f"></i></a>
</div>
</div>
<div>
<h4 class="font-bold text-base sm:text-lg mb-4 sm:mb-6 text-white tracking-wide">Quick Links</h4>
<ul class="space-y-3 sm:space-y-4 text-gray-400 text-sm">
<li><a class="hover:text-primary hover:pl-2 transition-all inline-block" href="#">Featured Listings</a></li>
<li><a class="hover:text-primary hover:pl-2 transition-all inline-block" href="#">Sell Your Home</a></li>
<li><a class="hover:text-primary hover:pl-2 transition-all inline-block" href="#">Home Valuation</a></li>
<li><a class="hover:text-primary hover:pl-2 transition-all inline-block" href="#">About Mike</a></li>
</ul>
</div>
<div class="sm:col-span-2 lg:col-span-2">
<h4 class="font-bold text-base sm:text-lg mb-4 sm:mb-6 text-white tracking-wide">Contact</h4>
<ul class="space-y-4 sm:space-y-6 text-gray-400 text-sm">
<li class="flex items-start gap-3 sm:gap-4">
<div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0 text-xs sm:text-base">
<i class="fas fa-map-marker-alt"></i>
</div>
<span class="mt-1 sm:mt-2">123 Rodeo Drive, Suite 200<br/>Beverly Hills, CA 90210</span>
</li>
<li class="flex items-center gap-3 sm:gap-4">
<div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0 text-xs sm:text-base">
<i class="fas fa-phone-alt"></i>
</div>
<span>(310) 555-0199</span>
</li>
<li class="flex items-center gap-3 sm:gap-4">
<div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0 text-xs sm:text-base">
<i class="fas fa-envelope"></i>
</div>
<span>mike@mikekrealtor.com</span>
</li>
</ul>
</div>
</div>
<div class="border-t border-white/10 pt-6 sm:pt-8 flex flex-col sm:flex-row justify-between items-center text-xs sm:text-sm text-gray-500 gap-4">
<p>© 2025 Mike K Real Estate. All rights reserved.</p>
<div class="flex gap-6 sm:gap-8">
<a class="hover:text-white transition-colors" href="#">Privacy Policy</a>
<a class="hover:text-white transition-colors" href="#">Terms of Service</a>
</div>
</div>
</div>
</footer>
-->
<?php wp_footer(); ?>
</body>
</html>
