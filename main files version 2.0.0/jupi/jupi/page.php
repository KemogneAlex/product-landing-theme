<?php
get_header();
$remove_header = get_post_meta( get_the_ID(), '_jupi_page_header', true );
$onepage = get_post_meta( get_the_ID(), '_jupi_one_page_template', true );
if( $remove_header != 'on' ){
    get_template_part('template-parts/site-header'); 
}
?>
    <div class="<?php echo ( ($onepage != 'on') ? 'section-padding' : '' ); ?> page-contents">
    <div class="<?php echo ( ($onepage != 'on') ? 'container' : '' ); ?>">
        <?php 
            if( have_posts() ){                                
               // Start the loop.
                while(have_posts()){
                    the_post();                                    
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'template-parts/post-formats/post', 'page' );
                     // End the loop.
                    /* If comments are open or we have at least one comment, load up the comment template.*/
                    if ( comments_open() || get_comments_number() and $onepage != 'on' ) :
                        echo '<div class="space-60"></div>';
                        comments_template();
                    endif;
                }
            }else{
                // If no content, include the "No posts found" template.
                get_template_part( 'template-parts/post-formats/post', 'none' );
            }                        
        ?>
    </div>
    </div>
    <?php get_footer(); ?>