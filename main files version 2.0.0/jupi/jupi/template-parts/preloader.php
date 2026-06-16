<?php
if ( class_exists( 'Redux' ) ) {    
    global $jupi_opt;
}else{
    $jupi_opt = array();
    $jupi_opt['is_preloader'] = false;
}
if( $jupi_opt['is_preloader'] == true ):
if( $jupi_opt['preloader_style'] == 'image' and !empty($jupi_opt['preloader_image']['url']) ):
    ?>
    <div class="preloader">
        <?php if($jupi_opt['is_loader_close'] == true and !empty($jupi_opt['load_close_text'])): ?>
        <button type="button" class="load-close bttn-1 mouse-dir" ><?php echo wp_kses( $jupi_opt['load_close_text'] , wp_kses_allowed_html( 'post' ) ); ?><span class="dir-part"></span></button>
        <?php endif; ?>
        <div class="loader-image">
            <img src="<?php echo esc_url($jupi_opt['preloader_image']['url']); ?>" alt="<?php esc_attr_e('Preloader','jupi'); ?>">
        </div>
    </div>
    <?php
    elseif( $jupi_opt['preloader_style'] == 'text' and !empty($jupi_opt['preloader_text']) ):
    ?>
    <div class="preloader">
        <div class="loader-text"><h3><?php echo esc_html($jupi_opt['preloader_text']); ?></h3></div>
    </div>
    <?php
    endif;
endif;