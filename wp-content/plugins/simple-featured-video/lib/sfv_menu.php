<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/* Plugin Menu Creation Starts Here */
	add_action('admin_menu', 'sfv_menus');
	
	// Menu creation under General Settings with name "Simple Featured Video"
	function sfv_menus(){
			add_submenu_page('options-general.php','Simple Featured Video', 'Simple Featured Video', 'administrator', 'sfv_menu_page','sfv_menu_page_function');
	}
	// Menu page code loading
	function sfv_menu_page_function(){
		include( SFV_DIR . '/lib/sfv-settings.php');
	}
/* Plugin Menu Creation Ends Here */