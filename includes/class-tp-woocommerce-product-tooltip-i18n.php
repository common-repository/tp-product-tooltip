<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.tplugins.com/
 * @since      1.0.0
 *
 * @package    Tp_Woocommerce_Product_Tooltip
 * @subpackage Tp_Woocommerce_Product_Tooltip/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tp_Woocommerce_Product_Tooltip
 * @subpackage Tp_Woocommerce_Product_Tooltip/includes
 * @author     tplugins <pluginstp@gmail.com>
 */
class Tp_Woocommerce_Product_Tooltip_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tp-woocommerce-product-tooltip',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
