<?php

if( class_exists('Redux') ){
    global $jupi_opt;
}else{
    $jupi_opt                       = array();
    $jupi_opt['copyright_text']     = esc_html__('Copyright By@Quomodothemes - 2020','jupi');
    $jupi_opt['footer_logo']['url'] = '';
    $jupi_opt['visa_card']          = '';
    $jupi_opt['stripe_card']        = '';
    $jupi_opt['paypal_card']        = '';
    $jupi_opt['mastercard_card']    = '';
    $jupi_opt['jcb_card']           = '';
    $jupi_opt['discover_card']      = '';
    $jupi_opt['diners_club_card']   = '';
    $jupi_opt['apple_pay_card']     = '';
    $jupi_opt['amex_card']          = '';
    $jupi_opt['amazon_pay_card']    = '';
    $jupi_opt['footer_style']       = '';
}
$remove_widget = get_post_meta( get_the_ID(), '_jupi_footer_widget', true );

$footer_style = '';
if(!empty($jupi_opt['footer_style'])) {
    $footer_style = new WP_Query(array(
        'post_type' => 'elementor_library',
        'posts_per_page'=> -1,
        'p' => $jupi_opt['footer_style'],
    ));
}
if( $remove_widget != 'on' ):
if($footer_style) {
    if ($footer_style->have_posts()) {
        while ($footer_style->have_posts()) : $footer_style->the_post();
            the_content();
        endwhile;
    }
}elseif( is_active_sidebar('sidebar-2') or !empty($jupi_opt['copyright_text']) ){
?>
<footer class="footer-area">
   <?php
   if( is_active_sidebar('sidebar-2') ): ?>
    <div class="footer-top">
        <div class="container">
            <div class="row masonrys">
                <?php dynamic_sidebar( 'sidebar-2' ); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if( !empty($jupi_opt['copyright_text']) ): ?>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="footer-bottom-wrap">
                        <?php if(!empty($jupi_opt['footer_logo']['url'])): ?>
                        <div class="footer-logo">
                            <img src="<?php echo esc_url($jupi_opt['footer_logo']['url']); ?>" alt="<?php esc_attr_e( 'Footer Logo','jupi' ); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($jupi_opt['copyright_text'])): ?>                       
                        <div class="copyright_text">
                            <?php echo wp_kses( $jupi_opt['copyright_text'], wp_kses_allowed_html( 'post' ) ) ?>
                        </div>
                        <?php endif; ?>
                        <?php if( !empty($jupi_opt['visa_card']) or !empty($jupi_opt['stripe_card']) or !empty($jupi_opt['paypal_card']) or !empty($jupi_opt['mastercard_card']) or !empty($jupi_opt['jcb_card']) or !empty($jupi_opt['discover_card']) or !empty($jupi_opt['diners_club_card']) or !empty($jupi_opt['apple_pay_card']) or !empty($jupi_opt['amex_card']) or !empty($jupi_opt['amazon_pay_card']) ): ?>
                        <div class="cradit-card">
                            <?php if(!empty($jupi_opt['visa_card'])): ?>
                            <a href="<?php echo esc_url($jupi_opt['visa_card']); ?>"><i class="fab fa-cc-visa"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($jupi_opt['stripe_card'])): ?>
                            <a href="<?php echo esc_url($jupi_opt['stripe_card']); ?>"><i class="fab fa-cc-stripe"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($jupi_opt['paypal_card'])): ?>
                            <a href="<?php echo esc_url($jupi_opt['paypal_card']); ?>"><i class="fab fa-cc-paypal"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($jupi_opt['mastercard_card'])): ?>
                            <a href="<?php echo esc_url($jupi_opt['mastercard_card']); ?>"><i class="fab fa-cc-mastercard"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($jupi_opt['jcb_card'])): ?>
                            <a href="<?php echo esc_url($jupi_opt['jcb_card']); ?>"><i class="fab fa-cc-jcb"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($jupi_opt['discover_card'])): ?>
                            <a href="<?php echo esc_url($jupi_opt['discover_card']); ?>"><i class="fab fa-cc-discover"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($jupi_opt['diners_club_card'])): ?>
                            <a href="<?php echo esc_url($jupi_opt['diners_club_card']); ?>"><i class="fab fa-cc-diners-club"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($jupi_opt['apple_pay_card'])): ?>
                            <a href="<?php echo esc_url($jupi_opt['apple_pay_card']); ?>"><i class="fab fa-cc-apple-pay"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($jupi_opt['amex_card'])): ?>
                            <a href="<?php echo esc_url($jupi_opt['amex_card']); ?>"><i class="fab fa-cc-amex"></i></a>
                            <?php endif; ?>
                            <?php if(!empty($jupi_opt['amazon_pay_card'])): ?>
                            <a href="<?php echo esc_url($jupi_opt['amazon_pay_card']); ?>"><i class="fab fa-cc-amazon-pay"></i></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
</footer>
<?php } 
endif; ?>
<?php wp_footer(); ?>
</body>

</html>