<?php 

    $ID_1 = get_term_by( 'slug', 'wam', 'product_cat' )->term_id;
    $ID_2 = get_term_by( 'slug', 'sos', 'product_cat' )->term_id;

?>

<?php
    $products_categories = get_terms( 'product_cat', array(
        'include' => array( $ID_1,$ID_2 ),
        'hide_empty' => false,
    ) );
?>

<?php if ( ! empty( $products_categories ) && ! is_wp_error( $products_categories ) ) : ?>

<?php woocommerce_product_loop_start();?>   

    <?php foreach ($products_categories as $cat) : ?> 

        <li class="card product">

            <?php
                $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                $image = wp_get_attachment_image_url( $thumbnail_id, 'woocommerce_thumbnail' );
            ?>
            <?php if ( $image ) : ?>
                <img src="<?php echo $image;?>" alt="<?php echo $cat->name;?>" class="full"/>
            <?php else : ?>
                <div class="img-placeholder"></div>
            <?php endif;?>
            <div class="card-heading"><h3 class="my-4 text-xl"><?php echo $cat->name;?></h3></div>
            <div class="card-body"><?php echo $cat->description;?></div>
            <div class="card-footer">
                <a href="<?php echo esc_url(get_term_link($cat));?>" class="button full">Discover <?php echo $cat->name;?><span> →</span></a>
            </div>
        </li>
    <?php endforeach;?>

<?php woocommerce_product_loop_end();?>

<?php endif;?>