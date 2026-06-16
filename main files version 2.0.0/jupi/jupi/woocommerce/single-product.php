<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );
the_post();
?>
<?php get_template_part('template-parts/site-header'); ?> 
<?php woocommerce_output_content_wrapper(); ?>   
<div class="row">
    <div class="col-xs-12 <?php echo ( (is_active_sidebar('sidebar-shop')) ? 'col-md-9' : '' ); ?>">
        <?php wc_get_template_part( 'content', 'single-product' ); ?>
    </div>
    <div class="col-xs-12 <?php echo ( (is_active_sidebar('sidebar-shop')) ? 'col-md-3' : '' ); ?>">
        <?php do_action( 'woocommerce_sidebar' ); ?>
    </div>
</div>
<?php
do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' );