<?php get_header(); ?>
<?php get_template_part('template-parts/site-header'); ?> 
<section class="section-padding">
    <div class="container">
        <div class="row">
        <div class="col-xs-12 <?php echo ( is_active_sidebar( 'sidebar-1' ) ? 'col-md-8' : '' ); ?>">
                <div class="posts-list">
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
                                get_template_part( 'template-parts/post-formats/post', get_post_format() );
                                 // End the loop.
                            }
                        }else{
                            // If no content, include the "No posts found" template.
                            get_template_part( 'template-parts/post-formats/post', 'none' );
                        }                        
                    ?>
                </div>
                <?php
                     // Previous/next page navigation.
                    the_posts_pagination(array(
                        'prev_text' => '<i class="flaticon-left-arrow-1"></i>',
                        'next_text' => '<i class="flaticon-right-arrow"></i>',
                        'screen_reader_text' => ' '
                    ));
                ?>
            </div>
            <div class="col-xs-12 <?php echo ( is_active_sidebar( 'sidebar-1' ) ? 'col-md-4' : '' ); ?>">
                <div class="hidden visible-xs visible-sm space-30"></div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>