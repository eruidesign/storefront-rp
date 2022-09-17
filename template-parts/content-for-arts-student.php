<?php
    $postid = get_the_ID();
    $pages = get_pages( array( 'child_of' => $postid, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
?>
<?php if($pages) : ?>
    <!--<div class="grid grid-cols-3 gap-4 mb-8">-->
    <?php woocommerce_product_loop_start();?>
        <?php foreach ($pages as $page) : ?>
            <?php $thumb_url = get_the_post_thumbnail_url($page->ID,'woocommerce_thumbnail');?>

            <li class="card product">
                <a href="<?php echo get_page_link( $page->ID ); ?>" class="">
                    <?php  if($thumb_url) :?>
                        <img src="<?php echo $thumb_url;?>" alt="" class="full">
                    <?php else : ?>
                        <div class="img-placeholder">&nbsp;</div>
                    <?php endif;?>
                    <div class="card-heading">
                        <h3 class="my-4 text-xl"><?php echo $page->post_title; ?></h3>
                    </div>
                    <div class="card-body">
                        <?php echo apply_filters('the_content', $page->post_content);?>
                    </div>
                </a>
                <div class="card-footer">
                    <a href="<?php echo get_page_link( $page->ID ); ?>" class="button full">Contact for more info<span> →</span></a>
                </div>
            </li>
        <?php endforeach;?>
    <?php woocommerce_product_loop_end();?>
    <!--</div>-->
<?php endif;?>