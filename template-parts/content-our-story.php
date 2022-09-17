<?php 
        $args = array( 'post_type' => 'team-members');
        $the_query = new WP_Query( $args ); 
    ?>
    
    <?php if ( $the_query->have_posts() ) : ?>

        <h2>Meet Our Team</h2>
        <div class="profiles-wrapper">
     
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <div class="card profile">
                <?php the_post_thumbnail('thumbnail');?>
                <div class="card-body">
                    <h3><?php the_title();?></h3>
                    <?php the_excerpt(); ?>
                    <details class="question">
                        <summary class="button">More</summary>
                        <div class=""><?php the_content();?></div>
                    </details>
                </div>
            </div>  
                
            <?php endwhile;
            wp_reset_postdata(); ?>

        </div>
    
    <?php else:  ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>