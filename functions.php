<?php

function theme_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' ); 
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) ); 
} 
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * Remove related and uplsell products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

/**
 * Disable the Search Box in the Storefront Theme
 */
add_action( 'init', 'remove_storefront_header_search' );

function remove_storefront_header_search() {
    remove_action( 'storefront_header', 'storefront_product_search', 40 );
}


function exclude_product_cat_children($wp_query) {
	if ( isset ( $wp_query->query_vars['product_cat'] ) && $wp_query->is_main_query()) {
    	$wp_query->set('tax_query', array(
            array (
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $wp_query->query_vars['product_cat'],
                'include_children' => false
            )
		) );
  	}
}

add_filter('pre_get_posts', 'exclude_product_cat_children', PHP_INT_MAX );



	/**
	 * The primary navigation wrapper
	 */
	function storefront_primary_navigation_wrapper() {//remove col-full
		echo '<div class="storefront-primary-navigation">';
	}


	/**
	 * The primary navigation wrapper close
	 */
	function storefront_primary_navigation_wrapper_close() {
		echo '</div>';
	}



	/**
	 * The header container
	 */
	function storefront_header_container() {//remove col-full
		echo '<div class="site-branding-wrapper">'; //custom class
	}


	/**
	 * The header container close
	 */
	/*function storefront_header_container_close() {
		echo '</div>';
	}*/

	add_post_type_support( 'page', 'excerpt' );

add_filter( 'wpcf7_autop_or_not', '__return_false' );

// Our custom post type function
function create_posttype() {
  
    register_post_type( 'team-members',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Team Members' ),
                'singular_name' => __( 'Team Member' ),
				'add_new_item' => __( 'Add New Team Member'),
            ),
            'public' => true,
            'has_archive' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );



