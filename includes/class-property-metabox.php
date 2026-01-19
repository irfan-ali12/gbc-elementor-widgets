<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class GBC_EW_Property_Metabox {

    public static function init() {
        add_action( 'add_meta_boxes', [ __CLASS__, 'add_meta_boxes' ] );
        add_action( 'save_post_property', [ __CLASS__, 'save_meta' ] );
    }

    public static function add_meta_boxes() {
        add_meta_box(
            'property_details',
            __( 'Property Information', 'gbc-elementor-widgets' ),
            [ __CLASS__, 'render_property_details' ],
            'property',
            'normal',
            'high'
        );
    }

    public static function render_property_details( $post ) {
        // Basic Info
        $listing_type = get_post_meta( $post->ID, 'property_listing_type', true ) ?: 'sale';
        $property_type = get_post_meta( $post->ID, 'property_type', true );
        $address = get_post_meta( $post->ID, 'property_address', true );
        $city = get_post_meta( $post->ID, 'property_city', true );
        
        // Sale Info
        $sale_price = get_post_meta( $post->ID, 'property_price', true );
        $beds = get_post_meta( $post->ID, 'property_beds', true );
        $baths = get_post_meta( $post->ID, 'property_baths', true );
        $sqft = get_post_meta( $post->ID, 'property_sqft', true );
        $garage = get_post_meta( $post->ID, 'property_garage', true );
        $year_built = get_post_meta( $post->ID, 'property_year_built', true );
        $lot_size = get_post_meta( $post->ID, 'property_lot_size', true );
        $hoa_fees = get_post_meta( $post->ID, 'property_hoa_fees', true );
        $mls_number = get_post_meta( $post->ID, 'property_mls_number', true );
        
        // Rent Info
        $rent_price = get_post_meta( $post->ID, 'property_rent_price', true );
        $lease_term = get_post_meta( $post->ID, 'property_lease_term', true );
        $available_date = get_post_meta( $post->ID, 'property_available_date', true );
        $utilities_included = get_post_meta( $post->ID, 'property_utilities_included', true );
        $furnished = get_post_meta( $post->ID, 'property_furnished', true );
        $pet_friendly = get_post_meta( $post->ID, 'property_pet_friendly', true );
        
        // Gallery
        $gallery = get_post_meta( $post->ID, 'property_gallery', true );
        
        // Parse gallery images
        $gallery_images = [];
        if ( $gallery ) {
            $gallery_ids = is_array( $gallery ) ? $gallery : explode( ',', $gallery );
            foreach ( $gallery_ids as $id ) {
                if ( is_numeric( $id ) ) {
                    $img_url = wp_get_attachment_image_url( $id, 'thumbnail' );
                    if ( $img_url ) {
                        $gallery_images[] = [ 'id' => $id, 'url' => $img_url ];
                    }
                }
            }
        }

        wp_nonce_field( 'property_details_nonce', 'property_details_nonce' );
        wp_enqueue_media();
        ?>
        <div style="padding: 20px;">
            <style>
                .property-section { margin-bottom: 30px; padding: 15px; background: #f9f9f9; border-left: 4px solid #5A1E96; }
                .property-section h3 { margin: 0 0 15px 0; font-size: 16px; font-weight: bold; color: #333; }
                .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px; }
                .form-row.full { grid-template-columns: 1fr; }
            </style>

            <!-- BASIC INFORMATION SECTION -->
            <div class="property-section">
                <h3>📋 Basic Information</h3>
                
                <div class="form-row full">
                    <div>
                        <label for="property_listing_type"><strong>Listing Type *</strong></label>
                        <select id="property_listing_type" name="property_listing_type" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" onchange="toggleListingType()">
                            <option value="sale" <?php selected( $listing_type, 'sale' ); ?>>For Sale</option>
                            <option value="rent" <?php selected( $listing_type, 'rent' ); ?>>For Rent</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="property_type"><strong>Property Type</strong></label>
                        <select id="property_type" name="property_type" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="">Select Type</option>
                            <option value="single-family" <?php selected( $property_type, 'single-family' ); ?>>Single Family</option>
                            <option value="condo" <?php selected( $property_type, 'condo' ); ?>>Condo / Loft</option>
                            <option value="multi-family" <?php selected( $property_type, 'multi-family' ); ?>>Multi-Family</option>
                            <option value="land" <?php selected( $property_type, 'land' ); ?>>Land</option>
                        </select>
                    </div>
                    <div>
                        <label for="property_city"><strong>City</strong></label>
                        <input type="text" id="property_city" name="property_city" value="<?php echo esc_attr( $city ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., Beverly Hills" />
                    </div>
                </div>

                <div class="form-row full">
                    <div>
                        <label for="property_address"><strong>Address *</strong></label>
                        <input type="text" id="property_address" name="property_address" value="<?php echo esc_attr( $address ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., 123 Main St, Los Angeles, CA" />
                    </div>
                </div>
            </div>

            <!-- SALE SECTION -->
            <div id="sale-section" class="property-section" style="display: <?php echo $listing_type === 'rent' ? 'none' : 'block'; ?>;">
                <h3>🏷️ Sale Information</h3>

                <div class="form-row">
                    <div>
                        <label for="property_price"><strong>Sale Price *</strong></label>
                        <input type="text" id="property_price" name="property_price" value="<?php echo esc_attr( $sale_price ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., $2,500,000" />
                    </div>
                    <div>
                        <label for="property_beds"><strong>Bedrooms</strong></label>
                        <input type="number" id="property_beds" name="property_beds" value="<?php echo esc_attr( $beds ); ?>" min="0" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" />
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="property_baths"><strong>Bathrooms</strong></label>
                        <input type="text" id="property_baths" name="property_baths" value="<?php echo esc_attr( $baths ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., 3.5" />
                    </div>
                    <div>
                        <label for="property_sqft"><strong>Square Feet</strong></label>
                        <input type="text" id="property_sqft" name="property_sqft" value="<?php echo esc_attr( $sqft ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., 4,500" />
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="property_garage"><strong>Garage Spaces</strong></label>
                        <input type="number" id="property_garage" name="property_garage" value="<?php echo esc_attr( $garage ); ?>" min="0" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" />
                    </div>
                    <div>
                        <label for="property_year_built"><strong>Year Built</strong></label>
                        <input type="number" id="property_year_built" name="property_year_built" value="<?php echo esc_attr( $year_built ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., 2022" />
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="property_lot_size"><strong>Lot Size</strong></label>
                        <input type="text" id="property_lot_size" name="property_lot_size" value="<?php echo esc_attr( $lot_size ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., 0.35 Acres" />
                    </div>
                    <div>
                        <label for="property_hoa_fees"><strong>HOA Fees (Monthly)</strong></label>
                        <input type="text" id="property_hoa_fees" name="property_hoa_fees" value="<?php echo esc_attr( $hoa_fees ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., $350" />
                    </div>
                </div>

                <div class="form-row full">
                    <div>
                        <label for="property_mls_number"><strong>MLS Number</strong></label>
                        <input type="text" id="property_mls_number" name="property_mls_number" value="<?php echo esc_attr( $mls_number ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., 23-145689" />
                    </div>
                </div>
            </div>

            <!-- RENT SECTION -->
            <div id="rent-section" class="property-section" style="display: <?php echo $listing_type === 'rent' ? 'block' : 'none'; ?>;">
                <h3>🔑 Rental Information</h3>

                <div class="form-row">
                    <div>
                        <label for="property_rent_price"><strong>Monthly Rent *</strong></label>
                        <input type="text" id="property_rent_price" name="property_rent_price" value="<?php echo esc_attr( $rent_price ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., $3,500" />
                    </div>
                    <div>
                        <label for="property_lease_term"><strong>Lease Term</strong></label>
                        <select id="property_lease_term" name="property_lease_term" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="">Select Term</option>
                            <option value="3-months" <?php selected( $lease_term, '3-months' ); ?>>3 Months</option>
                            <option value="6-months" <?php selected( $lease_term, '6-months' ); ?>>6 Months</option>
                            <option value="1-year" <?php selected( $lease_term, '1-year' ); ?>>1 Year</option>
                            <option value="2-years" <?php selected( $lease_term, '2-years' ); ?>>2 Years</option>
                            <option value="flexible" <?php selected( $lease_term, 'flexible' ); ?>>Flexible</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="property_beds"><strong>Bedrooms</strong></label>
                        <input type="number" id="property_beds" name="property_beds" value="<?php echo esc_attr( $beds ); ?>" min="0" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" />
                    </div>
                    <div>
                        <label for="property_baths"><strong>Bathrooms</strong></label>
                        <input type="text" id="property_baths" name="property_baths" value="<?php echo esc_attr( $baths ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., 3.5" />
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="property_sqft"><strong>Square Feet</strong></label>
                        <input type="text" id="property_sqft" name="property_sqft" value="<?php echo esc_attr( $sqft ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="e.g., 2,000" />
                    </div>
                    <div>
                        <label for="property_available_date"><strong>Available Date</strong></label>
                        <input type="date" id="property_available_date" name="property_available_date" value="<?php echo esc_attr( $available_date ); ?>" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" />
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="property_utilities_included"><strong>Utilities Included</strong></label>
                        <select id="property_utilities_included" name="property_utilities_included" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="">None</option>
                            <option value="water" <?php selected( $utilities_included, 'water' ); ?>>Water</option>
                            <option value="electricity" <?php selected( $utilities_included, 'electricity' ); ?>>Electricity</option>
                            <option value="all" <?php selected( $utilities_included, 'all' ); ?>>All Utilities</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label style="display: flex; align-items: center; gap: 8px; padding: 8px; background: white; border: 1px solid #ddd; border-radius: 4px; cursor: pointer;">
                            <input type="checkbox" name="property_furnished" value="1" <?php checked( $furnished, 1 ); ?> />
                            <span><strong>Furnished</strong></span>
                        </label>
                    </div>
                    <div>
                        <label style="display: flex; align-items: center; gap: 8px; padding: 8px; background: white; border: 1px solid #ddd; border-radius: 4px; cursor: pointer;">
                            <input type="checkbox" name="property_pet_friendly" value="1" <?php checked( $pet_friendly, 1 ); ?> />
                            <span><strong>Pet Friendly</strong></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- PROPERTY DETAILS SECTION -->
            <div class="property-section">
                <h3>🏠 Property Description</h3>
                <p style="color: #666; font-size: 13px; margin-bottom: 15px;">Tell buyers/renters about this property</p>
                
                <div style="margin-bottom: 15px;">
                    <label for="property_description"><strong>About This Home</strong></label>
                    <textarea id="property_description" name="property_description" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; min-height: 100px;" placeholder="Write about the property..."><?php echo esc_textarea( get_the_content( null, false, $post->ID ) ); ?></textarea>
                </div>
            </div>

            <!-- AMENITIES SECTION -->
            <div class="property-section">
                <h3>✨ Features & Amenities</h3>
                <p style="color: #666; font-size: 13px; margin-bottom: 15px;">Select the amenities available in this property</p>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px;">
                    <?php
                    $amenities = [
                        'pool' => 'Infinity Pool',
                        'ac' => 'Central Air',
                        'fireplace' => 'Fireplace',
                        'gym' => 'Home Gym',
                        'wine_cellar' => 'Wine Cellar',
                        'gated_entry' => 'Gated Entry'
                    ];
                    
                    foreach ( $amenities as $key => $label ) {
                        $value = get_post_meta( $post->ID, 'property_amenity_' . $key, true );
                        ?>
                        <label style="display: flex; align-items: center; gap: 8px; padding: 8px; background: white; border: 1px solid #ddd; border-radius: 4px; cursor: pointer;">
                            <input type="checkbox" name="property_amenity_<?php echo esc_attr( $key ); ?>" value="1" <?php checked( $value, 1 ); ?> />
                            <span><?php echo esc_html( $label ); ?></span>
                        </label>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <!-- GALLERY SECTION -->
            <div class="property-section">
                <h3>🖼️ Gallery Images</h3>
                <div id="property_gallery" style="margin-bottom: 15px; display: flex; flex-wrap: wrap; gap: 10px;">
                    <?php foreach ( $gallery_images as $img ) : ?>
                        <div style="position: relative; width: 100px; height: 100px; border: 2px solid #ddd; border-radius: 4px; overflow: hidden;">
                            <img src="<?php echo esc_url( $img['url'] ); ?>" style="width: 100%; height: 100%; object-fit: cover;" />
                            <button type="button" class="remove-gallery-image" data-image-id="<?php echo esc_attr( $img['id'] ); ?>" style="position: absolute; top: 0; right: 0; background: red; color: white; border: none; padding: 2px 6px; cursor: pointer; font-size: 12px;">×</button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <input type="hidden" id="property_gallery_ids" name="property_gallery" value="<?php echo esc_attr( is_array( $gallery ) ? implode( ',', $gallery ) : $gallery ); ?>" />
                <button type="button" id="upload_gallery_button" class="button button-primary" style="margin-right: 10px;">
                    <?php _e( '+ Upload Gallery Images', 'gbc-elementor-widgets' ); ?>
                </button>
            </div>
        </div>

        <script>
        function toggleListingType() {
            const type = document.getElementById('property_listing_type').value;
            document.getElementById('sale-section').style.display = type === 'sale' ? 'block' : 'none';
            document.getElementById('rent-section').style.display = type === 'rent' ? 'block' : 'none';
        }

        jQuery(document).ready(function($) {
            let frame;

            $('#upload_gallery_button').on('click', function(e) {
                e.preventDefault();

                if (frame) {
                    frame.open();
                    return;
                }

                frame = wp.media({
                    title: '<?php _e( 'Select or Upload Gallery Images', 'gbc-elementor-widgets' ); ?>',
                    button: {
                        text: '<?php _e( 'Add to Gallery', 'gbc-elementor-widgets' ); ?>'
                    },
                    multiple: true
                });

                frame.on('select', function() {
                    const attachments = frame.state().get('selection').toJSON();
                    let galleryIds = $('#property_gallery_ids').val() ? $('#property_gallery_ids').val().split(',') : [];

                    $.each(attachments, function(i, attachment) {
                        if (galleryIds.indexOf(attachment.id.toString()) === -1) {
                            galleryIds.push(attachment.id);
                            addGalleryImagePreview(attachment.id, attachment.url);
                        }
                    });

                    $('#property_gallery_ids').val(galleryIds.join(','));
                });

                frame.open();
            });

            $(document).on('click', '.remove-gallery-image', function(e) {
                e.preventDefault();
                const imageId = $(this).data('image-id');
                const ids = $('#property_gallery_ids').val().split(',');
                const newIds = ids.filter(id => id !== imageId.toString());
                $('#property_gallery_ids').val(newIds.join(','));
                $(this).closest('div[style*="position: relative"]').remove();
            });

            function addGalleryImagePreview(imageId, imageUrl) {
                const preview = '<div style="position: relative; width: 100px; height: 100px; border: 2px solid #ddd; border-radius: 4px; overflow: hidden;">' +
                    '<img src="' + imageUrl + '" style="width: 100%; height: 100%; object-fit: cover;" />' +
                    '<button type="button" class="remove-gallery-image" data-image-id="' + imageId + '" style="position: absolute; top: 0; right: 0; background: red; color: white; border: none; padding: 2px 6px; cursor: pointer; font-size: 12px;">×</button>' +
                    '</div>';
                $('#property_gallery').append(preview);
            }
        });
        </script>
        <?php
    }

    public static function save_meta( $post_id ) {
        // Prevent recursion from wp_update_post
        if ( defined( 'PROPERTY_SAVING' ) && PROPERTY_SAVING ) {
            return;
        }

        if ( ! isset( $_POST['property_details_nonce'] ) || ! wp_verify_nonce( $_POST['property_details_nonce'], 'property_details_nonce' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Verify post type is 'property'
        $post = get_post( $post_id );
        if ( ! $post || 'property' !== $post->post_type ) {
            return;
        }

        // Set flag to prevent recursion
        define( 'PROPERTY_SAVING', true );

        $fields = [
            'property_listing_type',
            'property_type',
            'property_address',
            'property_city',
            'property_price',
            'property_beds',
            'property_baths',
            'property_sqft',
            'property_garage',
            'property_year_built',
            'property_lot_size',
            'property_hoa_fees',
            'property_mls_number',
            'property_rent_price',
            'property_lease_term',
            'property_available_date',
            'property_utilities_included',
            'property_gallery'
        ];

        foreach ( $fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
            }
        }

        // Save description if provided (without triggering save_post_property hook again)
        if ( isset( $_POST['property_description'] ) ) {
            // Temporarily remove the hook to prevent infinite recursion
            remove_action( 'save_post_property', [ __CLASS__, 'save_meta' ] );
            
            wp_update_post( array(
                'ID' => $post_id,
                'post_content' => wp_kses_post( $_POST['property_description'] )
            ) );
            
            // Re-add the hook
            add_action( 'save_post_property', [ __CLASS__, 'save_meta' ] );
        }

        // Save amenities - explicitly check each one
        $amenities = [ 'pool', 'ac', 'fireplace', 'gym', 'wine_cellar', 'gated_entry' ];
        foreach ( $amenities as $amenity ) {
            $key = 'property_amenity_' . $amenity;
            // Explicitly check if checkbox is in POST (checked) or not (unchecked)
            if ( isset( $_POST[ $key ] ) && $_POST[ $key ] == '1' ) {
                update_post_meta( $post_id, $key, '1' );
            } else {
                // Delete the meta if not checked
                delete_post_meta( $post_id, $key );
            }
        }

        // Save rental-specific fields
        if ( isset( $_POST['property_furnished'] ) && $_POST['property_furnished'] == '1' ) {
            update_post_meta( $post_id, 'property_furnished', '1' );
        } else {
            delete_post_meta( $post_id, 'property_furnished' );
        }

        if ( isset( $_POST['property_pet_friendly'] ) && $_POST['property_pet_friendly'] == '1' ) {
            update_post_meta( $post_id, 'property_pet_friendly', '1' );
        } else {
            delete_post_meta( $post_id, 'property_pet_friendly' );
        }
    }
}
