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
do_action( 'woocommerce_before_main_content' );

?>

<?php
$term = get_queried_object();

$term_slug = $term->slug;

if($term->parent > 0){
    $parent_term = get_term($term->parent, false);
    $parent_term_slug = $parent_term->slug;
    $parent = $term->term_id;
}

$args = array(
    'taxonomy'	=> 'product_cat',
    'hide_empty' => false,
    'child_of'   => $term->term_id,
);
$child_categories = get_terms( $args );

if($child_categories) : ?>

        <header class="woocommerce-products-header">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>

            <?php
            /**
             * Hook: woocommerce_archive_description.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action( 'woocommerce_archive_description' );
            ?>
        </header>

        <?php woocommerce_product_loop_start();?>

        <?php foreach ($child_categories as $cat) : ?> 
    
            <li class="columns product product_cat">
                <?php
                    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                    $image = wp_get_attachment_image_url( $thumbnail_id, 'woocommerce_thumbnail' );
                ?>

                <a href="<?php echo esc_url(get_term_link($cat));?>">
                    <img src="<?php echo $image;?>" alt="<?php echo $cat->name;?>" class="w-full"/>
                    <h2 class="woocommerce-loop-product__title"><?php echo $cat->name;?></h2>
                    <div class=""><?php echo $cat->description;?></div>
                </a>

                <a href="<?php echo esc_url(get_term_link($cat));?>" class="button full">Discover <?php echo $cat->name;?> Songs</a>
            </li>
        <?php endforeach;?>

        <?php woocommerce_product_loop_end();?>

<?php elseif (isset($parent_term_slug) && ($parent_term_slug == 'wam')) : ?>
    <?php
    $featured_products = new WP_Query( array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => 1,
        'tax_query' => array(
            'relation' => 'AND',
             array(
               'taxonomy' => 'product_cat',
               'field' => 'slug',
               'terms' => $term->slug
             ),
             array(
               'taxonomy' => 'product_visibility',
               'field' => 'slug',
               'terms' => 'featured'
             )
          )
    ) );

    while($featured_products->have_posts()) :
        $featured_products->the_post();
        echo do_shortcode('[product_page id="'.get_the_ID().'"]');
    endwhile;

    ?>
	
<?php else : ?>

<?php
    if ($term->count > 0){
        /**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
    }else{
        /**
         * Hook: woocommerce_no_products_found.
         *
         * @hooked wc_no_products_found - 10
         */
        do_action( 'woocommerce_no_products_found' );
    }
?>

<?php endif;

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
