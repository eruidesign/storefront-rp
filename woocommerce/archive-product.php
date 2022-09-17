<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

$shop_page_ID = get_option( 'woocommerce_shop_page_id' );
$shop_page = get_post($shop_page_ID);
$banner_url = get_the_post_thumbnail_url($shop_page_ID,'banner-1440x600');
?>

<section class="shop">

    <div class="section-wrapper">
        <img src="<?php echo $banner_url;?>" class="section-image">

        <div class="section-container">

            <div class="section-content inner">
                <h1 class="entry-title section-title"><?php echo $shop_page->post_title;?></h1>
                <div class="section-description"><?php echo apply_filters('the_content', $shop_page->post_excerpt);?></div>
            </div>

            <svg id="shape1" viewBox="0 0 354.8 799.9" class="wave wave-left flipped">
                <path class="cls-1" d="M304.7,238.7c-18.1,145.1-36.7,295.1-190.5,507.4c-13.6,18.8-27.3,36.7-41,53.8h281.6V0
                C323.8,85.1,314.5,159.8,304.7,238.7z"/>
                <path class="cls-2" d="M284.8,236.3c9.7-78,18.9-151.9,48.7-236.3h-31.4c-26.8,82.6-36,156.9-45,229c-17.6,141.5-34.2,275-176.1,470.9
                c-26.8,37-53.6,70.1-81.1,100h47.3c17-20.5,33.9-42.3,50.7-65.5C248.7,526.2,267.1,378.8,284.8,236.3z"/>
            </svg>

        </div>
    </div>

</section>

<?php
    /**
     * Functions hooked in to storefront_before_content
     *
     * @hooked storefront_header_widget_region - 10
     * @hooked woocommerce_breadcrumb - 10
     */
    do_action( 'storefront_before_content' );
?>

<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

$term_ID_1 = get_term_by('slug','wam','product_cat')->term_id; //wam
$term_ID_2 = get_term_by('slug','sos','product_cat')->term_id; //sos
$term_ID_u = get_term_by('slug','uncategorized','product_cat')->term_id; //uncategorized

$arts_args = array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    //'child_of'   => $term->term_id,
    'parent'   => 0,
    'exclude'    => array($term_ID_1, $term_ID_2, $term_ID_u),
);
$arts_categories = get_terms( $arts_args );

?>

<div class="entry-content inner">

    <h2>For the Arts Advocate</h2>

        <?php woocommerce_product_loop_start();?>

        <?php foreach ($arts_categories as $arts_cat) : ?> 
    
            <li class="card product product_cat">
                <?php
                    $thumb_id = get_term_meta( $arts_cat->term_id, 'thumbnail_id', true );
                    $thumb_url = wp_get_attachment_image_url( $thumb_id, 'woocommerce_thumbnail' );
                ?>

                <a href="<?php echo esc_url(get_term_link($arts_cat));?>">

                    <?php  if($thumb_url) :?>
                        <img src="<?php echo $thumb_url;?>" alt="<?php echo $arts_cat->name;?>" class="full">
                    <?php else : ?>
                        <div class="img-placeholder">&nbsp;</div>
                    <?php endif;?>

                    <!--<img src="<?php echo $image;?>" alt="<?php echo $arts_cat->name;?>" class="full"/>-->
                    <div class="card-heading">
                        <h2 class="woocommerce-loop-product__title"><?php echo $arts_cat->name;?></h2>
                    </div>
                    <div class="card-body"><?php echo $arts_cat->description;?></div>
                </a>
                <div class="card-footer">
                    <a href="<?php echo esc_url(get_term_link($arts_cat));?>" class="button full">Discover <?php echo $arts_cat->name;?></a>
                </div>
            </li>
        <?php endforeach;?>

        <?php woocommerce_product_loop_end();


    $songs_args = array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    //'child_of'   => $term->term_id,
    'parent'   => 0,
    'include'    => array($term_ID_1, $term_ID_2),
);
$songs_categories = get_terms( $songs_args );
?>

    <h2>For the EFL Teacher</h2>

        <?php woocommerce_product_loop_start();?>

        <?php foreach ($songs_categories as $songs_cat) : ?> 
    
            <li class="card product product_cat">
                <?php
                    $thumb_id = get_term_meta( $songs_cat->term_id, 'thumbnail_id', true );
                    $thumb_url = wp_get_attachment_image_url( $thumb_id, 'woocommerce_thumbnail' );
                ?>
                <a href="<?php echo esc_url(get_term_link($songs_cat));?>">
                    <?php  if($thumb_url) :?>
                        <img src="<?php echo $thumb_url;?>" alt="<?php echo $songs_cat->name;?>" class="full">
                    <?php else : ?>
                        <div class="img-placeholder">&nbsp;</div>
                    <?php endif;?>

                    <!--<img src="<?php echo $image;?>" alt="<?php echo $songs_cat->name;?>" class="full"/>-->
                    <div class="card-heading"><h2 class="woocommerce-loop-product__title"><?php echo $songs_cat->name;?></h2></div>
                    <div class="card-body"><?php echo $songs_cat->description;?></div>
                </a>
                <div class="card-footer">
                    <a href="<?php echo esc_url(get_term_link($songs_cat));?>" class="button full">Discover <?php echo $songs_cat->name;?></a>
                </div>
            </li>

        <?php endforeach;?>

        <?php woocommerce_product_loop_end();?>

</div>

<?php


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
