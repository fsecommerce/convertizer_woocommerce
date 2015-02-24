<?php
/*
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
/* Runs when plugin is activated */
register_activation_hook(__FILE__,'convertizer_install'); 
/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'convertizer_remove' );
function convertizer_install() {
/* Creates new database field */
add_option("convertizer_data", 'Default', '', 'yes');
}
function convertizer_remove() {
/* Deletes the database field */
delete_option('convertizer_data');
}
?>

<?php
/* CHECK FOR WOOCOMMERCE PLUGIN */
if (in_array( 'woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))){
	foreach ( glob( plugin_dir_path( __FILE__ ) . "functions/*.php" ) as $file ) {
    	include_once $file;
	}
}
?>