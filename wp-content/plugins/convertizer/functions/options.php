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
if ( is_admin() ){
	// create custom plugin settings menu
	add_action('admin_menu', 'convertizer_create_menu');
}

function convertizer_create_menu() {
	//create new top-level menu
	add_menu_page('Convertizer Plugin Settings', 'Convertizer', 'administrator', __FILE__, 'convertizer_settings_page',plugins_url('/images/icon.png', __FILE__));
	//call register settings function
	add_action( 'admin_init', 'register_convertizer_settings' );
}

function register_convertizer_settings() {
	//register our settings
	register_setting( 'convertizer-settings-group', 'convertizer_tracking_code' );
}

function convertizer_settings_page() {
?>
<div class="wrap">
<h2>Convertizer WooCommerce Plugin</h2>
<form method="post" action="options.php">
    <?php settings_fields( 'convertizer-settings-group' ); ?>
    <?php do_settings_sections( 'convertizer-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Tracking ID</th>
	        <td>
	        	<input type="text" name="convertizer_tracking_code" value="<?php echo esc_attr(get_option('convertizer_tracking_code')); ?>" />
	        </td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php } ?>