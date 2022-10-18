<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

the_title( '<h1 class="product_title entry-title">', '</h1>' );

/*global $product;
    $id = $product->get_id();*/

    $terms = get_the_terms( get_the_ID(), 'product_cat' );
    $current_term_ID = $terms[0]->term_id;
    $current_term_slug = $terms[0]->slug;
    $parent_term_ID = get_term_by('slug','wam','product_cat')->term_id;

    if ( in_array( $current_term_slug, array('seasons','animals','numbers','colors','emotions') ) ) {
        echo '<a href="#" class="button"><span></span> Play Audio Sample</a>';
    }else{
        echo '<a href="#" class="button"><span></span> Artist Profile</a>';
    }