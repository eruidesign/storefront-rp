<?php
    $postid = get_the_ID();
    $pages = get_pages( array( 'child_of' => $postid, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
?>
<?php if($pages) : ?>
    <div class="grid grid-cols-3 gap-4 mb-8">
        <?php foreach ($pages as $page) : ?>
            <?php $thumb_url = get_the_post_thumbnail_url($page->ID,'woocommerce_thumbnail');?>

            <div class="border overflow-hidden rounded-lg flex flex-col">
                <div class="text-center flex-grow">
                    <?php  if($thumb_url) :?>
                        <img src="<?php echo $thumb_url;?>" alt="" class="w-full">
                    <?php else : ?>
                        <div class="w-full aspect-[4/3] bg-gray-400">&nbsp;</div>
                    <?php endif;?>
                        <h3 class="my-4 text-xl"><?php echo $page->post_title; ?></h3>
                    <div class="text-gray-400 p-4 text-sm text-justify"><?php echo apply_filters('the_content', $page->post_content);?></div>
                </div>
                <div class="p-4 flex">
                    <a href="<?php echo get_page_link( $page->ID ); ?>" class="grow bg-rppurple-900 text-white text-center rounded p-2 justify-self-end hover:bg-purple-500">Contact for more info<span> →</span></a>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>