<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.tplugins.com/
 * @since      1.0.0
 *
 * @package    Tp_Woocommerce_Product_Tooltip
 * @subpackage Tp_Woocommerce_Product_Tooltip/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tp_Woocommerce_Product_Tooltip
 * @subpackage Tp_Woocommerce_Product_Tooltip/public
 * @author     tplugins <pluginstp@gmail.com>
 */
class Tp_Woocommerce_Product_Tooltip_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tp-woocommerce-product-tooltip-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-tp_animate', plugin_dir_url( __FILE__ ) . 'css/tp_animate.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-lity', plugin_dir_url( __FILE__ ) . 'css/lity.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tp-woocommerce-product-tooltip-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-lity', plugin_dir_url( __FILE__ ) . 'js/lity.min.js', array( 'jquery' ), $this->version, false );

	}

	public function display_tooltip() {
		global $post;
		//wp_dbug($post);
		$_tpt_activate = get_post_meta($post->ID,'_tpt_activate',true);
		//$_tpt_activate_in_category = get_post_meta($post->ID,'_tpt_activate_in_category',true);
		$_tpt_popup_animation = get_post_meta($post->ID,'_tpt_popup_animation',true);		
		$_tpt_position = get_post_meta($post->ID,'_tpt_position',true);
		$_tpt_position_mobile = get_post_meta($post->ID,'_tpt_position_mobile',true);
		$_tpt_hover_title = get_post_meta($post->ID,'_tpt_hover_title',true);
		$_tpt_title = get_post_meta($post->ID,'_tpt_title',true);
		$_tpt_description = get_post_meta($post->ID,'_tpt_description',true);
		$_tpt_icon = get_post_meta($post->ID,'_tpt_icon',true);

		$_tpt_youtube = get_post_meta($post->ID,'_tpt_youtube',true);
		$_tpt_youtube_image = get_post_meta($post->ID,'_tpt_youtube_image',true);
		$_tpt_youtube_icon_size = get_post_meta($post->ID,'_tpt_youtube_icon_size',true);
		$_tpt_youtube_icon_color = get_post_meta($post->ID,'_tpt_youtube_icon_color',true);
		$_tpt_height = get_post_meta($post->ID,'_tpt_height',true);
		$_tpt_border = get_post_meta($post->ID,'_tpt_border',true);

		$_tpt_description = str_replace("[pname]",$post->post_title,$_tpt_description);
		$_tpt_description = str_replace("[pexcerpt]",$post->post_excerpt,$_tpt_description);
		$_tpt_description = str_replace("[pcontent]",$post->post_content,$_tpt_description);

		$_tpt_product_category_tooltip_background = get_option('_tpt_product_category_tooltip_background');
		$_tpt_product_category_tooltip_color = get_option('_tpt_product_category_tooltip_color');
		$_tpt_product_category_tooltip_popup_animation = get_option('_tpt_product_category_tooltip_popup_animation');
		$_tpt_product_category_tooltip_border = get_option('_tpt_product_category_tooltip_border');
		$_tpt_product_category_tooltip_position = get_option('_tpt_product_category_tooltip_position');
		$_tpt_product_category_tooltip_position_mobile = get_option('_tpt_product_category_tooltip_position_mobile');
		$_tpt_product_category_tooltip_title_position = get_option('_tpt_product_category_tooltip_title_position');
		$_tpt_product_category_tooltip_text_align = get_option('_tpt_product_category_tooltip_text_align');

		if(is_category() || is_archive()){
			$_tpt_productPosition = $_tpt_product_category_tooltip_position;
			$_tpt_productPositionMobile = $_tpt_product_category_tooltip_position_mobile;
			$_tpt_productPositionTitle = 'categoryyes_'.$_tpt_product_category_tooltip_title_position;
			$_tpt_productPositionTextAlign = $_tpt_product_category_tooltip_text_align;
		}else{
			$_tpt_productPosition = $_tpt_position;
			$_tpt_productPositionMobile = $_tpt_position_mobile;
			$_tpt_productPositionTitle = '';
			$_tpt_productPositionTextAlign = '';
		}


		if($_tpt_height){
			$_tpt_height_start_class = '<div class="_tpt_scrollbar"><div class="_tpt_overflow">';
			$_tpt_height_end_class = '</div></div>';
		}else{
			$_tpt_height_start_class = '';
			$_tpt_height_end_class = '';
		}
		if($_tpt_border || $_tpt_product_category_tooltip_border){
			$tptt_border = ' tptt_border';
		}else{
			$tptt_border = '';
		}

		if($_tpt_youtube){
			$youtube_code = $this->getYoutubeIdFromUrl($_tpt_youtube);
			//$replace = '<iframe class="youtube-video" width="100%" height="100%" src="https://www.youtube.com/embed/'.$youtube_code.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
			$replace = '<a class="tp_youtube" href="http://www.youtube.com/watch?v='.$youtube_code.'&amp;autoplay=1" data-tp_lity_tooltip=""><span class="tp_play_'.$_tpt_youtube_icon_size.'"></span><img src="http://i.ytimg.com/vi/'.$youtube_code.'/'.$_tpt_youtube_image.'.jpg" alt=""></a>';
			$description = str_replace("[youtube]",$replace,$_tpt_description);
		}
		else{
			$description = $_tpt_description;
		}

		$icon = '<span class="'.$_tpt_icon.'"></span>';

		if(is_rtl()){
			$icon_txt = $_tpt_hover_title.' '.$icon;
		}else{
			$icon_txt = $icon.' '.$_tpt_hover_title;
		}
		if($_tpt_activate == 'yes'){
			if(wp_is_mobile()){	
				$_tpt_position_type = $_tpt_productPositionMobile; 
			}else{
				$_tpt_position_type = $_tpt_productPosition; 
			}

			$tooltip = '<div id="tpwpttooltip-'.$post->ID.'" class="tpwpttooltip '.$_tpt_productPositionTitle.'">
							<span class="tp_icon_txt'.$tptt_border.'">'.$icon_txt.'</span>
							<div id="tpwpttooltip_popup">
								<div class="tpwpttooltip_style tpwpttooltip_'.$_tpt_position_type.'">
									'.$_tpt_height_start_class.'
											<span class="tptt_title">'.$_tpt_title.'</span>
											<span class="tptt_description">'.$description.'</span>
											<i></i>
									'.$_tpt_height_end_class.'
								</div>
							</div>
						</div>';

			echo $tooltip;
			
			echo $this->custom_tooltip_style($post->ID);
			echo $this->custom_tooltip_script($post->ID);
		}

	}

	public function custom_tooltip_script($postID) {
		$_tpt_popup_animation = get_post_meta($postID,'_tpt_popup_animation',true);	
		$_tpt_position = get_post_meta($postID,'_tpt_position',true);
		$_tpt_position_mobile = get_post_meta($postID,'_tpt_position_mobile',true);

		$_tpt_product_category_tooltip_popup_animation = get_option('_tpt_product_category_tooltip_popup_animation');
		$_tpt_product_category_tooltip_position = get_option('_tpt_product_category_tooltip_position');
		$_tpt_product_category_tooltip_position_mobile = get_option('_tpt_product_category_tooltip_position_mobile');
		if(is_category() || is_archive()){
			$_tpt_productAnimation = $_tpt_product_category_tooltip_popup_animation;
			$_tpt_productPosition = $_tpt_product_category_tooltip_position;
			$_tpt_productPositionMobile = $_tpt_product_category_tooltip_position_mobile;
		}else{
			$_tpt_productAnimation = $_tpt_popup_animation;
			$_tpt_productPosition = $_tpt_position;
			$_tpt_productPositionMobile = $_tpt_position_mobile;
		}

		if(wp_is_mobile()){
			$_tpt_position_type = $_tpt_productPositionMobile; 
		}else{
			$_tpt_position_type = $_tpt_productPosition; 
		}
		//wp_dbug($_tpt_position_type);

		?>
		<script>
			jQuery( document ).ready(function() {
				jQuery('#tpwpttooltip-<?php echo $postID; ?>.tpwpttooltip').hover(
					function(){ jQuery('#tpwpttooltip-<?php echo $postID; ?> #tpwpttooltip_popup').addClass('tpwpttooltip_animated tptt_<?php echo $_tpt_position_type; ?> tpwpttooltip_<?php echo $_tpt_productAnimation; ?>') },
					function(){ jQuery('#tpwpttooltip-<?php echo $postID; ?> #tpwpttooltip_popup').removeClass('tpwpttooltip_animated tptt_<?php echo $_tpt_position_type; ?> tpwpttooltip_<?php echo $_tpt_productAnimation; ?>') }
				)
			});
		</script>
		<?php
	}

	public function custom_tooltip_style($postID) {
		//global $post;
		$_tpt_activate = get_post_meta($postID,'_tpt_activate',true);
		$_tpt_popup_animation = get_post_meta($postID,'_tpt_popup_animation',true);		
		$_tpt_position = get_post_meta($postID,'_tpt_position',true);
		$_tpt_position_mobile = get_post_meta($postID,'_tpt_position_mobile',true);
		$_tpt_min_width = get_post_meta($postID,'_tpt_min_width',true);
		$_tpt_height = get_post_meta($postID,'_tpt_height',true);
		$_tpt_border = get_post_meta($postID,'_tpt_border',true);
		$_tpt_css_background = get_post_meta($postID,'_tpt_css_background',true);
		$_tpt_css_color = get_post_meta($postID,'_tpt_css_color',true);
		$_tpt_youtube_icon_size = get_post_meta($postID,'_tpt_youtube_icon_size',true);
		$_tpt_youtube_icon_color = get_post_meta($postID,'_tpt_youtube_icon_color',true);

		$_tpt_product_category_tooltip_background = get_option('_tpt_product_category_tooltip_background');
		$_tpt_product_category_tooltip_color = get_option('_tpt_product_category_tooltip_color');
		$_tpt_product_category_tooltip_popup_animation = get_option('_tpt_product_category_tooltip_popup_animation');
		$_tpt_product_category_tooltip_border = get_option('_tpt_product_category_tooltip_border');
		$_tpt_product_category_tooltip_position = get_option('_tpt_product_category_tooltip_position');
		$_tpt_product_category_tooltip_position_mobile = get_option('_tpt_product_category_tooltip_position_mobile');
		$_tpt_product_category_tooltip_title_position = get_option('_tpt_product_category_tooltip_title_position');
		$_tpt_product_category_tooltip_width = get_option('_tpt_product_category_tooltip_width');
		$_tpt_product_category_tooltip_text_align = get_option('_tpt_product_category_tooltip_text_align');

		if(is_rtl()){
			$_tpt_position_dir = 'right';
		}else{
			$_tpt_position_dir = 'left';
		}

		$_tpt_css_color = ($_tpt_css_color) ? $_tpt_css_color : '#fff';
		$_tpt_product_category_tooltip_color = ($_tpt_product_category_tooltip_color) ? $_tpt_product_category_tooltip_color : '#fff';
		$_tpt_css_background = ($_tpt_css_background) ? $_tpt_css_background : '#3e3e3e';
		$_tpt_min_width = ($_tpt_min_width) ? $_tpt_min_width : '200';
		$_tpt_product_category_tooltip_width = ($_tpt_product_category_tooltip_width) ? $_tpt_product_category_tooltip_width : '200';
		$_tpt_height = ($_tpt_height) ? $_tpt_height : 'auto';
		if(is_rtl() && $_tpt_height){
			$tpwpttooltip_style_padding = 'padding: 15px 15px 15px 10px;';
		}else{
			$tpwpttooltip_style_padding = 'padding: 15px 10px 15px 15px;';
		}
		if(is_rtl()){
			$tptt_wcicon = 'margin: 0 0 0 5px;';
			$tptt_float = 'float: right;';
		}else{
			$tptt_wcicon = 'margin: 0 5px 0 0;';
			$tptt_float = 'float: left;';
		}
		if(is_category() || is_archive()){
			$_tpt_productBG = $_tpt_product_category_tooltip_background;
			$_tpt_productAnimation = $_tpt_product_category_tooltip_popup_animation;
			$_tpt_productBorder = $_tpt_product_category_tooltip_border;
			$_tpt_productPosition = $_tpt_product_category_tooltip_position;
			$_tpt_productPositionMobile = $_tpt_product_category_tooltip_position_mobile;
			$_tpt_productPositionTitle = 'categoryyes_'.$_tpt_product_category_tooltip_title_position;
			$_tpt_productPositionWidth = $_tpt_product_category_tooltip_width;
			$_tpt_productColor = $_tpt_product_category_tooltip_color;
			$_tpt_productPositionTextAlign = 'text-align:'.$_tpt_product_category_tooltip_text_align.';';
		}else{
			$_tpt_productBG = $_tpt_css_background;
			$_tpt_productAnimation = $_tpt_popup_animation;
			$_tpt_productBorder = $_tpt_border;
			$_tpt_productPosition = $_tpt_position;
			$_tpt_productPositionMobile = $_tpt_position_mobile;
			$_tpt_productPositionTitle = '';
			$_tpt_productPositionWidth = $_tpt_min_width;
			$_tpt_productColor = $_tpt_css_color;
			$_tpt_productPositionTextAlign = '';
		}

		if(wp_is_mobile()){
			$_tpt_position_type = $_tpt_productPositionMobile; 
			$tpwpttooltip_width = '100%';
		}else{
			$_tpt_position_type = $_tpt_productPosition; 
			$tpwpttooltip_width = $_tpt_productPositionWidth.'px';
		}

		?>
		<style>
			<?php if(is_archive()): ?>
				#tpwpttooltip-<?php echo $postID; ?>.tpwpttooltip {
					position: absolute !important;
				}
				li.product.post-<?php echo $postID; ?> {
					overflow: visible !important;
				}
				#tpwpttooltip-<?php echo $postID; ?>.tpwpttooltip.categoryyes_right{
					right:15px;
					left:auto;
				}
				<?php if(wp_is_mobile()): ?>
					#tpwpttooltip-<?php echo $postID; ?>.tpwpttooltip.categoryyes_right .tpwpttooltip_bottom i::after, #tpwpttooltip-25 .tpwpttooltip_top i::after {
						right: 25px;
						left: auto;
					}
				<?php endif; ?>

				#tpwpttooltip-<?php echo $postID; ?>.tpwpttooltip.categoryyes_right .tp_icon_txt {
					float: right;
				}
				#tpwpttooltip-<?php echo $postID; ?>.tpwpttooltip.categoryyes_left{
					left:15px;
					right:auto;
				}
				#tpwpttooltip-<?php echo $postID; ?>.tpwpttooltip.categoryyes_left .tp_icon_txt {
					float: left;
				}
				#tpwpttooltip-<?php echo $postID; ?> .tpwpttooltip_style {
					<?php echo $_tpt_productPositionTextAlign; ?>
				}

			<?php endif; ?>
			#tpwpttooltip-<?php echo $postID; ?> .tpwpttooltip_bottom i::after,
			#tpwpttooltip-<?php echo $postID; ?> .tpwpttooltip_top i::after{
				<?php echo $_tpt_position_dir; ?>: 25px;
			}

			#tpwpttooltip-<?php echo $postID; ?> [class^="wcicon-"], #tpwpttooltip-<?php echo $postID; ?> [class*=" wcicon-"]{
				<?php echo $tptt_wcicon; ?>
			}
			#tpwpttooltip-<?php echo $postID; ?> .tp_icon_txt{
				<?php echo $tptt_float; ?>
			}
			#tpwpttooltip-<?php echo $postID; ?> .tptt_border {
				padding: 0px 10px;
				border: 1px <?php echo $_tpt_productBorder; ?>;
				margin: 15px 0;
			}
			#tpwpttooltip-<?php echo $postID; ?> .tpwpttooltip_style {
				width:<?php echo $tpwpttooltip_width; ?>;
				background-color:<?php echo $_tpt_productBG; ?>;
				color:<?php echo $_tpt_productColor; ?>;
				<?php echo $tpwpttooltip_style_padding; ?>
			}
			#tpwpttooltip-<?php echo $postID; ?> .tpwpttooltip_style i::after{
				background-color:<?php echo $_tpt_productBG; ?>;
			}
			#tpwpttooltip-<?php echo $postID; ?> .tpwpttooltip_style .tptt_title{
				color:<?php echo $_tpt_productColor; ?>;
				margin: 0;
				padding: 0 0 10px;
				line-height: 20px;
				font-size: 18px;
				font-weight: bold;
				width: 100%;
			    display: table;
			}
			#tpwpttooltip-<?php echo $postID; ?> .tpwpttooltip_style .tptt_description{
				color:<?php echo $_tpt_productColor; ?>;
				margin: 0;
				padding: 0 0 10px;
				line-height: 20px;
				font-size: 13px;
				width:100%;
			}
			
			#tp_youtube-<?php echo $postID; ?> .tp_play_<?php echo $_tpt_youtube_icon_size; ?>{
				background:<?php echo $_tpt_youtube_icon_color; ?>;
			}
			<?php if($_tpt_height): ?>
				#tpwpttooltip-<?php echo $postID; ?> ._tpt_scrollbar::-webkit-scrollbar {
					background:<?php echo $_tpt_productColor; ?>;
					width:13px
				}
				#tpwpttooltip-<?php echo $postID; ?> ._tpt_scrollbar::-webkit-scrollbar-track {
					background:<?php echo $_tpt_productBG; ?>;
				}

				#tpwpttooltip-<?php echo $postID; ?> ._tpt_scrollbar::-webkit-scrollbar-thumb {
					background:<?php echo $_tpt_productColor; ?>;
					border-radius:10px;
					border:5px solid <?php echo $_tpt_productBG; ?>;
				}
				#tpwpttooltip-<?php echo $postID; ?> ._tpt_scrollbar {
					height: <?php echo $_tpt_height; ?>px;
				}
			<?php endif; ?>

		</style>
		<?php

	}

	public function tooltip_hooks() {
		global $post;
		//wp_dbug($post);
		$_tpt_tooltip_position_hook = get_post_meta($post->ID,'_tpt_tooltip_position_hook',true);

		if($_tpt_tooltip_position_hook == 'woocommerce_before_main_content'){
			// Before content
			add_action( 'woocommerce_before_main_content', array($this,'display_tooltip'), 20, 0 );
		}
		elseif($_tpt_tooltip_position_hook == 'woocommerce_before_single_product'){
			// Before content
			add_action( 'woocommerce_before_single_product', array($this,'display_tooltip'), 10 );
		}
		elseif($_tpt_tooltip_position_hook == 'woocommerce_before_single_product_summary'){
			// Left column
			add_action( 'woocommerce_before_single_product_summary', array($this,'display_tooltip'), 10 );
			//add_action( 'woocommerce_before_single_product_summary', array($this,'display_tooltip'), 20 );
			//add_action( 'woocommerce_product_thumbnails', array($this,'display_tooltip'), 20 );
		}
		elseif($_tpt_tooltip_position_hook == 'woocommerce_single_product_summary_title'){
			// Right column
			add_action( 'woocommerce_single_product_summary', array($this,'display_tooltip'), 5 );
			// add_action( 'woocommerce_review_before', array($this,'display_tooltip'), 10 );
			// add_action( 'woocommerce_review_before_comment_meta', array($this,'display_tooltip'), 10 );
			// add_action( 'woocommerce_review_meta', array($this,'display_tooltip'), 10 );
		}
		elseif($_tpt_tooltip_position_hook == 'woocommerce_single_product_summary_rating'){
			// Right column
			add_action( 'woocommerce_single_product_summary', array($this,'display_tooltip'), 10 );
		}
		elseif($_tpt_tooltip_position_hook == 'woocommerce_single_product_summary_excerpt'){
			// Right column
			add_action( 'woocommerce_single_product_summary', array($this,'display_tooltip'), 20 );
		}

		elseif($_tpt_tooltip_position_hook == 'woocommerce_single_product_summary_add_to_cart'){
			// Right column - add to cart
			add_action( 'woocommerce_single_product_summary', array($this,'display_tooltip'), 30 );
			//add_action( 'woocommerce_simple_add_to_cart', array($this,'display_tooltip'), 30 );
			// add_action( 'woocommerce_grouped_add_to_cart', array($this,'display_tooltip'), 30 );
			//add_action( 'woocommerce_variable_add_to_cart', array($this,'display_tooltip'), 30 );
			// add_action( 'woocommerce_external_add_to_cart', array($this,'display_tooltip'), 30 );
			//add_action( 'woocommerce_single_variation', array($this,'display_tooltip'), 10 );
			//add_action( 'woocommerce_single_variation', array($this,'display_tooltip'), 20 );
		}
		elseif($_tpt_tooltip_position_hook == 'woocommerce_single_product_summary_meta'){
			// Right column - meta
			add_action( 'woocommerce_single_product_summary', array($this,'display_tooltip'), 40 );
		}
		elseif($_tpt_tooltip_position_hook == 'woocommerce_after_single_product_summary'){
			// Tabs, upsells and related products
			add_action( 'woocommerce_after_single_product_summary', array($this,'display_tooltip'), 10 );
		}
		elseif($_tpt_tooltip_position_hook == 'woocommerce_after_single_product_summary_after_related_products'){
			// Tabs, upsells and related products
			add_action( 'woocommerce_after_single_product_summary', array($this,'display_tooltip'), 20 );
		}
		else{
			add_action( 'woocommerce_before_single_product_summary', array($this,'display_tooltip'), 10 );
		} //else
	}

	/**
	 * Get Youtube video ID from URL
	 *
	 * @param string $url
	 * @return mixed Youtube video ID or FALSE if not found
	 */
	public function getYoutubeIdFromUrl($url) {
		$parts = parse_url($url);
		if(isset($parts['query'])){
			parse_str($parts['query'], $qs);
			if(isset($qs['v'])){
				return $qs['v'];
			}else if(isset($qs['vi'])){
				return $qs['vi'];
			}
		}
		if(isset($parts['path'])){
			$path = explode('/', trim($parts['path'], '/'));
			return $path[count($path)-1];
		}
		return false;
	} //public function getYoutubeIdFromUrl($url)

}
