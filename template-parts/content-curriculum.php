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

<div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    
    <?php foreach ($products_categories as $cat) : ?> 

        <div class="overflow-hidden rounded-lg bg-white border border-stone-100 flex flex-col">
            <div class="text-center flex-grow">
                <?php
                    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                    $image = wp_get_attachment_image_url( $thumbnail_id, 'woocommerce_thumbnail' );
                ?>
                <?php if ( $image ) : ?>
                    <img src="<?php echo $image;?>" alt="<?php echo $cat->name;?>" class="w-full"/>
                <?php else : ?>
                    <div class="w-[100%] aspect-square bg-slate-400"></div>
                <?php endif;?>
                <h3 class="my-4 text-xl"><?php echo $cat->name;?></h3>
                <!--<div class="text-gray-400"><?php echo $cat->description;?></div>-->
            </div>
            <div class="p-4 flex">
                <a href="<?php echo esc_url(get_term_link($cat));?>" class="grow bg-rpgreen-900 text-white text-center no-underline rounded p-2 justify-self-end hover:bg-rpgreen-500 transition-all">Discover <?php echo $cat->name;?><span> →</span></a>
            </div>
        </div>
    <?php endforeach;?>

</div>

<?php endif;?>