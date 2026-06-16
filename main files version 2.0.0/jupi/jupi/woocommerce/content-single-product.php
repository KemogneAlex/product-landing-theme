<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>

<div class="single-product-area">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="product-image-area">
                <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="product-details-area">            
                <?php
                    /**
                     * Hook: woocommerce_single_product_summary.
                     *
                     * @hooked woocommerce_template_single_rating - 5
                     * @hooked jupi_get_product_category_list - 10
                     * @hooked woocommerce_template_single_title - 15
                     * @hooked woocommerce_template_single_price - 20
                     * @hooked woocommerce_template_single_meta - 25
                     * @hooked woocommerce_template_single_excerpt - 30
                     * @hooked woocommerce_template_single_add_to_cart - 40
                     * @hooked WC_Structured_Data::generate_product_data() - 60
                     */
                    do_action( 'woocommerce_single_product_summary' );
                ?>
            </div>
        </div>
    </div>
</div>

	<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
