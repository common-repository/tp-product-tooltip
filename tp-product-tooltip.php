<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.tplugins.com/
 * @since             1.0.0
 * @package           Tp_Woocommerce_Product_Tooltip
 *
 * @wordpress-plugin
 * Plugin Name:       TP Product Tooltip for WooCommerce
 * Plugin URI:        https://www.tplugins.com/
 * Description:       Increase your sales by adding beautiful designed Tooltip to your woocommerce products.
 * Version:           1.0.4
 * Author:            TP Plugins
 * Author URI:        https://www.tplugins.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tp-woocommerce-product-tooltip
 * Domain Path:       /languages
 * WC requires at least: 3.0
 * WC tested up to: 6.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('TP_WOOCOMMERCE_PRODUCT_TOOLTIP_VERSION', '1.0.4' );
define('TPWPT_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('TPWPT_PLUGIN_HOME', 'https://www.tplugins.com/');
define('TPWPT_PLUGIN_API', 'https://www.tplugins.com/tp-services');
define('TPWPT_PLUGIN_NAME', 'TP Woocommerce Product Tooltip');
define('TPWPT_PLUGIN_SLUG', 'tp-woocommerce-product-tooltip');
define('TPWPT_PLUGIN_PRO_SLUG', 'tp-woocommerce-product-tooltip-pro');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tp-woocommerce-product-tooltip-activator.php
 */
function activate_tp_woocommerce_product_tooltip() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tp-woocommerce-product-tooltip-activator.php';
	Tp_Woocommerce_Product_Tooltip_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tp-woocommerce-product-tooltip-deactivator.php
 */
function deactivate_tp_woocommerce_product_tooltip() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tp-woocommerce-product-tooltip-deactivator.php';
	Tp_Woocommerce_Product_Tooltip_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tp_woocommerce_product_tooltip' );
register_deactivation_hook( __FILE__, 'deactivate_tp_woocommerce_product_tooltip' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tp-woocommerce-product-tooltip.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tp_woocommerce_product_tooltip() {

	$plugin = new Tp_Woocommerce_Product_Tooltip();
	$plugin->run();

}
run_tp_woocommerce_product_tooltip();