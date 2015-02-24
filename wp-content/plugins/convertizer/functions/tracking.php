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

add_action( 'woocommerce_thankyou', 'convertizer_custom_tracking' );
 
function convertizer_custom_tracking(){
	if(	get_option('convertizer_tracking_code') 
		&& esc_attr(get_option('convertizer_tracking_code')) != ''
		&& get_query_var('order-received')
	  ){
		$order_id	= get_query_var('order-received');
		$trackingId	= esc_attr(get_option('convertizer_tracking_code'));
		$order 		= new WC_Order($order_id);
?>
<script type="text/javascript">
/* Convertizer Tracking Code*/
//<![CDATA[
	var trackingid 	= '<?php echo $trackingId; ?>';
	var amount		= '<?php echo $order->get_total()-$order->get_total_tax(); ?>';
	var ordertype	= 1;
    var orderid 	= '<?php echo $order_id ?>';
	(function(){
		var js = document.createElement('script');
			js.type = 'text/javascript';
			js.async = true;
			js.src = ('https:' == document.location.protocol ?
		'https://' : 'http://') + 'convertizer-commerce.com/static/convertizer.js';
		var tag = document.getElementsByTagName('script')[0];
		tag.parentNode.insertBefore(js, tag);
	})();
//]]>
/* Convertizer Tracking Code*/
</script>
<?php }} ?>