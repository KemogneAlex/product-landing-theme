<?php

if ( class_exists( 'Redux' ) ) {
    global $jupi_opt;
}else{
    $jupi_opt                         = array();
    $jupi_opt['titlebar_align']       = 'center';
    $jupi_opt['breadcrumb_home']      = 'Home';
    $jupi_opt['breadcrumb_separator'] = '|';
    $jupi_opt['sub_title_format']     = 1;
}


?>
<header class="header-area <?php echo esc_attr($jupi_opt['titlebar_align']); ?>" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="page-title"><?php echo jupi_page_title(); ?></h3>
                <?php
                    if( $jupi_opt['sub_title_format'] == 1 ){
                        echo '<div class="sub-title site-description">'.get_bloginfo( 'description' ) .'</div>';
                    }elseif($jupi_opt['sub_title_format'] == 2 and function_exists('jupi_breadcrumb') ){
                        echo jupi_breadcrumb($jupi_opt['breadcrumb_home'],$jupi_opt['breadcrumb_separator']);
                    }elseif($jupi_opt['sub_title_format'] == 3 and !empty($jupi_opt['custom_sub_title']) ){
                        echo '<div class="sub-title">'. wp_kses( $jupi_opt['custom_sub_title'] , wp_kses_allowed_html( 'post' ) ) .'</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</header>