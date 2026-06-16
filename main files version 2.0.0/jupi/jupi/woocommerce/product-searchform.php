<?php

/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
	exit;
}

?>
<form role="search" method="get" class="product-search" action="<?php echo esc_url(home_url('/')); ?>">
	<div class="product-search-form">
		<input type="search" name="s" class="search-input" placeholder="<?php esc_attr_e('Search your Product...', 'jupi'); ?>" value="<?php echo esc_attr(get_search_query()); ?>">
		<button type="submit" class="search-bttn"><i class="flaticon-magnifying-glass"></i></button>
	</div>
</form>