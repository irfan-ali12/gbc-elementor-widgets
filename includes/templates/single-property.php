<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$property_id = get_the_ID();
$listing_type = get_post_meta( $property_id, 'property_listing_type', true ) ?: 'sale';
$property_type = get_post_meta( $property_id, 'property_type', true );
$address = get_post_meta( $property_id, 'property_address', true );
$city = get_post_meta( $property_id, 'property_city', true );

// Sale Info
$sale_price = get_post_meta( $property_id, 'property_price', true );
$beds = get_post_meta( $property_id, 'property_beds', true );
$baths = get_post_meta( $property_id, 'property_baths', true );
$sqft = get_post_meta( $property_id, 'property_sqft', true );
$garage = get_post_meta( $property_id, 'property_garage', true ) ?: '2';
$year_built = get_post_meta( $property_id, 'property_year_built', true ) ?: '2022';
$lot_size = get_post_meta( $property_id, 'property_lot_size', true ) ?: '0.35 Acres';
$hoa_fees = get_post_meta( $property_id, 'property_hoa_fees', true ) ?: '$350/mo';
$mls_number = get_post_meta( $property_id, 'property_mls_number', true ) ?: '23-145689';

// Rent Info
$rent_price = get_post_meta( $property_id, 'property_rent_price', true );
$lease_term = get_post_meta( $property_id, 'property_lease_term', true );
$available_date = get_post_meta( $property_id, 'property_available_date', true );
$utilities_included = get_post_meta( $property_id, 'property_utilities_included', true );
$furnished = get_post_meta( $property_id, 'property_furnished', true );
$pet_friendly = get_post_meta( $property_id, 'property_pet_friendly', true );

$gallery = get_post_meta( $property_id, 'property_gallery', true );
$thumbnail = get_the_post_thumbnail_url( $property_id, 'large' ) ?: 'https://via.placeholder.com/1200x800';

$gallery_images = [ $thumbnail ];
if ( $gallery ) {
    $gallery_ids = is_array( $gallery ) ? $gallery : explode( ',', $gallery );
    foreach ( $gallery_ids as $id ) {
        if ( is_numeric( $id ) ) {
            $img_url = wp_get_attachment_image_url( $id, 'large' );
            if ( $img_url ) {
                $gallery_images[] = $img_url;
            }
        }
    }
}

$estimated_payment = $sale_price ? number_format( intval( str_replace( ['$', ','], '', $sale_price ) ) / 360, 0 ) : 0;
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
                    "purple-gradient": "linear-gradient(135deg, #6B21A8 0%, #A855F7 100%)",
                }
            }
        }
    };
    </script>
    <style>
    .gallery-modal-image { max-height: 80vh; max-width: 90vw; object-fit: contain; width: 100%; height: auto; }
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
<a class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-white font-medium text-sm tracking-wide transition-colors" href="<?php echo home_url( '/properties/' ); ?>">Properties</a>
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

<!-- Header -->
<header class="pt-32 pb-8 bg-background-light dark:bg-background-dark">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<nav class="flex items-center gap-2 text-xs sm:text-sm text-text-light/60 dark:text-text-dark/60 mb-6">
<a class="hover:text-primary" href="<?php echo home_url(); ?>">Home</a>
<i class="fas fa-chevron-right text-[8px] sm:text-[10px] text-gray-300 dark:text-gray-700"></i>
<a class="hover:text-primary" href="<?php echo home_url( '/properties/' ); ?>">Properties</a>
<i class="fas fa-chevron-right text-[8px] sm:text-[10px] text-gray-300 dark:text-gray-700"></i>
<span class="text-text-light dark:text-text-dark font-semibold"><?php the_title(); ?></span>
</nav>

<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 lg:gap-8 mb-8">
<div class="space-y-3 lg:space-y-4">
<div class="flex items-center gap-3 flex-wrap">
<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 uppercase tracking-wide border border-green-200 dark:border-green-500/20">
<span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5 animate-pulse"></span>
<?php echo $listing_type === 'rent' ? 'For Rent' : 'For Sale'; ?>
</span>
<?php if ( ! empty( $property_type ) ) : ?>
<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-50 dark:bg-primary/10 text-primary dark:text-secondary uppercase tracking-wide border border-purple-100 dark:border-primary/20">
<?php echo esc_html( $property_type ); ?>
</span>
<?php endif; ?>
<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-50 dark:bg-primary/10 text-primary dark:text-secondary uppercase tracking-wide border border-purple-100 dark:border-primary/20">
<i class="fas fa-star mr-1.5 text-[9px]"></i>
Featured
</span>
</div>
<h1 class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-text-light dark:text-text-dark tracking-tight"><?php the_title(); ?></h1>
<p class="text-base sm:text-lg text-text-light/70 dark:text-text-dark/70 flex items-center gap-2 font-medium">
<i class="fas fa-map-marker-alt text-primary/80"></i> <?php echo esc_html( $address . ( $city ? ', ' . $city : '' ) ); ?>
</p>
</div>
<div class="flex flex-col lg:items-end gap-2">
<?php if ( $listing_type === 'rent' ) : ?>
<p class="text-3xl md:text-4xl font-display font-bold text-transparent bg-clip-text bg-purple-gradient"><?php echo esc_html( $rent_price ?: 'Contact for Price' ); ?>/mo</p>
<?php else : ?>
<p class="text-3xl md:text-4xl font-display font-bold text-transparent bg-clip-text bg-purple-gradient"><?php echo esc_html( $sale_price ?: 'Contact for Price' ); ?></p>
<?php if ( $estimated_payment ) : ?>
<p class="text-sm text-text-light/60 dark:text-text-dark/60 font-medium">Est. Payment: $<?php echo $estimated_payment; ?>/mo</p>
<?php endif; ?>
<?php endif; ?>
</div>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 sm:p-6 rounded-2xl bg-white dark:bg-surface-dark border border-gray-100 dark:border-white/10 shadow-sm">
<div class="flex items-center gap-4">
<div class="w-12 h-12 rounded-full bg-purple-50 dark:bg-primary/10 flex items-center justify-center text-primary border border-purple-100 dark:border-primary/20">
<span class="material-icons">bed</span>
</div>
<div>
<p class="text-xl sm:text-2xl font-bold text-text-light dark:text-text-dark leading-none"><?php echo intval( $beds ); ?></p>
<p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 mt-1 font-semibold">Bedrooms</p>
</div>
</div>
<div class="flex items-center gap-4 border-l border-gray-100 dark:border-white/10 pl-4">
<div class="w-12 h-12 rounded-full bg-purple-50 dark:bg-primary/10 flex items-center justify-center text-primary border border-purple-100 dark:border-primary/20">
<span class="material-icons">bathtub</span>
</div>
<div>
<p class="text-xl sm:text-2xl font-bold text-text-light dark:text-text-dark leading-none"><?php echo esc_html( $baths ); ?></p>
<p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 mt-1 font-semibold">Bathrooms</p>
</div>
</div>
<div class="flex items-center gap-4 border-l border-gray-100 dark:border-white/10 pl-4">
<div class="w-12 h-12 rounded-full bg-purple-50 dark:bg-primary/10 flex items-center justify-center text-primary border border-purple-100 dark:border-primary/20">
<span class="material-icons">square_foot</span>
</div>
<div>
<p class="text-xl sm:text-2xl font-bold text-text-light dark:text-text-dark leading-none"><?php echo esc_html( $sqft ); ?></p>
<p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 mt-1 font-semibold">Sq Ft</p>
</div>
</div>
<div class="flex items-center gap-4 border-l border-gray-100 dark:border-white/10 pl-4">
<div class="w-12 h-12 rounded-full bg-purple-50 dark:bg-primary/10 flex items-center justify-center text-primary border border-purple-100 dark:border-primary/20">
<span class="material-icons">garage</span>
</div>
<div>
<p class="text-xl sm:text-2xl font-bold text-text-light dark:text-text-dark leading-none"><?php echo esc_html( $garage ); ?></p>
<p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 mt-1 font-semibold">Garage</p>
</div>
</div>
</div>
</div>
</header>

<!-- Gallery Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
<div class="grid grid-cols-1 md:grid-cols-4 gap-4" style="grid-template-rows: 500px;">
<!-- Main Gallery Image -->
<div class="md:col-span-3 h-full">
<div class="relative group overflow-hidden rounded-3xl cursor-pointer shadow-sm border border-gray-100 dark:border-white/10 h-full w-full">
<img alt="Main Property Image" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" onclick="openGallery(0)" src="<?php echo esc_url( $gallery_images[0] ); ?>"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
<?php if ( count( $gallery_images ) > 1 ) : ?>
<button class="absolute bottom-6 right-6 bg-white/20 dark:bg-black/40 backdrop-blur-md border border-white/40 dark:border-white/10 text-white px-4 py-2 rounded-lg font-bold flex items-center gap-2 hover:bg-white/30 dark:hover:bg-black/60 transition-all opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 duration-300 shadow-lg" onclick="openGallery(0)">
<i class="fas fa-expand"></i> View Gallery
</button>
<?php endif; ?>
</div>
</div>

<!-- Thumbnail Gallery -->
<?php if ( count( $gallery_images ) > 1 ) : ?>
<div class="hidden md:flex flex-col gap-4 h-full">
<?php
$thumb_images = array_slice( $gallery_images, 1, 2 );
for ( $i = 0; $i < 2; $i++ ) :
    $img_idx = $i + 1;
    $img = isset( $thumb_images[$i] ) ? $thumb_images[$i] : '';
    $is_last = ( $i === 1 );
    $remaining = count( $gallery_images ) - 3;
?>
<div class="flex-1 relative group overflow-hidden rounded-3xl cursor-pointer shadow-sm border border-gray-100 dark:border-white/10">
<?php if ( $img ) : ?>
<img alt="Gallery Image" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" onclick="openGallery(<?php echo $img_idx; ?>)" src="<?php echo esc_url( $img ); ?>"/>
<?php endif; ?>
<?php if ( $is_last && $remaining > 0 ) : ?>
<div class="absolute inset-0 flex items-center justify-center bg-black/30 hover:bg-black/20 transition-colors cursor-pointer" onclick="openGallery(<?php echo $img_idx; ?>)">
<span class="text-white font-bold text-lg drop-shadow-md">+<?php echo $remaining; ?></span>
</div>
<?php endif; ?>
</div>
<?php endfor; ?>
</div>
<?php endif; ?>
</div>
</section>

<!-- Main Content -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
<!-- Left Column -->
<div class="lg:col-span-2 space-y-12">
<!-- About -->
<div class="bg-white dark:bg-surface-dark p-6 sm:p-8 rounded-3xl shadow-sm border border-gray-100 dark:border-white/10">
<h2 class="text-2xl sm:text-3xl font-display font-bold text-text-light dark:text-text-dark mb-6">About this home</h2>
<div class="prose prose-sm sm:prose max-w-none text-text-light/70 dark:text-text-dark/70 font-light leading-relaxed">
<?php the_content(); ?>
</div>
</div>

<!-- Features & Amenities -->
<div>
<h2 class="text-2xl sm:text-3xl font-display font-bold text-text-light dark:text-text-dark mb-6">Features & Amenities</h2>
<?php
$amenities = [
    'pool' => ['icon' => 'pool', 'name' => 'Infinity Pool'],
    'ac' => ['icon' => 'ac_unit', 'name' => 'Central Air'],
    'fireplace' => ['icon' => 'fireplace', 'name' => 'Fireplace'],
    'gym' => ['icon' => 'fitness_center', 'name' => 'Home Gym'],
    'wine_cellar' => ['icon' => 'wine_bar', 'name' => 'Wine Cellar'],
    'gated_entry' => ['icon' => 'security', 'name' => 'Gated Entry']
];

$amenities_found = [];
foreach ( $amenities as $key => $amenity ) {
    if ( get_post_meta( $property_id, 'property_amenity_' . $key, true ) ) {
        $amenities_found[] = $amenity;
    }
}

if ( ! empty( $amenities_found ) ) {
    echo '<div class="grid grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">';
    foreach ( $amenities_found as $amenity ) {
        ?>
        <div class="flex items-center gap-3 p-4 rounded-2xl bg-white dark:bg-surface-dark border border-gray-100 dark:border-white/10 shadow-sm hover:shadow-md transition-shadow">
            <span class="material-icons text-primary text-2xl"><?php echo esc_attr( $amenity['icon'] ); ?></span>
            <span class="text-sm font-semibold text-text-light dark:text-text-dark"><?php echo esc_html( $amenity['name'] ); ?></span>
        </div>
        <?php
    }
    echo '</div>';
} else {
    echo '<p class="text-gray-500 dark:text-gray-400 text-center py-6 px-4 bg-gray-50 dark:bg-white/5 rounded-2xl">No amenities selected for this property</p>';
}
?>
</div>

<!-- Property Details Table -->
<div>
<h2 class="text-2xl sm:text-3xl font-display font-bold text-text-light dark:text-text-dark mb-6"><?php echo $listing_type === 'rent' ? 'Rental Details' : 'Property Details'; ?></h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 text-sm bg-white dark:bg-surface-dark p-6 rounded-3xl border border-gray-100 dark:border-white/10 shadow-sm">

<?php if ( $listing_type === 'sale' ) : ?>
<!-- SALE DETAILS -->
<div class="flex justify-between py-3 border-b border-gray-100 dark:border-white/10">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">Property Type</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo esc_html( $property_type ?: 'Single Family' ); ?></span>
</div>
<div class="flex justify-between py-3 border-b border-gray-100 dark:border-white/10">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">Year Built</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo esc_html( $year_built ); ?></span>
</div>
<div class="flex justify-between py-3 border-b border-gray-100 dark:border-white/10">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">Lot Size</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo esc_html( $lot_size ); ?></span>
</div>
<div class="flex justify-between py-3 border-b border-gray-100 dark:border-white/10">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">HOA Fees</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo esc_html( $hoa_fees ); ?></span>
</div>
<div class="flex justify-between py-3 border-b border-gray-100 dark:border-white/10">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">MLS #</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo esc_html( $mls_number ); ?></span>
</div>
<div class="flex justify-between py-3">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">Parking</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo esc_html( $garage ); ?> Garage, 2 Driveway</span>
</div>

<?php else : ?>
<!-- RENT DETAILS -->
<div class="flex justify-between py-3 border-b border-gray-100 dark:border-white/10">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">Property Type</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo esc_html( $property_type ?: 'Single Family' ); ?></span>
</div>
<div class="flex justify-between py-3 border-b border-gray-100 dark:border-white/10">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">Lease Term</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo esc_html( $lease_term ?: 'Flexible' ); ?></span>
</div>
<div class="flex justify-between py-3 border-b border-gray-100 dark:border-white/10">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">Available Date</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo $available_date ? date( 'M d, Y', strtotime( $available_date ) ) : 'Immediately'; ?></span>
</div>
<div class="flex justify-between py-3 border-b border-gray-100 dark:border-white/10">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">Utilities</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo esc_html( $utilities_included ?: 'Not Included' ); ?></span>
</div>
<div class="flex justify-between py-3">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">Furnished</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo $furnished ? 'Furnished' : 'Unfurnished'; ?></span>
</div>
<div class="flex justify-between py-3">
<span class="text-text-light/60 dark:text-text-dark/60 font-medium">Pet Friendly</span>
<span class="font-bold text-text-light dark:text-text-dark"><?php echo $pet_friendly ? 'Yes' : 'No'; ?></span>
</div>
<?php endif; ?>

</div>
</div>
</div>

<!-- Right Sidebar -->
<div class="lg:col-span-1">
<div class="sticky top-32">
<div class="bg-white dark:bg-surface-dark rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100 dark:border-white/10">
<div class="flex items-center gap-4 mb-6">
<div class="relative">
<img alt="Agent Photo" class="w-16 h-16 rounded-full object-cover border-2 border-primary p-0.5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgbx3j-DyaNSfFGUmzIHS3kNMTpqEnFvevRmlWl73tsETpuDFeLZUsRJ1vXUd3oyov1AIGZxuG8nH5qlavFCoCaiIvkSV8IBDiOZaZ-GrtPpvH2xaODacq4VOnUL7f2RcZouLH4_d4GyhyjGNR7oeLc4WGDVc7kJ9CG1ieD6IJ33adX2UClfdu1vpgDgzk-8T4bOY5J9NZuBpACQDnK1wo-z127pqW3zHBleJDW95Jh9qhfTJPlmOfWVx7MylAHEnOY4ObYRKbBa4"/>
<div class="absolute -bottom-1 -right-1 bg-green-500 w-4 h-4 rounded-full border-2 border-white dark:border-surface-dark"></div>
</div>
<div>
<p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Listing Agent</p>
<h3 class="font-display font-bold text-xl text-text-light dark:text-text-dark">Mike K</h3>
<div class="flex text-xs text-primary gap-0.5 mt-0.5">
<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
</div>
</div>
</div>

<form id="property-contact-form" class="space-y-4 mb-6">
<div>
<label class="sr-only">Name</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 dark:text-gray-600">
<i class="far fa-user"></i>
</span>
<input id="contact_name" name="contact_name" class="w-full pl-12 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:ring-2 focus:ring-primary focus:border-transparent text-text-light dark:text-text-dark placeholder-gray-400 dark:placeholder-gray-600" placeholder="Your Name" type="text" required style="padding-left: 30px !important;"/>
</div>
</div>
<div>
<label class="sr-only">Email</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 dark:text-gray-600">
<i class="far fa-envelope"></i>
</span>
<input id="contact_email" name="contact_email" class="w-full pl-12 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:ring-2 focus:ring-primary focus:border-transparent text-text-light dark:text-text-dark placeholder-gray-400 dark:placeholder-gray-600" placeholder="Your Email" type="email" required style="padding-left: 30px !important;"/>
</div>
</div>
<div>
<label class="sr-only">Phone</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 dark:text-gray-600">
<i class="fas fa-phone-alt text-xs"></i>
</span>
<input id="contact_phone" name="contact_phone" class="w-full pl-12 py-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:ring-2 focus:ring-primary focus:border-transparent text-text-light dark:text-text-dark placeholder-gray-400 dark:placeholder-gray-600" placeholder="Your Phone" type="tel" style="padding-left: 30px !important;"/>
</div>
</div>
<div>
<label class="sr-only">Message</label>
<textarea id="contact_message" name="contact_message" class="w-full p-3 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl text-sm focus:ring-2 focus:ring-primary focus:border-transparent text-text-light dark:text-text-dark placeholder-gray-400 dark:placeholder-gray-600 resize-none" placeholder="I am interested in this property..." rows="3"></textarea>
</div>
<button id="schedule-tour-btn" class="w-full py-3.5 bg-purple-gradient text-white font-bold rounded-xl shadow-glow hover:shadow-lg transition-all transform hover:-translate-y-0.5" type="button">
Schedule a Tour
</button>
<div id="form-response" class="hidden p-4 rounded-xl text-center font-medium"></div>
</form>
<div class="flex gap-2">
<button id="ask-question-btn" class="flex-1 py-2.5 bg-transparent border border-gray-200 dark:border-white/10 text-gray-900 dark:text-text-dark font-bold rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 hover:text-primary transition-colors text-sm" type="button" onclick="location.href='<?php echo esc_url( home_url( '/contact/' ) ); ?>'">
Ask a Question
</button>
</div>

<div class="mt-6 pt-6 border-t border-gray-100 dark:border-white/10 text-center">
<p class="text-xs text-gray-500 dark:text-gray-400 mb-2 font-medium">Or call me directly</p>
<a class="font-display font-bold text-lg text-text-light dark:text-text-dark hover:text-primary transition-colors" href="tel:3105550199">(310) 555-0199</a>
</div>
</div>
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
<p>© 2024 Mike K Real Estate. All rights reserved.</p>
<div class="flex gap-6 sm:gap-8">
<a class="hover:text-white transition-colors" href="#">Privacy Policy</a>
<a class="hover:text-white transition-colors" href="#">Terms of Service</a>
</div>
</div>
</div>
</footer>
-->

<!-- Gallery Modal - Responsive -->
<?php if ( ! empty( $gallery_images ) ) : ?>
<div id="galleryModal" class="hidden fixed inset-0 z-50 bg-black/95 flex items-center justify-center p-4 lg:p-6">
<button onclick="closeGallery()" class="absolute top-4 lg:top-8 right-4 lg:right-8 text-white text-2xl lg:text-4xl hover:opacity-70 transition-opacity z-10">
<i class="fas fa-times"></i>
</button>

<div class="relative w-full h-full flex flex-col items-center justify-center">
<img id="modalImage" src="<?php echo esc_url( $gallery_images[0] ); ?>" alt="Gallery" class="gallery-modal-image object-contain w-full h-full"/>

<div class="absolute bottom-0 left-0 right-0 flex justify-between items-center p-4 lg:p-8 bg-gradient-to-t from-black to-transparent w-full">
<button onclick="prevImage()" class="px-4 lg:px-6 py-2 lg:py-3 bg-white/10 hover:bg-white/20 rounded-lg font-bold transition text-white text-sm lg:text-base">
<i class="fas fa-chevron-left mr-2"></i> Previous
</button>
<span id="imageCounter" class="text-lg lg:text-xl font-bold text-white">1 / <?php echo count( $gallery_images ); ?></span>
<button onclick="nextImage()" class="px-4 lg:px-6 py-2 lg:py-3 bg-white/10 hover:bg-white/20 rounded-lg font-bold transition text-white text-sm lg:text-base">
Next <i class="fas fa-chevron-right ml-2"></i>
</button>
</div>
</div>
</div>

<script>
let currentImageIndex = 0;
const galleryImages = <?php echo wp_json_encode( $gallery_images ); ?>;

function openGallery(index = 0) {
    currentImageIndex = index;
    document.getElementById('galleryModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    updateGalleryImage();
}

function closeGallery() {
    document.getElementById('galleryModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    updateGalleryImage();
}

function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
    updateGalleryImage();
}

function updateGalleryImage() {
    const img = document.getElementById('modalImage');
    img.style.opacity = '0';
    setTimeout(() => {
        img.src = galleryImages[currentImageIndex];
        img.style.opacity = '1';
    }, 150);
    document.getElementById('imageCounter').textContent = (currentImageIndex + 1) + ' / ' + galleryImages.length;
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (document.getElementById('galleryModal').classList.contains('hidden')) return;
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') prevImage();
    if (e.key === 'Escape') closeGallery();
});

// Add smooth transition
document.getElementById('modalImage').style.transition = 'opacity 0.3s ease-in-out';
</script>
<?php endif; ?>

<script>
// Contact Form Handler
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('property-contact-form');
    const tourBtn = document.getElementById('schedule-tour-btn');
    const responseDiv = document.getElementById('form-response');
    
    function submitForm(type) {
        const name = document.getElementById('contact_name').value.trim();
        const email = document.getElementById('contact_email').value.trim();
        const phone = document.getElementById('contact_phone').value.trim();
        const message = document.getElementById('contact_message').value.trim();
        
        // Validation
        if (!name || !email || !message) {
            showResponse('Please fill in all required fields', 'error');
            return;
        }
        
        if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            showResponse('Please enter a valid email address', 'error');
            return;
        }
        
        // Disable button and show loading state
        const btn = type === 'tour' ? tourBtn : questionBtn;
        const originalText = btn.textContent;
        btn.disabled = true;
        btn.textContent = 'Sending...';
        
        // Send AJAX request
        const formData = new FormData();
        formData.append('action', 'gbc_property_contact');
        formData.append('property_id', '<?php echo $property_id; ?>');
        formData.append('contact_name', name);
        formData.append('contact_email', email);
        formData.append('contact_phone', phone);
        formData.append('contact_message', message);
        formData.append('contact_type', type);
        formData.append('nonce', '<?php echo wp_create_nonce('gbc_property_contact'); ?>');
        
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showResponse('Message sent successfully! We will contact you soon.', 'success');
                form.reset();
            } else {
                showResponse(data.data || 'Error sending message. Please try again.', 'error');
            }
        })
        .catch(error => {
            showResponse('Error sending message. Please try again.', 'error');
        })
        .finally(() => {
            btn.disabled = false;
            btn.textContent = originalText;
        });
    }
    
    function showResponse(message, type) {
        responseDiv.textContent = message;
        responseDiv.className = type === 'success' 
            ? 'p-4 rounded-xl text-center font-medium bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300' 
            : 'p-4 rounded-xl text-center font-medium bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300';
        
        if (type === 'success') {
            setTimeout(() => {
                responseDiv.classList.add('hidden');
            }, 3000);
        }
    }
    
    tourBtn.addEventListener('click', (e) => {
        e.preventDefault();
        submitForm('tour');
    });
    
    questionBtn.addEventListener('click', (e) => {
        e.preventDefault();
        submitForm('question');
    });
});
</script>
<?php wp_footer(); ?>
</body>
</html>
