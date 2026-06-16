<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target=".mainmenu-area">

<?php    
    if ( class_exists( 'Redux' ) ) {
        global $jupi_opt;
    }else{
        $jupi_opt = array();
        $jupi_opt['error_image']['url'] = get_theme_file_uri('assets/images/error-image.png');
        $jupi_opt['error_title'] = 'Error';
        $jupi_opt['error_subtitle'] = 'Oops! Page Not Found.';
    }    
?>  

<div class="error-area">
    <div class="container">
        <div class="row flex-box">
            <div class="col-xs-12 col-md-6">
                <div class="error-content">
                    <h1 class="big-text">
                        <?php echo esc_html($jupi_opt['error_title']); ?>
                    </h1>
                    <h3 class="medium-text">
                        <?php echo esc_html($jupi_opt['error_subtitle']); ?>
                    </h3>
                    <a href="<?php echo esc_url(home_url('/'))?>" class="error-button">
                        <?php esc_html_e( "Go Home", 'jupi' ); ?></a>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="error-image">
                    <img src="<?php echo esc_url($jupi_opt['error_image']['url']); ?>" alt="<?php esc_attr_e( 'Error illustrations','jupi' ); ?>">
                </div>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>

</html>