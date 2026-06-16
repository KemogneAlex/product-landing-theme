<?php
/*-----------------------------
Header-Post-Meta-Option
-------------------------------*/
if ( ! function_exists( 'jupi_header_post_meta' ) ){    
    function jupi_header_post_meta( $item = array() ){       
        $data = array();
        $data['start'] = '<div class="post-meta">';
        if( in_array( 'author', $item ) ){   
            $data[] = '<span class="author meta-item"><span class="icon"><i title="'.esc_attr__( 'Post Author','jupi' ).'" class="flaticon-user"></i></span> '.get_the_author().'</span>';
        }
        if( in_array( 'date', $item )  ){
            $time_string = sprintf( wp_kses( '<time class="entry-date published updated" datetime="%1$s">%2$s</time>', wp_kses_allowed_html('post')),
                esc_attr( get_the_date( 'c' ) ),
                esc_html( get_the_date() )
            );
            $date_format = get_the_date('Y/m/d');
            $data[] = '<span class="meta-item"><span class="icon"><i title="'.esc_attr__( 'Post publish date','jupi' ).'" class="flaticon-time"></i></span> <a href="'.esc_url(home_url($date_format)).'">'.$time_string.'</a></span>';        
        }
        // Comment-Count-Meta
        if ( in_array( 'comment_count', $item ) and !post_password_required() && ( comments_open() || get_comments_number() ) && get_comments_number() > 0 ) { 
            $comment_count = get_comments_number_text(esc_html__('No comment','jupi'),esc_html__('1 Comment','jupi'),esc_html__('% Comments','jupi'));
            $data['comment-count'] = '<span class="meta-item comment-count"><span class="icon"><i class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i></span><span class="value">'.esc_html($comment_count).'</span></span>';        
        }
        if ( in_array( 'category', $item ) and has_category() ) {
            $data[] = '<span class="cat-list meta-item" ><span class="icon"><i title="'.esc_attr__( 'Post Categories','jupi' ).'" class="flaticon-bookmark-white"></i></span> '.get_the_category_list( ', ', '' ).'</span>';
        }
        if ( in_array( 'tags', $item ) and has_tag() ) {
            $data[] = '<span class="tag-list meta-item" ><span class="icon"><i title="'.esc_attr__( 'Post Categories','jupi' ).'" class="flaticon-tag"></i></span> '.get_the_tag_list( '', ', ', '' ).'</span>';
        }      
        if(current_user_can('edit_posts')){
            $data[] = '<span class="edit-post meta-item"><i title="'.esc_attr__( 'Edit this post','jupi' ).'" class="flaticon-graphic-design"></i> <a href="'.get_edit_post_link().'">'.esc_html__('Edit','jupi').'</a></span>';
        }        
        $data['end'] = '</div>';
        $data = implode( ' ', $data );        
        return $data;        
    }
}

/*------------------------
Post-Thumbnail-Function
-------------------------*/
if ( !function_exists( 'jupi_post_thumbnail' ) ) :
    function jupi_post_thumbnail( $thumb_size = 'jupi_blog_thumb' ) {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }
        if ( is_singular() ) {
            // Is Single Page Attachment Content.
           printf( '<figure class="post-media">%s</figure>',get_the_post_thumbnail( '', $thumb_size )); 
        }else{
            // Is Post Page Attachment Content.
            printf( '<a class="post-media" href="%s" aria-hidden="true"><figure>%s</figure></a>', get_the_permalink(), get_the_post_thumbnail( '', $thumb_size ) );
        }
    }
endif;