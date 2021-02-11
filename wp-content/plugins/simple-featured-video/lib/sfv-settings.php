<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly?>
<div class="wrap">
	<h1>Simple Featured Video</h1>
	<?php 
		if(isset($_POST['sfv_posts_submit'])){
		
			if (!isset($_POST['sfv_settings_non'])) { 
				die('<br><br>NO CSRF For you'); 
			}
			if (!wp_verify_nonce($_POST['sfv_settings_non'],'sfv_settings_non_num')) 
			{
			die('<br><br>NO CSRF For you'); 
			}
			// saving value in option variable into option table
			$sfv_post_type=$_POST['sfv_post_type'];
			$sfv_after_contents=$_POST['sfv_after_contents'];
			$sfv_replace_thumbnail=$_POST['sfv_replace_thumbnail'];
			$sfv_after_excerpt=$_POST['sfv_after_excerpt'];
			$sfv_woocommerce_option=$_POST['sfv_woocommerce_option'];
			
			$sfv_post_type_temp = array();
			if(is_array($sfv_post_type)){
				foreach($sfv_post_type as $key => $typevalue){
					$sfv_post_type_temp[] = sanitize_text_field( $typevalue );
				}
				$sfv_post_type = array();
				$sfv_post_type = $sfv_post_type_temp;
			}
			if(!empty($sfv_post_type) && is_array($sfv_post_type)) {  
				$sfv_post_type = implode(",",$sfv_post_type);
			}else $sfv_post_type ='';  // if empty
			$sfv_post_type = sanitize_text_field($sfv_post_type); // sanitize data
			update_option('sfv_posts_types',$sfv_post_type);
			
			// post type options 
			
			//after contents 
			
			$option_name = 'sfv_after_contents' ;
			$new_value = $sfv_after_contents;
			if ( get_option( $option_name ) !== false ) {
				// The option already exists, so update it.
				update_option( $option_name, $new_value );
			} else {
				// The option hasn't been created yet, so add it with $autoload set to 'no'.
				$deprecated = null;
				$autoload = 'no';
				add_option( $option_name, $new_value, $deprecated, $autoload );
			}
			// instead of thumbnail
			$option_name = 'sfv_replace_thumbnail' ;
			$new_value = $sfv_replace_thumbnail;
			if ( get_option( $option_name ) !== false ) {
				// The option already exists, so update it.
				update_option( $option_name, $new_value );
			} else {
				// The option hasn't been created yet, so add it with $autoload set to 'no'.
				$deprecated = null;
				$autoload = 'no';
				add_option( $option_name, $new_value, $deprecated, $autoload );
			}
			
			// after excerpt
			
			$option_name = 'sfv_after_excerpt' ;
			$new_value = $sfv_after_excerpt;
			if ( get_option( $option_name ) !== false ) {
				// The option already exists, so update it.
				update_option( $option_name, $new_value );
			} else {
				// The option hasn't been created yet, so add it with $autoload set to 'no'.
				$deprecated = null;
				$autoload = 'no';
				add_option( $option_name, $new_value, $deprecated, $autoload );
			}
			
			// woocommerce product page
			
			
			$option_name = 'sfv_woocommerce_option' ;
			$new_value = $sfv_woocommerce_option;
			if ( get_option( $option_name ) !== false ) {
				// The option already exists, so update it.
				update_option( $option_name, $new_value );
			} else {
				// The option hasn't been created yet, so add it with $autoload set to 'no'.
				$deprecated = null;
				$autoload = 'no';
				add_option( $option_name, $new_value, $deprecated, $autoload );
			}
			
			// Success message	
			echo sprintf(__( '<div id="setting-error-page_for_privacy_policy" class="updated settings-error notice is-dismissible">  
			<p><strong>Posts updated successfully.</strong></p>
			<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
			</div>' ));
		}
	?>
	<h2>Select post type in which Featured Video should be enabled:</h2>
	<?php 
		// Getting all public post type in wordpress
		$args       = array(
		'public' => true,
		);
		$post_types = get_post_types( $args, 'objects' );
		$selected =array();
		
		// Selected posts variables
		if(get_option('sfv_posts_types')){
			$selected = get_option('sfv_posts_types');
			$selected = explode(",",$selected);
		}


	?>
	<form action="" name="sfv_posts_form" method="post">
		<div>
			<?php foreach ( $post_types as $post_type_obj ):
				// Exclude Media type
				if( $post_type_obj->name == "attachment"){
					continue;
				}
				$labels = get_post_type_labels( $post_type_obj );
			?>
			<p>
				<input type="checkbox" id="<?php echo esc_attr( $post_type_obj->name ); ?>" value="<?php echo esc_attr( $post_type_obj->name ); ?>" name="sfv_post_type[]" <?php if(in_array($post_type_obj->name,$selected)) echo "checked"; ?>>
				<label for="<?php echo esc_attr( $post_type_obj->name ); ?>"><?php echo esc_html( $labels->name ); ?></label>
			</p>
			<input name="sfv_settings_non" type="hidden" value="<?php echo wp_create_nonce('sfv_settings_non_num'); ?>" />
			
			<?php endforeach; ?>
		</div> 
	<h1>General Settings</h1>
	<h3>If you dont want to use shortcodes, we will display it automatically after contents</h3>
	<p>
	
	<?php $sfv_after_contents = get_option('sfv_after_contents'); ?>
		<input type="checkbox" id="sfv_after_contents" value="true" name="sfv_after_contents" <?php if($sfv_after_contents == "true") echo "checked"; ?>>
		<label for="sfv_after_contents">Automatically display after posts contents? </label>
	</p>
	<p>
	
	<?php $sfv_replace_thumbnail = get_option('sfv_replace_thumbnail'); ?>
		<input type="checkbox" id="sfv_replace_thumbnail" value="true" name="sfv_replace_thumbnail" <?php if($sfv_replace_thumbnail == "true") echo "checked"; ?>>
		<label for="sfv_replace_thumbnail">Automatically display video instaed of posts thumbnail? </label>
	</p>
	<p>
	
	<?php $sfv_after_excerpt = get_option('sfv_after_excerpt'); ?>
		<input type="checkbox" id="sfv_after_excerpt" value="true" name="sfv_after_excerpt" <?php if($sfv_after_excerpt == "true") echo "checked"; ?>>
		<label for="sfv_after_excerpt">Automatically display after posts excerpt? </label>
	</p>
	
	<h3>If you are using woocommerce, show video below</h3>
	<p>
	
	<?php $sfv_woocommerce_option = get_option('sfv_woocommerce_option'); ?>
		<input type="radio" id="short_description" value="short_description" name="sfv_woocommerce_option" <?php if($sfv_woocommerce_option == "short_description") echo "checked"; ?>>
		<label for="short_description">Short Description</label>
	</p>
	<p>
	
		<input type="radio" id="in_main_description" value="in_main_description" name="sfv_woocommerce_option" <?php if($sfv_woocommerce_option == "in_main_description") echo "checked"; ?>  >
		<label for="in_main_description">In main Description </label>
	</p>
	<p>
		<input type="radio" id="before_image_gallery" value="before_image_gallery" name="sfv_woocommerce_option" <?php if($sfv_woocommerce_option == "before_image_gallery") echo "checked"; ?>  >
		<label for="before_image_gallery">Before Image Gallery</label>
	</p>
	<p>
		<input type="radio" id="after_add_to_cart_button" value="after_add_to_cart_button" name="sfv_woocommerce_option" <?php if($sfv_woocommerce_option == "after_add_to_cart_button") echo "checked"; ?>  >
		<label for="after_add_to_cart_button">After Add To Cart Button</label>
	</p>
	<p>
		<input type="radio" id="after_summery" value="after_summery" name="sfv_woocommerce_option" <?php if($sfv_woocommerce_option == "after_summery") echo "checked"; ?>  >
		<label for="after_summery">After Summery Section</label>
	</p>
	<p>
		<input type="radio" id="none" value="none" name="sfv_woocommerce_option" <?php if($sfv_woocommerce_option == "none") echo "checked"; ?>  >
		<label for="none">No need to display automatically</label>
	</p>
	
		<?php echo sprintf(__( '<p class="submit"><input type="submit" name="sfv_posts_submit" id="sfv_posts_submit" class="button button-primary" value="Save Changes"></p>')); ?>
	</form>
</div> 