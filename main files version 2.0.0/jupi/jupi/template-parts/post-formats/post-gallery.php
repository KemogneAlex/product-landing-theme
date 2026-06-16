<div <?php post_class('post-single'); ?> >   
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
            if(get_post_meta( get_the_ID(), '_jupi_post_gallery', false )){
                $gallery_images = get_post_meta( get_the_ID(), '_jupi_post_gallery', false );
            }else{
                $gallery_images = array();
            }
            if(function_exists('jupi_gallery_photo_list')): 
                // Gallery Post Content Function
                echo jupi_gallery_photo_list( $gallery_images, 'full' );    
            else:
                jupi_post_thumbnail($jupi_opt['blog_thumbnail_size']); 
            endif; 
        }
    ?>
    <div class="post-content">       
        <?php  
        if(is_single() ):                
        /* translators: %s: Name of current post */
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
            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'jupi' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span class="page-numbers" >',
            'link_after'  => '</span>',
            'next_or_number' => 'number',
            'nextpagelink'     => '<i class="flaticon-right-arrow"></i>',
            'previouspagelink' => '<i class="flaticon-left-arrow-1"></i>',
        ) );  
        else:        
            if( $jupi_opt['is_blog_post_title'] == true ){
                    echo '<h2 class="post-title"><a href="'.get_permalink().'" rel="bookmark">';
                    echo wp_trim_words( get_the_title(), $jupi_opt['title_excerpt_length'], '...' );
                    echo '</a></h2>';
            }        
            if( $jupi_opt['blog_content_format'] == 'excerpt' ){
                echo '<div class="post-desc">';
                echo wp_trim_words( get_the_content(), $jupi_opt['content_excerpt_length'], '...' );
                echo '</div>';
                if( $jupi_opt['read_more_switch'] == true and !empty($jupi_opt['read_more_text']) ){
                    echo '<a class="read-more" href="'.get_the_permalink().'" >'. wp_kses( $jupi_opt['read_more_text'] , wp_kses_allowed_html( 'post' ) ) .'</a>';
                }
            }elseif( $jupi_opt['blog_content_format'] == 'full' ){
                echo '<div class="post-desc">';
                the_content();
                echo '</div>';
            }
        endif;

        if( $jupi_opt['is_blog_post_meta'] == true ){
            echo jupi_header_post_meta( $jupi_opt['meta_option_select'] );
        }      
        ?>
    </div>
</div>