<div <?php post_class(['post-single','post-campaign']); ?> >   
<?php    
    if ( class_exists( 'Redux' ) ) {
        global $jupi_opt;
    }else{     
        $jupi_opt                           = array();       
        $jupi_opt['is_blog_post_meta']      = $jupi_opt['is_blog_post_title'] = $jupi_opt['is_blog_post_image'] = true;    
        $jupi_opt['read_more_switch']       = true;
        $jupi_opt['meta_option_select']     = array( 'author','date','comment_count','category' );
        $jupi_opt['blog_thumbnail_size']    = 'full';
        $jupi_opt['blog_content_format']    = 'excerpt';
        $jupi_opt['content_excerpt_length'] = '30';
        $jupi_opt['title_excerpt_length']   = '15';
        $jupi_opt['read_more_text']         = 'Read More <i class="flaticon-right-arrow"></i>';
    }    
    if( $jupi_opt['is_blog_post_image'] == true ){
        jupi_post_thumbnail($jupi_opt['blog_thumbnail_size']);    
    }

    $camp_author_name  = get_post_meta( get_the_ID(), '_jupi_camp_author_name', true );
    $camp_author_photo = get_post_meta( get_the_ID(), '_jupi_camp_author_photo', true );
    $camp_progress     = get_post_meta( get_the_ID(), '_jupi_camp_progress', true );
    $camp_raised       = get_post_meta( get_the_ID(), '_jupi_camp_raised', true );
    $camp_day          = get_post_meta( get_the_ID(), '_jupi_camp_day', true );
    $camp_pledged      = get_post_meta( get_the_ID(), '_jupi_camp_pledged', true );



    ?>
    <div class="post-content">       
        <?php  
        if(is_single() ):                
        /* translators: %s: Name of current post */
        if( !empty($camp_raised) or !empty($camp_day) or !empty($camp_pledged) ):
            echo '<ul class="campign-info">';
                if( !empty($camp_raised) ):
                    echo '<li>';
                    echo '<span class="title">'.esc_html_e('Raised.','jupi').'</span>';
                    echo '<span class="content">'.esc_html($camp_raised).'</span>';
                    echo '</li>';
                endif;        
                if( !empty($camp_day) ):
                    echo '<li>';
                    echo '<span class="title">'.esc_html_e('Days to Go.','jupi').'</span>';
                    echo '<span class="content">'.esc_html($camp_day).'</span>';
                    echo '</li>';
                endif;        
                if( !empty($camp_pledged) ):
                    echo '<li>';
                    echo '<span class="title">'.esc_html_e('Pledged.','jupi').'</span>';
                    echo '<span class="content">'.esc_html($camp_pledged).'</span>';
                    echo '</li>';
                endif;
            echo '</ul>';
        endif;
       ?>
       <div class="post-desc">
           <?php
                the_content(
                    sprintf(
                        esc_html__( 'Continue reading %s', 'jupi' ),
                        the_title( '<span class="screen-reader-text">', '</span>', false )
                    )
                );
           ?>
       </div>
       <?php
        wp_link_pages( array(
            'before'           => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'jupi' ) . '</span>',
            'after'            => '</div>',
            'link_before'      => '<span class="page-numbers" >',
            'link_after'       => '</span>',
            'next_or_number'   => 'number',
            'nextpagelink'     => '<i class="flaticon-right-arrow"></i>',
            'previouspagelink' => '<i class="flaticon-left-arrow-1"></i>',
        ) );  
        else:
            if( !empty($camp_author_photo) or !empty($camp_author_name) ):
                echo '<div class="author_details">';
                    if( !empty($camp_author_photo) ){
                        echo '<div class="author-photo"><img src="'.esc_attr($camp_author_photo).'" alt="'.esc_attr__( 'Project Author','jupi' ).'"></div>';
                    }
                    if( !empty($camp_author_name) ){
                        echo '<div class="author-name">'.esc_html($camp_author_name).'</div>';
                    }
                echo '</div>';
            endif;

            if( $jupi_opt['is_blog_post_title'] == true ){
                    echo '<h2 class="post-title"><a href="'.get_permalink().'" rel="bookmark">';
                    echo wp_trim_words( get_the_title(), $jupi_opt['title_excerpt_length'], '...' );
                    echo '</a></h2>';
            }

            if( !empty($camp_progress) ){
                echo '<div class="skillbar" data-percent="'.esc_attr($camp_progress).'%">';
                echo '<div class="count-bar"></div>';
                echo '<div class="count"></div>';
                echo '</div>';
            }
            
            if( $jupi_opt['blog_content_format'] == 'excerpt' ){
                echo '<div class="post-desc">';
                echo wp_trim_words( get_the_content(), $jupi_opt['content_excerpt_length'], '...' );
                echo '</div>';
                if( $jupi_opt['read_more_switch'] == true and !empty($jupi_opt['read_more_text']) ){
                    echo '<a class="read-more" href="'.get_the_permalink().'" >'.wp_kses( $jupi_opt['read_more_text'] , wp_kses_allowed_html( 'post' ) ).'</a>';
                }
            }elseif( $jupi_opt['blog_content_format'] == 'full' ){
                echo '<div class="post-desc">';
                the_content();
                echo '</div>';
            }
            if( !empty($camp_raised) or !empty($camp_day) or !empty($camp_pledged) ):
                echo '<ul class="campign-info">';
                    if( !empty($camp_raised) ):
                        echo '<li>';
                        echo '<span class="title">'.esc_html_e('Raised.','jupi').'</span>';
                        echo '<span class="content">'.esc_html($camp_raised).'</span>';
                        echo '</li>';
                    endif;        
                    if( !empty($camp_day) ):
                        echo '<li>';
                        echo '<span class="title">'.esc_html_e('Days to Go.','jupi').'</span>';
                        echo '<span class="content">'.esc_html($camp_day).'</span>';
                        echo '</li>';
                    endif;        
                    if( !empty($camp_pledged) ):
                        echo '<li>';
                        echo '<span class="title">'.esc_html_e('Pledged.','jupi').'</span>';
                        echo '<span class="content">'.esc_html($camp_pledged).'</span>';
                        echo '</li>';
                    endif;
                echo '</ul>';
        endif; 
        endif;
        ?>
    </div>
</div>