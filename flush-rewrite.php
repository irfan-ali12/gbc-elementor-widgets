<?php
// Load WordPress
require_once '../../../../wp-load.php';

// Ensure property post type is registered
if ( function_exists( 'register_post_type' ) ) {
    $labels = [
        'name'               => 'Properties',
        'singular_name'      => 'Property',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'rewrite'            => [ 'slug' => 'properties', 'with_front' => false ],
        'capability_type'    => 'post',
        'has_archive'        => 'properties',
        'hierarchical'       => false,
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
    ];

    register_post_type( 'property', $args );
}

// Flush rewrite rules
flush_rewrite_rules();

echo "Rewrite rules flushed successfully!";
