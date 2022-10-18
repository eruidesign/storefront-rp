<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<?php
    $terms = get_the_terms( get_the_ID(), 'product_cat' );
    $current_term_ID = $terms[0]->term_id;
    $current_term_slug = $terms[0]->slug;
    $parent_term_ID = get_term_by('slug','wam','product_cat')->term_id;
?>
<div class="custom-wrapper inner">
    <?php //if($terms[0]->slug == 'seasons') : ?>
        <?php if(term_is_ancestor_of($parent_term_ID,$current_term_ID,'product_cat')) : ?>

    <div class="custom-sidebar">
        <h1>Song Sets</h2>
        <?php
                    $args = array(
                        'taxonomy'	=> 'product_cat',
                        'hide_empty' => false,
                        'child_of'   => $parent_term_ID,
                    );
                    $sibling_categories = get_terms( $args );
                ?>

                <ul class="categories-list">
                    <?php foreach ($sibling_categories as $cat) : ?> 
                        <li>
                            <a href="<?php echo esc_url(get_term_link($cat));?>" class="text-rpgreen-900 hover:pl-4"><?php echo $cat->name;?><span> →</span></a>
                        </li>
                    <?php endforeach;?>
                </ul>
    </div>
    <?php endif;?>

    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

        <?php
        /**
         * Hook: woocommerce_before_single_product_summary.
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
        do_action( 'woocommerce_before_single_product_summary' );
        ?>

        <div class="summary entry-summary">
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            do_action( 'woocommerce_single_product_summary' );
            ?>

            <?php
                if ( in_array( $current_term_slug, array('seasons','animals','numbers','colors','emotions') ) ) {
                    echo '<a href="#" class="button"><span></span> Play Audio Sample</a>';
                }else{
                    echo '<a href="#" class="button"><span></span> Meet the Artist</a>';
                }
            ?>

        </div>

        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
        ?>
    </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
