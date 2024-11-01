<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.tplugins.com/
 * @since      1.0.0
 *
 * @package    Tp_Woocommerce_Product_Tooltip
 * @subpackage Tp_Woocommerce_Product_Tooltip/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tp_Woocommerce_Product_Tooltip
 * @subpackage Tp_Woocommerce_Product_Tooltip/admin
 * @author     tplugins <pluginstp@gmail.com>
 */
class Tp_Woocommerce_Product_Tooltip_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tp_Woocommerce_Product_Tooltip_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tp_Woocommerce_Product_Tooltip_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tp-woocommerce-product-tooltip-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-tp_tooltip_minicolors', plugin_dir_url( __FILE__ ) . 'css/jquery.tp_tooltip_minicolors.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tp_Woocommerce_Product_Tooltip_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tp_Woocommerce_Product_Tooltip_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name.'-tp_tooltip_minicolors', plugin_dir_url( __FILE__ ) . 'js/jquery.tp_tooltip_minicolors.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tp-woocommerce-product-tooltip-admin.js', array( 'jquery' ), $this->version, false );

		wp_register_script( 'tpwpt-ajax-core-admin', plugin_dir_url(__FILE__).'js/tpwpt-ajax-core-admin.js', array('jquery') );
		wp_localize_script( 'tpwpt-ajax-core-admin', 'tpwptParam', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) , 'lkeystate' => get_option('tpwpt_lkey_state') , 'lkeysms1' => esc_attr__('Please enter a valid license key', 'wtppcs')));
		//wp_enqueue_script( 'jquery' );
   		wp_enqueue_script( 'tpwpt-ajax-core-admin' );

	}

	//-------------------------------------------------------------------------------------------------------

	public function tpwpt_register_options_page() {
		add_menu_page( 'TP Woocommerce Product Tooltip', 'TP Woocommerce Product Tooltip', 'manage_options', 'tpwpt_settings', array( $this, 'tpwpt_plugin_options_page' ), 'dashicons-admin-tp', 110 );
	}

	public function tpwpt_plugin_options_page()	{
		
		$_tpt_product_category_tooltip_background = get_option('_tpt_product_category_tooltip_background');
		$_tpt_product_category_tooltip_color = get_option('_tpt_product_category_tooltip_color');
		$_tpt_product_category_tooltip_popup_animation = get_option('_tpt_product_category_tooltip_popup_animation');
		$_tpt_product_category_tooltip_border = get_option('_tpt_product_category_tooltip_border');
		$_tpt_product_category_tooltip_position = get_option('_tpt_product_category_tooltip_position');
		$_tpt_product_category_tooltip_position_mobile = get_option('_tpt_product_category_tooltip_position_mobile');
		$_tpt_product_category_tooltip_title_position = get_option('_tpt_product_category_tooltip_title_position');
		$_tpt_product_category_tooltip_width = get_option('_tpt_product_category_tooltip_width');
		$_tpt_product_category_tooltip_text_align = get_option('_tpt_product_category_tooltip_text_align');

		$_tpt_product_category_tooltip_background = ($_tpt_product_category_tooltip_background) ? $_tpt_product_category_tooltip_background : '#EEEEEE';
		$_tpt_product_category_tooltip_color = ($_tpt_product_category_tooltip_color) ? $_tpt_product_category_tooltip_color : '#606163';
		$_tpt_product_category_tooltip_popup_animation = ($_tpt_product_category_tooltip_popup_animation) ? $_tpt_product_category_tooltip_popup_animation : 'fadeIn';
		$_tpt_product_category_tooltip_border = ($_tpt_product_category_tooltip_border) ? $_tpt_product_category_tooltip_border : 'none';
		$_tpt_product_category_tooltip_position = ($_tpt_product_category_tooltip_position) ? $_tpt_product_category_tooltip_position : 'bottom_left';
		$_tpt_product_category_tooltip_position_mobile = ($_tpt_product_category_tooltip_position_mobile) ? $_tpt_product_category_tooltip_position_mobile : 'bottom';
		$_tpt_product_category_tooltip_title_position = ($_tpt_product_category_tooltip_title_position) ? $_tpt_product_category_tooltip_title_position : 'left';
		$_tpt_product_category_tooltip_text_align = ($_tpt_product_category_tooltip_text_align) ? $_tpt_product_category_tooltip_text_align : 'left';
		$_tpt_product_category_tooltip_width = ($_tpt_product_category_tooltip_width) ? $_tpt_product_category_tooltip_width : 200;
		
		?>
		<div class='wrap tpwpt-warp'>
			<?php screen_icon(); ?>
			<h2>TP Woocommerce Product Tooltip</h2>
			<form method="post" action="options.php">
				<?php //wp_nonce_field('update-options') ?>
				<?php wp_nonce_field('update-options') ?>

				<nav id="tpwpt-tab-nav">
					<span class="tabnav" data-sort="1">Settings product category (PRO)</span>
					<span class="tabnav" data-sort="6">License (Get PRO)</span>
				</nav>

				<div id="tpwpt-tab-contents">

					<div class="tabtxt tps_admin_section" data-sort="1">

						<div class="tpwpt_admin_settings_left">

							<div class="tpwpt_admin_settings_row tpcolor">
								<div class="tpwpt_triangle_topright_box"><div class="tpwpt_triangle_topright"><span>PRO</span></div></div>
								<label class="tpwpt-container-text">Tooltip Background</label>
								<input type="text" name="_tpt_product_category_tooltip_background" value="#EEEEEE" >

								<span class="tpwpt_admin_settings_desc">Tooltip Background</span>

							</div><!-- tpwpt_admin_settings_row -->

							<div class="tpwpt_admin_settings_row tpcolor">
								<div class="tpwpt_triangle_topright_box"><div class="tpwpt_triangle_topright"><span>PRO</span></div></div>
								<label class="tpwpt-container-text">Tooltip Color</label>
								<input type="text" name="_tpt_product_category_tooltip_color" value="#606163" >

								<span class="tpwpt_admin_settings_desc">Tooltip Color</span>

							</div><!-- tpwpt_admin_settings_row -->

							<div class="tpwpt_admin_settings_row">
								<div class="tpwpt_triangle_topright_box"><div class="tpwpt_triangle_topright"><span>PRO</span></div></div>
								<label class="tpwpt-container-text">Tooltip Popup Animation</label>
								<?php echo $this->get_animations_select('_tpt_product_category_tooltip_popup_animation','fadeIn') ?>

							</div><!-- tpwpt_admin_settings_row -->

							<div class="tpwpt_admin_settings_row">
								<div class="tpwpt_triangle_topright_box"><div class="tpwpt_triangle_topright"><span>PRO</span></div></div>
								<label class="tpwpt-container-text">Title Position</label>
								<select id="_tpt_product_category_tooltip_title_position" name="_tpt_product_category_tooltip_title_position" class="select short">
									<option value="left">left</option>
									<option value="right">right</option>
								</select>
							</div><!-- tpwpt_admin_settings_row -->


							<div class="tpwpt_admin_settings_row">
								<div class="tpwpt_triangle_topright_box"><div class="tpwpt_triangle_topright"><span>PRO</span></div></div>
								<label class="tpwpt-container-text">Tooltip width</label>
								<input type="text" name="_tpt_product_category_tooltip_width" value="200" >
							</div><!-- tpwpt_admin_settings_row -->


							<div class="tpwpt_admin_settings_row">
								<div class="tpwpt_triangle_topright_box"><div class="tpwpt_triangle_topright"><span>PRO</span></div></div>
								<label class="tpwpt-container-text">Tooltip Position</label>
								<select id="_tpt_product_category_tooltip_position" name="_tpt_product_category_tooltip_position" class="select short">
									<option value="bottom_left">bottom (left)</option>
									<option value="bottom_right">bottom (right)</option>
									<option value="top_left">top (left)</option>
									<option value="top_right">top (right)</option>
									<option value="right_top">right (top)</option>
									<option value="right_bottom">right (bottom)</option>
									<option value="left_top">left (top)</option>
									<option value="left_bottom">left (bottom)</option>		
								</select>
							</div><!-- tpwpt_admin_settings_row -->

							<div class="tpwpt_admin_settings_row">
								<div class="tpwpt_triangle_topright_box"><div class="tpwpt_triangle_topright"><span>PRO</span></div></div>
								<label class="tpwpt-container-text">Tooltip Position Mobile</label>
								<select id="_tpt_product_category_tooltip_position_mobile" name="_tpt_product_category_tooltip_position_mobile" class="select short">
									<option value="bottom">bottom</option>
									<option value="top">top</option>		
								</select>
							</div><!-- tpwpt_admin_settings_row -->

							<div class="tpwpt_admin_settings_row">
								<div class="tpwpt_triangle_topright_box"><div class="tpwpt_triangle_topright"><span>PRO</span></div></div>
								<label class="tpwpt-container-text">Tooltip Border</label>
								<select id="_tpt_product_category_tooltip_border" name="_tpt_product_category_tooltip_border" class="select short">
									<option value="none">none</option>
									<option value="solid">solid</option>
										<option value="dashed">dashed</option>
									<option value="dotted">dotted</option>
								</select>
							</div><!-- tpwpt_admin_settings_row -->

							<div class="tpwpt_admin_settings_row">
								<div class="tpwpt_triangle_topright_box"><div class="tpwpt_triangle_topright"><span>PRO</span></div></div>
								<label class="tpwpt-container-text">Text align</label>
								<select id="_tpt_product_category_tooltip_text_align" name="_tpt_product_category_tooltip_text_align" class="select short">
									<option value="left">left</option>
									<option value="right">right</option>
									<option value="center">center</option>
								</select>
							</div><!-- tpwpt_admin_settings_row -->

						</div><!-- tpwpt_admin_settings_left -->

						<div class="tpwpt_admin_settings_right">
						</div><!-- tpwpt_admin_settings_right -->

					</div><!-- tps_admin_section -->

					<div class="tabtxt tps_admin_section" data-sort="6">
						<h2>Free Version</h2>
						<a href="https://www.tplugins.com/product/tp-woocommerce-product-tooltip-pro/" target="_blank">Upgrade from the FREE version to the PRO version</a>
					</div><!-- tps_admin_section -->

				</div><!-- tpwpt-tab-contents -->

				<input type="submit" name="Submit" value="Update Options" class="tps-gcf-submit" />
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="" />
			</form>

			<script>

			var tab = {
				nav : null, // holds all tabs
				txt : null, // holds all text containers
				init : function () {
				// tab.init() : init tab interface
			
				// Get all tabs + contents
				tab.nav = document.getElementById("tpwpt-tab-nav").getElementsByClassName("tabnav");
				tab.txt = document.getElementById("tpwpt-tab-contents").getElementsByClassName("tabtxt");
			
				// Error checking
				if (tab.nav.length==0 || tab.txt.length==0 || tab.nav.length!=tab.txt.length) {
					console.log("ERROR STARTING TABS");
				} else {
					// Attach onclick events to navigation tabs
					for (var i=0; i<tab.nav.length; i++) {
					tab.nav[i].dataset.pos = i;
					tab.nav[i].addEventListener("click", tab.switch);
					}
			
					// Default - show first tab
					tab.nav[0].classList.add("active");
					tab.txt[0].classList.add("active");
				}
				},
			
				switch : function () {
				// tab.switch() : change to another tab
			
				// Hide all tabs & text
				for (var t of tab.nav) {
					t.classList.remove("active");
				}
				for (var t of tab.txt) {
					t.classList.remove("active");
				}
			
				// Set current tab
				tab.nav[this.dataset.pos].classList.add("active");
				tab.txt[this.dataset.pos].classList.add("active");
				}
			};
			
			window.addEventListener("load", tab.init);

			</script>

		</div><!-- wrap tpwpt-warp -->
		<?php
	}

	public function add_tp_product_tooltip_data_tab( $product_data_tabs ) {
		$product_data_tabs['tp-tooltip-tab'] = array(
			'label' => __( 'TP Tooltip', 'my_text_domain' ),
			'target' => 'tp_product_tooltip_data',
		);
		return $product_data_tabs;
	}

	public function add_tp_product_tooltip_data_fields() {
		global $woocommerce, $post;
		//wp_dbug($post);
		//$_tpt_css_background = get_post_meta($post->ID, '_tpt_css_background', true);
		$_tpt_css_background = (get_post_meta($post->ID, '_tpt_css_background', true)) ? get_post_meta($post->ID, '_tpt_css_background', true) : '#EEEEEE';
		$_tpt_css_color = (get_post_meta($post->ID, '_tpt_css_color', true)) ? get_post_meta($post->ID, '_tpt_css_color', true) : '#444444';
		$_tpt_min_width = (get_post_meta($post->ID, '_tpt_min_width', true)) ? get_post_meta($post->ID, '_tpt_min_width', true) : 200;
		?>
		<!-- id below must match target registered in above add_tp_product_tooltip_data_tab function -->
		<div id="tp_product_tooltip_data" class="panel woocommerce_options_panel">
			<?php
			woocommerce_wp_checkbox( array( 
				'id'            => '_tpt_activate', 
				//'wrapper_class' => 'show_if_simple', 
				'label'         => __( 'Display', 'my_text_domain' ),
				'description'   => __( 'if checked will display tooltip in product page', 'my_text_domain' ),
				'default'       => '0',
				'desc_tip'      => false,
			) );

			woocommerce_wp_checkbox( array( 
				'id'            => '_tpt_activate_in_category_pro', 
				//'wrapper_class' => 'show_if_simple', 
				'label'         => __( 'Display', 'my_text_domain' ),
				'description'   => __( 'if checked will display tooltip in product category page <span class="tpwpt_pro_span">PRO</span>', 'my_text_domain' ),
				'default'       => '0',
				'desc_tip'      => false,
				'custom_attributes' => array('disabled' => 'disabled'),
			) );

			woocommerce_wp_select( array(
				'id' => '_tpt_position',
				'label' => __('Tooltip Position', 'my_text_domain'),
				'placeholder' => '',
				'options' => array(
					'bottom_left'  => 'bottom (left)',
					'bottom_right' => 'bottom (right)',
					'top_left'     => 'top (left)',
					'top_right'    => 'top (right)',
					'right_top'    => 'right (top)',
					'right_bottom' => 'right (bottom)',
					'left_top'     => 'left (top)',
					'left_bottom'  => 'left (bottom)'
				)
			) );

			woocommerce_wp_select( array(
				'id' => '_tpt_position_mobile',
				'label' => __('Tooltip Position Mobile', 'my_text_domain'),
				'placeholder' => '',
				'options' => array(
					'bottom' => 'bottom',
					'top'    => 'top'
				)
			) );

			woocommerce_wp_text_input( array(
				'id'            => '_tpt_css_background',
				'label'         => __('Tooltip Background', 'my_text_domain'),
				'type'          => 'text',
				'value'         => $_tpt_css_background,
				'wrapper_class' => 'tpcolor',
				//'custom_attributes' => array('step' => 'any', 'min' => '0')
			) );

			woocommerce_wp_text_input( array(
				'id'            => '_tpt_css_color',
				'label'         => __('Tooltip Color', 'my_text_domain'),
				'type'          => 'text',
				'value'         => $_tpt_css_color,
				'wrapper_class' => 'tpcolor',
				//'custom_attributes' => array('step' => 'any', 'min' => '0')
			) );

			woocommerce_wp_text_input( array(
				'id'          => '_tpt_hover_title',
				//'label'       => __('Credit Amount (' . get_woocommerce_currency_symbol() . ')', 'woocommerce'),
				'label'       => __('Tooltip hover Title', 'my_text_domain'),
				//'placeholder' => '0.00',
				'desc_tip'    => 'true',
				'description' => __('The amount of credits for this product in currency format.', 'my_text_domain'),
				'type'        => 'text',
				//'custom_attributes' => array('step' => 'any', 'min' => '0')
			) );

			woocommerce_wp_select( array(
				'id' => '_tpt_popup_animation',
				'label' => __('Tooltip Popup Animation', 'my_text_domain'),
				'description' => __('<strong>42 more animations in PRO Version</strong>', 'my_text_domain'),
				'placeholder' => '',
				'options' => array(
					'none' => 'none',
					'fadeIn' => 'fadeIn',
				)
			) );

			woocommerce_wp_select( array(
				'id' => '_tpt_icon',
				'label' => __('Tooltip hover Icons', 'my_text_domain'),
				'placeholder' => '',
				'options' => array(
					'wcicon-none'             => 'None',
					'wcicon-storefront'            => 'storefront',
					'wcicon-ccv'            => 'ccv',
					'wcicon-virtual'            => 'virtual',
					'wcicon-up-down'            => 'up-down',
					'wcicon-reports'            => 'reports',
					'wcicon-refresh'            => 'refresh',
					'wcicon-navigation'            => 'navigation',
					'wcicon-status-fill'            => 'status-fill',
					'wcicon-contract'            => 'contract',
					'wcicon-downloadable'            => 'downloadable',
					'wcicon-simple'            => 'simple',
					'wcicon-on-hold'            => 'on-hold',
					'wcicon-external'            => 'external',
					'wcicon-contract-2'            => 'contract-2',
					'wcicon-expand-2'            => 'expand-2',
					'wcicon-phone'            => 'phone',
					'wcicon-user'            => 'user',
					'wcicon-status'            => 'status',
					'wcicon-status-pending'            => 'status-pending',
					'wcicon-status-cancelled'            => 'status-cancelled',
					'wcicon-mail'            => 'mail',
					'wcicon-inventory'            => 'inventory',
					'wcicon-attributes'            => 'attributes',
					'wcicon-west'            => 'west',
					'wcicon-south'            => 'south',
					'wcicon-north'            => 'north',
					'wcicon-east'            => 'east',
					'wcicon-note'            => 'note',
					'wcicon-windows'            => 'windows',
					'wcicon-user2'            => 'user2',
					'wcicon-search-2'            => 'search-2',
					'wcicon-search'            => 'search',
					'wcicon-star-empty'            => 'star-empty',
					'wcicon-share'            => 'share',
					'wcicon-phone-fill'            => 'phone-fill',
					'wcicon-user-fill'            => 'user-fill',
					'wcicon-grouped'            => 'grouped',
					'wcicon-status-refunded'            => 'status-refunded',
					'wcicon-status-completed'            => 'status-completed',
					'wcicon-variable'            => 'variable',
					'wcicon-expand'            => 'expand',
					'wcicon-status-failed'            => 'info',
					'wcicon-check'            => 'check',
					'wcicon-left'            => 'arrow left',
					'wcicon-right'            => 'arrow right',
					'wcicon-up'            => 'arrow up',
					'wcicon-down'            => 'arrowdown',
					'wcicon-query'            => 'query',
					'wcicon-truck-1'            => 'truck-1',
					'wcicon-truck-2'            => 'truck-2',
					'wcicon-image'            => 'image',
					'wcicon-globe'            => 'globe',
					'wcicon-link'            => 'link',
					'wcicon-gear'            => 'gear',
					'wcicon-calendar'            => 'calendar',
					'wcicon-cart'            => 'cart',
					'wcicon-processing'            => 'processing',
					'wcicon-card'            => 'card',
					'wcicon-view'            => 'view',
					'wcicon-stats'            => 'stats',
					'wcicon-status-processing'            => 'status-processing',
					'wcicon-star-full'            => 'star-full',
					'wcicon-coupon'            => 'coupon',
					'wcicon-limit'            => 'limit',
					'wcicon-restricted'            => 'restricted',
					'wcicon-edit'            => 'edit',
				)
			) );

			woocommerce_wp_text_input( array(
				'id'          => '_tpt_min_width',
				//'label'       => __('Credit Amount (' . get_woocommerce_currency_symbol() . ')', 'woocommerce'),
				'label'       => __('Tooltip Width', 'my_text_domain'),
				//'placeholder' => '0.00',
				//'desc_tip'    => 'true',
				'description' => __('The Tooltip min width in px (default: 200)', 'my_text_domain'),
				'type'        => 'number',
				'value'       => $_tpt_min_width,
				//'custom_attributes' => array('step' => 'any', 'min' => '0')
			) );

			woocommerce_wp_text_input( array(
				'id'          => '_tpt_height',
				//'label'       => __('Credit Amount (' . get_woocommerce_currency_symbol() . ')', 'woocommerce'),
				'label'       => __('Tooltip Height', 'my_text_domain'),
				//'placeholder' => '0.00',
				//'desc_tip'    => 'true',
				'description' => __('The Tooltip Height in px (default: auto)', 'my_text_domain'),
				'type'        => 'number',
				//'value'       => 'auto',
				//'custom_attributes' => array('step' => 'any', 'min' => '0')
			) );

			woocommerce_wp_select( array(
				'id' => '_tpt_border',
				'label' => __('Tooltip Border', 'my_text_domain'),
				'placeholder' => '',
				'options' => array(
					'none'       => 'none',
					'solid'       => 'solid',
					'dashed'       => 'dashed',
					'dotted'       => 'dotted',
				),
			) );

			woocommerce_wp_text_input( array(
				'id'          => '_tpt_title',
				//'label'       => __('Credit Amount (' . get_woocommerce_currency_symbol() . ')', 'woocommerce'),
				'label'       => __('Tooltip Title', 'my_text_domain'),
				//'placeholder' => '0.00',
				'desc_tip'    => 'true',
				'description' => __('The amount of credits for this product in currency format.', 'my_text_domain'),
				'type'        => 'text',
				//'custom_attributes' => array('step' => 'any', 'min' => '0')
			) );

			woocommerce_wp_textarea_input( array(
				'id' => '_tpt_description',
				'label' => __('Tooltip Description', 'my_text_domain'),
				'placeholder' => '',
				'description' => __('Description, short code allowed: [pname], [pexcerpt], [pcontent], [youtube]', 'my_text_domain')
			) );

			woocommerce_wp_text_input( array(
				'id'          => '_tpt_youtube_pro',
				'label'       => __('Tooltip Youtube', 'my_text_domain'),
				'desc_tip'    => false,
				'description' => __('Put [youtube] in your text to display video <span class="tpwpt_pro_span">PRO</span>', 'my_text_domain'),
				'type'        => 'text',
				'custom_attributes' => array('disabled' => 'disabled'),
			) );

			woocommerce_wp_text_input( array(
				'id'            => '_tpt_youtube_icon_color_pro',
				'label'         => __('Tooltip Youtube Icon Color', 'my_text_domain'),
				'type'          => 'text',
				'wrapper_class' => 'tpcolor',
				'description' => __('<span class="tpwpt_pro_span">PRO</span>', 'my_text_domain'),
				'custom_attributes' => array('disabled' => 'disabled'),
			) );

			woocommerce_wp_select( array(
				'id' => '_tpt_youtube_image_pro',
				'label' => __('Tooltip Youtube Image Size', 'my_text_domain'),
				'placeholder' => '',
				'description' => __('<span class="tpwpt_pro_span">PRO</span>', 'my_text_domain'),
				'custom_attributes' => array('disabled' => 'disabled'),
				'options' => array(
					'default'       => 'default (120x90)',
					'hqdefault'     => 'hqdefault (480x360)',
					'mqdefault'     => 'mqdefault (320x180)',
					'sddefault'     => 'sddefault (640x480)',
					'maxresdefault' => 'maxresdefault (1280x720)'
				),
				'default'           => 'mqdefault'
			) );

			woocommerce_wp_select( array(
				'id' => '_tpt_youtube_icon_size_pro',
				'label' => __('Tooltip Youtube Icon Size', 'my_text_domain'),
				'placeholder' => '',
				'description' => __('<span class="tpwpt_pro_span">PRO</span>', 'my_text_domain'),
				'custom_attributes' => array('disabled' => 'disabled'),
				'options' => array(
					'small'  => 'small',
					'medium' => 'medium',
					'large'  => 'large'
				),
				'default' => 'medium'
			) );

			woocommerce_wp_select( array(
				'id' => '_tpt_tooltip_position_hook',
				'label' => __('Tooltip Position hook', 'my_text_domain'),
				'placeholder' => '',
				'description' => __('<strong>10 more Tooltip Position hooks in PRO Version</strong>', 'my_text_domain'),
				'options' => array(
					'woocommerce_single_product_summary_title' => 'single product summary (after title)',
					'woocommerce_single_product_summary_excerpt' => 'single product summary (after excerpt)',
				)
			) );
			?>
		</div>
		<?php
	}

	public function woocommerce_process_product_meta_fields_save( $post_id ){
		// This is the case to save custom field data of checkbox. You have to do it as per your custom fields
		$_tpt_activate = sanitize_text_field($_POST['_tpt_activate']);
		$_tpt_activate = isset( $_tpt_activate ) ? 'yes' : 'no';
		$_tpt_position = sanitize_text_field($_POST['_tpt_position']);
		$_tpt_position_mobile = sanitize_text_field($_POST['_tpt_position_mobile']);
		$_tpt_title = sanitize_text_field($_POST['_tpt_title']);
		$_tpt_description = sanitize_textarea_field($_POST['_tpt_description']);
		$_tpt_min_width = sanitize_text_field($_POST['_tpt_min_width']);
		$_tpt_height = sanitize_text_field($_POST['_tpt_height']);
		$_tpt_border = sanitize_text_field($_POST['_tpt_border']);
		$_tpt_icon = sanitize_text_field($_POST['_tpt_icon']);
		$_tpt_popup_animation = sanitize_text_field($_POST['_tpt_popup_animation']);
		$_tpt_hover_title = sanitize_text_field($_POST['_tpt_hover_title']);
		$_tpt_tooltip_position_hook = sanitize_text_field($_POST['_tpt_tooltip_position_hook']);
		
		$_tpt_css_background = sanitize_hex_color($_POST['_tpt_css_background']);
		$_tpt_css_color = sanitize_hex_color($_POST['_tpt_css_color']);
		
		update_post_meta( $post_id, '_tpt_activate', $_tpt_activate );

		update_post_meta( $post_id, '_tpt_position', $_tpt_position );

		update_post_meta( $post_id, '_tpt_position_mobile', $_tpt_position_mobile );

		update_post_meta( $post_id, '_tpt_title', $_tpt_title );

		update_post_meta( $post_id, '_tpt_description', $_tpt_description );

		update_post_meta( $post_id, '_tpt_min_width', $_tpt_min_width );

		update_post_meta( $post_id, '_tpt_border', $_tpt_border );

		update_post_meta( $post_id, '_tpt_height', $_tpt_height );
		
		update_post_meta( $post_id, '_tpt_icon', $_tpt_icon );

		update_post_meta( $post_id, '_tpt_popup_animation', $_tpt_popup_animation );

		update_post_meta( $post_id, '_tpt_hover_title', $_tpt_hover_title );

		update_post_meta( $post_id, '_tpt_tooltip_position_hook', $_tpt_tooltip_position_hook );

		update_post_meta( $post_id, '_tpt_css_background', $_tpt_css_background );

		update_post_meta( $post_id, '_tpt_css_color', $_tpt_css_color );
	}

	//-------------------------------------------------------------------------------------------------------

	public function get_animations() {
		$animations = array(
			array(
				'label' => 'Attention Seekers',
				'options' => array(
					0 => 'bounce',
					1 => 'flash',
					2 => 'pulse',
					3 => 'rubberBand',
					4 => 'shake',
					5 => 'swing',
					6 => 'tada',
					7 => 'wobble',
					8 => 'jello',
					9 => 'heartBeat',
				)
			),
			array(
				'label' => 'Bouncing Entrances',
				'options' => array(
					0 => 'bounceIn',
					1 => 'bounceInDown',
					2 => 'bounceInLeft',
					3 => 'bounceInRight',
					4 => 'bounceInUp'
				)
			),
			array(
				'label' => 'Fading Entrances',
				'options' => array(
					0 => 'fadeIn',
					1 => 'fadeInDown',
					2 => 'fadeInDownBig',
					3 => 'fadeInLeft',
					4 => 'fadeInLeftBig',
					5 => 'fadeInRight',
					6 => 'fadeInRightBig',
					7 => 'fadeInUp',
					8 => 'fadeInUpBig'
				)
			),
			array(
				'label' => 'Lightspeed',
				'options' => array(
					0 => 'lightSpeedIn',
					//1 => 'lightSpeedOut'
				)
			),
			array(
				'label' => 'Rotating Entrances',
				'options' => array(
					0 => 'rotateIn',
					1 => 'rotateInDownLeft',
					2 => 'rotateInDownRight',
					3 => 'rotateInUpLeft',
					4 => 'rotateInUpRight'
				)
			),
			array(
				'label' => 'Sliding Entrances',
				'options' => array(
					0 => 'slideInUp',
					1 => 'slideInDown',
					2 => 'slideInLeft',
					3 => 'slideInRight'
				)
			),
			array(
				'label' => 'Zoom Entrances',
				'options' => array(
					0 => 'zoomIn',
					1 => 'zoomInDown',
					2 => 'zoomInLeft',
					3 => 'zoomInRight',
					4 => 'zoomInUp'
				)
			),
			array(
				'label' => 'Specials',
				'options' => array(
					0 => 'hinge',
					1 => 'jackInTheBox',
					2 => 'rollIn'
				)
			)
		);

		return $animations;
	}

	public function get_animations_select($name,$selected) {
		$animations = $this->get_animations();

		$select = '<select name="'.$name.'">';
		foreach ($animations as $animation) {
			$label = $animation['label'];
			$options = $animation['options'];
			$select .= '<optgroup label="'.$label.'">';
				foreach ($options as $option) {
					if($selected == $option){
						$select .= '<option value="'.$option.'" selected>'.$option.'</option>';
					}
					else{
						$select .= '<option value="'.$option.'">'.$option.'</option>';
					}
				}
			$select .= '</optgroup>';

		} //foreach ($animations as $animation)
		$select .= '</select>';

		return $select;
	}

	public function tpwpt_settings_link( $links ) {
		$settings_link = '<a href="admin.php?page=tpwpt_settings">Settings</a>';
		$pro_link = '<a href="'.TPWPT_PLUGIN_HOME.'product/'.TPWPT_PLUGIN_PRO_SLUG.'" class="tpc_get_pro" target="_blank">Go Premium!</a>';
		array_push( $links, $settings_link, $pro_link );
		return $links;
	} //function tpwpg_settings_link( $links )

	public function tpwpt_get_pro_link( $links, $file ) {

		if ( TPWPT_PLUGIN_BASENAME == $file ) {
	
			$row_meta = array(
				'docs' => '<a href="' . esc_url( 'https://www.tplugins.com/demos/product/v-neck-t-shirt/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Live Demo', 'wtppcs' ) . '" class="tpc_live_demo">&#128073; ' . esc_html__( 'Live Demo', 'wtppcs' ) . '</a>'
			);
	
			return array_merge( $links, $row_meta );
		}
		
		return (array) $links;
	} //function tppc_get_pro_link( $links, $file )

}