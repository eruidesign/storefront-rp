<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package storefront
 */

?>

<?php $post_slug = get_post_field('post_name');?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_slug); ?>>
	<?php
	/**
	 * Functions hooked in to storefront_page add_action
	 *
	 * @hooked storefront_page_header          - 10
	 * @hooked storefront_page_content         - 20
	 */
	//do_action( 'storefront_page' );
    //see: storefront-template-functions.php
	?>

    <header class="entry-header">

        <section class="">

            <div class="section-wrapper">
                <?php the_post_thumbnail('banner-1440x600', array( 'class' => 'section-image' ));?>
                <div class="section-container">

                    <div class="section-content inner">
                        <?php the_title( '<h1 class="entry-title section-title">', '</h1>' );?>
                        <div class="section-description"><?php echo apply_filters('the_content', get_the_excerpt());?></div>
                    </div>
                    <svg id="shape1" viewBox="0 0 354.8 799.9" class="wave wave-left">
                        <path class="cls-1" d="M304.7,238.7c-18.1,145.1-36.7,295.1-190.5,507.4c-13.6,18.8-27.3,36.7-41,53.8h281.6V0
                        C323.8,85.1,314.5,159.8,304.7,238.7z"/>
                        <path class="cls-2" d="M284.8,236.3c9.7-78,18.9-151.9,48.7-236.3h-31.4c-26.8,82.6-36,156.9-45,229c-17.6,141.5-34.2,275-176.1,470.9
                        c-26.8,37-53.6,70.1-81.1,100h47.3c17-20.5,33.9-42.3,50.7-65.5C248.7,526.2,267.1,378.8,284.8,236.3z"/>
                    </svg>

                </div>
            </div>
        </section>

    </header>

    <?php
        /**
         * Functions hooked in to storefront_before_content
         *
         * @hooked storefront_header_widget_region - 10
         * @hooked woocommerce_breadcrumb - 10
         */
        do_action( 'storefront_before_content' );
    ?>

    <div class="entry-content inner">
        <?php the_content(); ?>
        
        <?php
            switch($post_slug)
            {
                case 'our-story';
                    get_template_part( 'template-parts/content', 'our-story' );
                    break;
                case 'for-arts-student';
                    get_template_part( 'template-parts/content', 'for-arts-student' );
                    break;
                case 'curriculum';
                    get_template_part( 'template-parts/content', 'curriculum' );
                    break;
                default;
                    $extra_content = 'Nothing extra here...';
                    break;
            }
        ?>

    </div><!-- .entry-content -->

</article><!-- #post-## -->