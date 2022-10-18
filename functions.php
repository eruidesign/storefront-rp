<?php


use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_post_meta' );
function crb_attach_post_meta() {
    Container::make( 'post_meta', __('Audio Preview') )
        ->where( 'post_type', 'IN', array('product') )
        ->where( 'post_term', 'IN', array(
            'field' => 'slug',
            'value' => 'seasons',
            'taxonomy' => 'product_cat',
        ) )
        ->add_fields(array(
            Field::make( 'text', 'crb_audio_preview', __( 'Audi Preview File Name' ) )
    ));
}

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


//add_action('wp_enqueue_scripts', 'wooswipe_scripts_method');
remove_action('wp_enqueue_scripts', 'wooswipe_scripts_method');


// Remove the callback function from the hook
//remove_action( 'after_setup_theme', 'mytheme_setup' );

// Copy the function, rename and do what you need
function my_wooswipe_scripts_method()
{
    $wooswipe_wp_plugin_path =  plugins_url() . '/wooswipe';
    $options = get_option('wooswipe_options');

    //if ((is_woocommerce() && is_product()) || wc_post_content_has_shortcode('product_page')) {
        wp_enqueue_style('pswp-css', $wooswipe_wp_plugin_path . '/pswp/photoswipe.css');

        if ($options['white_theme']) wp_enqueue_style('white_theme', $wooswipe_wp_plugin_path . '/pswp/white-skin/skin.css');
        else wp_enqueue_style('pswp-skin', $wooswipe_wp_plugin_path . '/pswp/default-skin/default-skin.css');
        wp_enqueue_style('slick-css', $wooswipe_wp_plugin_path . '/slick/slick.css');
        wp_enqueue_style('slick-theme', $wooswipe_wp_plugin_path . '/slick/slick-theme.css');

        wp_enqueue_script('pswp', $wooswipe_wp_plugin_path . '/pswp/photoswipe.min.js', null, null, true);
        wp_enqueue_script('pswp-ui', $wooswipe_wp_plugin_path . '/pswp/photoswipe-ui-default.min.js', null, null, true);

        wp_enqueue_script('slick', $wooswipe_wp_plugin_path . '/slick/slick.min.js', null, null, true);

        wp_enqueue_style('wooswipe-css', $wooswipe_wp_plugin_path . '/wooswipe.css');


        //after wp_enqueue_script
        $template_Url = array('templateUrl' => $wooswipe_wp_plugin_path);
        $wooswipe_data = array();
        if ($options['pinterest']) {
            $wooswipe_data = array('addpin' => true);
        } else {
            $wooswipe_data = array('addpin' => false);
        }

        if (!empty($options['icon_bg_color'])) {
            $wooswipe_data['icon_bg_color'] = $options['icon_bg_color'];
        } else {
            $wooswipe_data['icon_bg_color'] = '#000000';
        }

        if (!empty($options['icon_stroke_color'])) {
            $wooswipe_data['icon_stroke_color'] = $options['icon_stroke_color'];
        } else {
            $wooswipe_data['icon_stroke_color'] = '#ffffff';
        }

        
        if ($options['product_main_slider'] == true) {
            if ($options['product_main_slider_nav_arrow'] == true) {
                $wooswipe_data['product_main_slider_nav_arrow'] = true;
            }
            $wooswipe_data['product_main_slider'] =  true;
            wp_enqueue_script('wooswipe-main-image-swipe-js', $wooswipe_wp_plugin_path . '/wooswipe-main_image_swipe.js', null, null, true);
            wp_localize_script('wooswipe-main-image-swipe-js', 'wooswipe_wp_plugin_path', $template_Url);
            wp_localize_script('wooswipe-main-image-swipe-js', 'wooswipe_data', $wooswipe_data);
        } else {
            $wooswipe_data['product_main_slider'] =  false;
            wp_enqueue_script('wooswipe-js', $wooswipe_wp_plugin_path . '/wooswipe.js', null, null, true);
            wp_localize_script('wooswipe-js', 'wooswipe_wp_plugin_path', $template_Url);
            wp_localize_script('wooswipe-js', 'wooswipe_data', $wooswipe_data);
        }
    //}
}

// Rehook your custom callback
add_action( 'wp_enqueue_scripts', 'my_wooswipe_scripts_method' );

/*add_action( 'woocommerce_shop_loop_item_title', 'add_product_description_products_shortcode', 20 );
function add_product_description_products_shortcode() {
    global $product, $woocommerce_loop;
    
    if( isset($woocommerce_loop['is_shortcode']) && $woocommerce_loop['is_shortcode'] == '1'
    &&  isset($woocommerce_loop['name']) && $woocommerce_loop['name'] === 'products') {
        echo '<p class="product-description">' . $product->get_short_description() . '</p>';
    }
}*/

/** Custom Image Sizes **/
add_image_size('banner-1440x600', 1440, 600, true);
add_image_size('banner-1440x800', 1440, 800, true);


function my_custom_product_button(){

    if ( in_array( $current_term_slug, array('seasons','animals','numbers','colors','emotions') ) ) {
        echo '<a href="#" class="button"><span></span> Play Audio Sample</a>';
    }else{
        echo '<a href="#" class="button"><span></span> Artist Profile</a>';
    }
}
do_action( 'woocommerce_before_add_to_cart_form','my_custom_product_button' );

