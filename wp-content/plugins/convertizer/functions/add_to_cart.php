<?php
/*
File: add_to_cart.php
Plugin Name: Convertizer WooCommerce Plugin
Plugin URI: http://convertizer.com/
Description: Add product to cart from convertizer landing pages by sku
Version: 0.1 beta
Author: FS eCommerce GmbH
Author URI: http://fs-ecommerce.com
License: GPL
*/
?>
<?php
function add_query_vars_filter($vars){
  		$vars[] = "convertizer_add_product_to_cart";
  		return $vars;
	}
	function hook_query(){
  		if(get_query_var('convertizer_add_product_to_cart')){
  			$sku		= get_query_var('convertizer_add_product_to_cart');
			/* SEARCH PRODUCT BY SKU */
			$productId	= get_product_by_sku($sku);
			if($productId){
				$cartUrl	= get_cart_url();
				/* BUILD URL FOR ADD TO CART AND REDIRECT TO CART */
				$location	= $cartUrl . '&' . http_build_query(array('add-to-cart'=>$productId));
				wp_redirect($location);
				exit;
			}else{
				/* NO PRODUCT - REDIRECT TO SHOP URL */
				wp_redirect(get_shop_url());
				exit;
			}
  		}
	}
	function get_product_by_sku( $sku ) {
		global $wpdb;

  		$product_id = $wpdb->get_var( $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ));
  		if($product_id){
  			//return new WC_Product( $product_id );
  			return $product_id;
  		}
  		return null;
	}
	function get_cart_url(){
		global $woocommerce;
		return $woocommerce->cart->get_cart_url();
	}
	function get_shop_url(){
		return get_permalink( woocommerce_get_page_id( 'shop' ) );
	}
	add_filter( 'query_vars', 'add_query_vars_filter' );
	add_action( 'parse_query', 'hook_query');	
?>