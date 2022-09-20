<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

get_header(); ?>

<?php
    $section_1_ID = 263; //Homepage
    $section_1 = get_post($section_1_ID);
    
    $section_2_ID = 2; //About Us
    $section_2 = get_post($section_2_ID);

    $link_1_ID = 380; //Meet our team
    $link_1 = get_post($link_1_ID);

    $section_3_ID = 15; //Coaching
    $section_3 = get_post($section_3_ID);
    
    $section_4_ID = 300; //Curriculum
    $section_4 = get_post($section_4_ID);

    $section_5_ID = 8; //Shop
    $section_5 = get_post($section_5_ID);
?>

        <section class="hero inner" style="background-image: url(<?php echo get_the_post_thumbnail_url($section_1_ID,'banner-1440x600');?>);">
            <div class="section-wrapper">
                <div class="hero-content">
                    <?php echo apply_filters('the_content', $section_1->post_content);?>
                </div>
            </div>
        </section>

        <section class="<?php echo $section_2->post_name;?>">
            <div class="section-header inner">
                <h2 class="section-title"><?php echo $section_2->post_title;?></h2>
                <div class="section-description"><?php echo apply_filters('the_content', $section_2->post_excerpt);?></div>
            </div>
            <div class="section-wrapper">
                <img src="<?php echo get_the_post_thumbnail_url($section_2_ID,'banner-1440x600');?>" class="section-image">
                <div class="section-container">

                    <div class="section-content inner">
                        <?php echo apply_filters('the_content', $section_2->post_content);?>
                        <a href="<?php echo get_permalink($section_2_ID);?>" class="button btn-primary">Our Story<span> →</span></a>
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

        <section class="<?php echo $section_3->post_name;?>">
            <div class="section-header inner">
                <h2 class="section-title"><?php echo $section_3->post_title;?></h2>
                <div class="section-description"><?php echo apply_filters('the_content', $section_3->post_excerpt);?></div>
            </div>
            <div class="section-wrapper">
                <img src="<?php echo get_the_post_thumbnail_url($section_3_ID,'banner-1440x600');?>" class="section-image">
                <div class="section-container">

                    <div class="section-content inner">
                        <?php echo apply_filters('the_content', $section_3->post_content);?>
                        <a href="<?php echo get_permalink($section_3_ID);?>" class="button btn-primary">Our Story<span> →</span></a>
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

        <section class="<?php echo $section_4->post_name;?>">
            <div class="section-header inner">
                <h2 class="section-title"><?php echo $section_4->post_title;?></h2>
                <div class="section-description"><?php echo apply_filters('the_content', $section_4->post_excerpt);?></div>
            </div>
            <div class="section-wrapper">
                <img src="<?php echo get_the_post_thumbnail_url($section_4_ID,'banner-1440x600');?>" class="section-image">
                <div class="section-container">

                    <div class="section-content inner">
                        <?php echo apply_filters('the_content', $section_4->post_content);?>
                        <a href="<?php echo get_permalink($section_4_ID);?>" class="button btn-primary">Our Story<span> →</span></a>
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

        <section class="<?php echo $section_5->post_name;?>">
    <div class="section-header inner">
        <h2 class="section-title"><?php echo $section_5->post_title;?></h2>
        <div class="section-description"><?php echo apply_filters('the_content', $section_5->post_excerpt);?></div>
    </div>
    <div class="section-wrapper">
        <div class="section-container inner">

            <?php
                $args = array(
                    'taxonomy'	=> 'product_cat',
                    'include'	=> array(27,29,30),
                    'hide_empty' => false
                );
                $products_categories = get_terms( $args );
            ?>
        
            <?php foreach ($products_categories as $cat) : ?> 
                <div class="card">
                    <?php
                        $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                        $image = wp_get_attachment_image_url( $thumbnail_id, 'woocommerce_thumbnail' );
                    ?>
                    <?php if ( $image ) : ?>
                        <img src="<?php echo $image;?>" alt="<?php echo $cat->name;?>" class="w-full"/>
                    <?php else : ?>
                        <div class="w-[100%] aspect-square bg-slate-400"></div>
                    <?php endif;?>
                    <div class="card-heading">
                        <h3 class="my-4 text-xl"><?php echo $cat->name;?></h3>
                    </div>
                    <div class="card-body">
                        <?php echo $cat->description;?>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo esc_url(get_term_link($cat));?>" class="button full tertiary">See what we offer<span> →</span></a>
                    </div>
                </div>
            <?php endforeach;?>

        </div>
    </div>
</section>

<?php
do_action( 'storefront_sidebar' );
get_footer();
