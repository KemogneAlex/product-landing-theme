<div <?php post_class(); ?> >  
    <?php
        the_content();
        wp_link_pages( array(
            'before'           => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'jupi' ) . '</span>',
            'after'            => '</div>',
            'link_before'      => '<span class="page-numbers" >',
            'link_after'       => '</span>',
            'next_or_number'   => 'number',
            'nextpagelink'     => '<i class="flaticon-right-arrow"></i>',
            'previouspagelink' => '<i class="flaticon-left-arrow-1"></i>',
        ) );
    ?>
</div>