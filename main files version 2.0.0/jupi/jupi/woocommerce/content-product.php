<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}


$column = '';

if( wc_get_loop_prop( 'columns' ) == 1 ){
    $column = 'col-xs-12 col-sm-12 col-md-12';
}
if( wc_get_loop_prop( 'columns' ) == 2 ){
    $column = 'col-xs-12 col-sm-6 col-md-6';
}
if( wc_get_loop_prop( 'columns' ) == 3 ){
    $column = 'col-xs-12 col-sm-6 col-md-4';
}
if( wc_get_loop_prop( 'columns' ) == 4 ){
    $column = 'col-xs-12 col-sm-6 col-md-3';
}


?>
<div <?php wc_product_class( $column ); ?>>
    <div class="product-box">
       <div class="product-image">
           <?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
       </div>
       <div class="product-content">
             <?php
                echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="category">', '</div>' );
                woocommerce_template_loop_product_link_open();
                do_action( 'woocommerce_shop_loop_item_title' );
                woocommerce_template_loop_product_link_close();
                woocommerce_template_loop_price();
           ?>
       </div>
    </div>
</div>
