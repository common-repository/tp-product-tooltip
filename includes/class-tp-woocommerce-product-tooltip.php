<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.tplugins.com/
 * @since      1.0.0
 *
 * @package    Tp_Woocommerce_Product_Tooltip
 * @subpackage Tp_Woocommerce_Product_Tooltip/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Tp_Woocommerce_Product_Tooltip
 * @subpackage Tp_Woocommerce_Product_Tooltip/includes
 * @author     tplugins <pluginstp@gmail.com>
 */
class Tp_Woocommerce_Product_Tooltip {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Tp_Woocommerce_Product_Tooltip_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'TP_WOOCOMMERCE_PRODUCT_TOOLTIP_VERSION' ) ) {
			$this->version = TP_WOOCOMMERCE_PRODUCT_TOOLTIP_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'tp-woocommerce-product-tooltip';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tp_Woocommerce_Product_Tooltip_Loader. Orchestrates the hooks of the plugin.
	 * - Tp_Woocommerce_Product_Tooltip_i18n. Defines internationalization functionality.
	 * - Tp_Woocommerce_Product_Tooltip_Admin. Defines all hooks for the admin area.
	 * - Tp_Woocommerce_Product_Tooltip_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tp-woocommerce-product-tooltip-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tp-woocommerce-product-tooltip-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tp-woocommerce-product-tooltip-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-tp-woocommerce-product-tooltip-public.php';

		$this->loader = new Tp_Woocommerce_Product_Tooltip_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Tp_Woocommerce_Product_Tooltip_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Tp_Woocommerce_Product_Tooltip_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Tp_Woocommerce_Product_Tooltip_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'tpwpt_register_options_page' );

		$this->loader->add_filter( 'plugin_action_links_'.TPWPT_PLUGIN_BASENAME, $plugin_admin,'tpwpt_settings_link', 10, 2 );
		$this->loader->add_filter( 'plugin_row_meta', $plugin_admin, 'tpwpt_get_pro_link', 10, 2 );

		//if(TP_Woocommerce_Product_Tooltip_Rest_Api::check_api_state()) {

			$this->loader->add_filter( 'woocommerce_product_data_tabs', $plugin_admin, 'add_tp_product_tooltip_data_tab' , 99 , 1 );
			$this->loader->add_action( 'woocommerce_product_data_panels', $plugin_admin, 'add_tp_product_tooltip_data_fields' );
			$this->loader->add_action( 'woocommerce_process_product_meta', $plugin_admin, 'woocommerce_process_product_meta_fields_save' );
		//}

		$this->loader->add_action( 'wp_ajax_tpwpt_rest_api_ajax', $plugin_admin, 'tpwpt_rest_api_ajax');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Tp_Woocommerce_Product_Tooltip_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		//if(TP_Woocommerce_Product_Tooltip_Rest_Api::check_api_state()){
			//$this->loader->add_action( 'init', $plugin_public, 'tooltip_hooks' );
			$this->loader->add_action( 'wp', $plugin_public, 'tooltip_hooks' );
			//$this->loader->add_action( 'woocommerce_single_product_summary', $plugin_public, 'display_tooltip', 10 );
			//$this->loader->add_action( 'woocommerce_after_shop_loop_item_title', $plugin_public, 'display_tooltip', 10 );
			//$this->loader->add_action( 'woocommerce_shop_loop_item_title', $plugin_public, 'display_tooltip', 10 );
			$this->loader->add_action( 'woocommerce_before_shop_loop_item', $plugin_public, 'display_tooltip', 10 );

			//$this->loader->add_action( 'wp_footer', $plugin_public, 'custom_tooltip_javascript');
			//$this->loader->add_action( 'wp_footer', $plugin_public, 'custom_tooltip_style');
		//}

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Tp_Woocommerce_Product_Tooltip_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
