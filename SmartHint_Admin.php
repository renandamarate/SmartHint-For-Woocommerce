<?php
/**
 * Plugin Name: Smarthint - Smart Recommendations
 * Plugin URI: http://smarthint.co
 * Description: E-commerce Recommendation System increases the engagement and conversion rate by at least 35%. Like many online retailers, power up your sales serving to every customer as if they are unique. “For years, more than 35% of sales have been motivated by the recommendation system.” Jeff Bezos, CEO of Amazon.com.

 * Version: 2.0.0
 * Author: WooCommerce
 * Author URI: http://smarthint.co
 * Developer: Carlos Renan Damarate
 * Developer URI: http://smarthint.co
 * Text Domain: smarthint
 * Domain Path: /lang
 * 
 * WC requires at least: 2.2
 * WC tested up to: 3.3.4
 *
 * Copyright: © 2009-2015 WooCommerce.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// Check for WooCommerce
if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	echo('<div class="error"><p>Smarthint requires WooCommerce 2.2 or higher.</p></div></div>');
}

require_once( plugin_dir_path( __FILE__ ) . 'SmartHint_Actions.php' );

function my_plugin_action_links( $links ) {
	$site = str_replace("/site", "", get_option("siteurl"));
	$links = array_merge( array(
		'<a href="' . esc_url( $site . 
								"/wc-auth/v1/authorize?app_name=SmartHint&scope=read_write&user_id=" .
								get_option("admin_email") . "," .
								get_option("blogname") . "," .
								$site . "," .
								get_locale() . "," .
								get_option("template") . "," .
								get_option("woocommerce_version") .
								"&return_url=https://admin.smarthint.co/Woocommerce" .
								"&callback_url=https://admin.smarthint.co/Account/NewWooCommerceUserAPI"
		) . '">' . __( 'Activate Account', 'textdomain' ) . '</a>'
	), $links );
	return $links;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'my_plugin_action_links' );