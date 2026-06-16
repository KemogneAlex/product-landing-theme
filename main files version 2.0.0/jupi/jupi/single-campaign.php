<?php 
    get_header(); 
    get_template_part('template-parts/site-header'); 
    the_post();

    if ( class_exists( 'Redux' ) ) {
        global $jupi_opt;
    }else{        
        $jupi_opt = array();
        $jupi_opt['single_releted_tag'] = true;
        $jupi_opt['single_post_share'] = false;
        $jupi_opt['single_post_nav'] = true;
        $jupi_opt['single_author_info'] = true;
    }

    $camp_author_name = get_post_meta( get_the_ID(), '_jupi_camp_author_name', true );
    $camp_author_photo = get_post_meta( get_the_ID(), '_jupi_camp_author_photo', true );
    $camp_progress = get_post_meta( get_the_ID(), '_jupi_camp_progress', true );
    $camp_raised = get_post_meta( get_the_ID(), '_jupi_camp_raised', true );
    $camp_day = get_post_meta( get_the_ID(), '_jupi_camp_day', true );
    $camp_pledged = get_post_meta( get_the_ID(), '_jupi_camp_pledged', true );

?>
<section class="blog-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 <?php echo ( is_active_sidebar( 'sidebar-1' ) ? 'col-md-8' : '' ); ?>">
                <?php 
                    get_template_part( 'template-parts/post-formats/post', 'campaign' );                
                
                //Populer post view count function
                if( function_exists('jupi_set_post_views') ){
                    jupi_set_post_views(get_the_ID());
                }
                ?>
            <?php if( has_tag() == true or function_exists('jupi_post_share_social') ): ?>
              <div class="equal-height">
                  <?php
                    if( $jupi_opt['single_releted_tag'] == true ){
                        echo get_the_tag_list( '<div class="single-tags"><h3 class="single-tags-title">'.esc_html__( 'Releted Tags','jupi' ).'</h3>',' ','</div>');
                    }
                    // Post share social menu function.
                    if( function_exists('jupi_post_share_social') ){ 
                        jupi_post_share_social(); 
                    }
                  ?>
              </div> 
              <?php endif; ?>
               <?php if( $jupi_opt['single_post_nav'] == true and get_the_post_navigation() ): ?>
                <div class="single-post-navigation">
                <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'next_text' => '<span class="meta-nav">' . esc_html__( 'Next Post', 'jupi' ) . '</span><h3 class="title">%title</h3>',
                        'prev_text' => '<span class="meta-nav">' . esc_html__( 'Prev Post', 'jupi' ) . '</span><h3 class="title">%title</h3>',
                    ));
                ?>
                </div>
                <?php endif;
                
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }                
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