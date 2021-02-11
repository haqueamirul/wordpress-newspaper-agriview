<?php
/**
 * Plugin Name: Simple Featured Video
 * Plugin URI:  https://www.primisdigital.com/
 * Description: Featured Video uploading for wordpress posts,pages, woocommerce products,  and custom post type
 * Version:     1.3
 * Author:      Primis Digital
 * Author URI:  https://www.primisdigital.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: 
 * Domain Path: 
 */


// Language Directory
load_plugin_textdomain('simple-featured-video', false, dirname(plugin_basename(__FILE__)) . '/languages/');
// Some constant defintion
define("SFV_DIR", plugin_dir_path(__FILE__), FALSE);
define("SFV_DIR_URL", plugin_dir_url(__FILE__), FALSE);
//Plugin Activation code
register_activation_hook(__FILE__, 'sfv_activation');
function sfv_activation()
{
   
	
    // Setting option for posts types , that used featured video
	if(get_option('sfv_posts_types')){
	}
    else {
		$sfv_post_type ='post';
		$sfv_post_type = sanitize_text_field($sfv_post_type); // sanitize data
		add_option('sfv_posts_types', $sfv_post_type);
    }
}
// Loading Admin scripts here
add_action('admin_enqueue_scripts', function()
{
	if (is_admin()) {
		wp_enqueue_media();
	}
	// Loading our js script here
	wp_enqueue_script('my_custom_script', plugin_dir_url(__FILE__) . 'assets/js/myscript.js');
});
// Register Deactivation Hook here
register_deactivation_hook(__FILE__, 'sfv_deactivation');
function sfv_deactivation()
{
    
}

// Register Uninstall Hook here
register_uninstall_hook(__FILE__, 'sfv_uninstall');

function sfv_uninstall()
{
    
}

// Plugin Menu Creation Simple Featured Video
include("lib/sfv_menu.php");

// Adding meta box for featured video
add_action('add_meta_boxes', 'sfv_featured_video');
function sfv_featured_video()
{
   if (get_option('sfv_posts_types')) {
        $posts_available = get_option('sfv_posts_types');
		if(!empty($posts_available)){
        $posts_available = explode(",", $posts_available);
		}
    }
	if(!empty($posts_available)){
    add_meta_box('featuredvideo', __('Featured Video', 'text-domain'), 'sfv_upload', $posts_available, 'side', 'low'); // sfv_upload function 
	}
}

//sfv_upload function defintion
function sfv_upload($post)
{
	wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );
	$meta_key = 'featured_video_uploading';
	// get the meta value of video attachment
	$meta_ket = get_post_meta($post->ID, $meta_key, true);
    echo sfv_uploader($meta_key, $meta_ket); 
	// getting current post id, and calling function of video uploading "sfv_uploader" with attachment id of video
}

// sfv_uploader  function defintion, for video uploading
function sfv_uploader($name, $value = '')
{
	global $post;
	$image = ' button">Upload Video';
	$display = 'none'; 
	// Attachment id of video is $value
	if( $media = wp_get_attachment_url($value)) {  // getting video here
		$video = $media;
		$image = '"><video controls="" src="'.$video.'" style="max-width:95%;display:block;"></video>';
		$display = 'inline-block';
	}
    return '
    <div><a href="#" class="upload_video_button' . $image . '</a>
    <input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
    <a href="#" class="remove_image" style="display:inline-block;display:' . $display . '">Remove Video</a>
    </div>';
}

// Saving post by updating , "featured_video_uploading" meta key
add_action('save_post', 'sfv_save', 10, 1);
function sfv_save($post_id)
{
    if( !current_user_can( 'edit_post' ) ) return;
	
	 // Check if our nonce is set.
        if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) ) {
            return $post_id;
        }
 
        $nonce = $_POST['myplugin_inner_custom_box_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) ) {
            return $post_id;
        }
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
	
	
    $meta_key = 'featured_video_uploading';
	$keyvalue = sanitize_text_field($_POST[$meta_key]);
    update_post_meta($post_id, $meta_key,$keyvalue );
    return $post_id;
}
// Shortcode to display the video on pages, or posts
add_shortcode('sfv_video_show',"sfv_display_fun");
function sfv_display_fun(){
	global $post;
	$type = $post->post_type; // current post type
	$postid = $post->ID;
	$meta_key = 'featured_video_uploading';
	$meta_ket = get_post_meta($postid, $meta_key, true);
	$posts_available = get_option('sfv_posts_types');
	if(!empty($posts_available)){
	$posts_available = explode(",", $posts_available);
	if(in_array($type,$posts_available)){
		if( $media = wp_get_attachment_url($meta_ket)) {  // getting video here
		return __('<video class="sfv_videos" id="sfv_video_'.$postid.'" controls="" src="'.$media.'" style="max-width:100%;display:block;"></video>'); 
		}
	}
	}
	
	
	
}

// shortcode to display using post id
add_shortcode('sfv_show_by_postid',"sfv_show_by_fun");
function sfv_show_by_fun($atts){
	global $post;
	$postid = $atts['postid'];
	$meta_key = 'featured_video_uploading';
	$meta_ket = get_post_meta($postid, $meta_key, true);
	$type = $post->post_type; // current post type
	$posts_available = get_option('sfv_posts_types');
	if(!empty($posts_available)){
	$posts_available = explode(",", $posts_available);
	if(in_array($type,$posts_available)){
	if( $media = wp_get_attachment_url($meta_ket)) {  // getting video here
		return __('<video class="sfv_videos" id="sfv_video_'.$postid.'" controls="" src="'.$media.'" style="max-width:100%%;display:block;"></video>');
	}
	}
	}
}

// automatically add after post contents
$sfv_after_contents = get_option('sfv_after_contents');
if($sfv_after_contents == "true"){
  add_filter( 'the_content', 'sfv_after_contents_fun' );
}
function sfv_after_contents_fun( $content ) { 
global $post;
if($post->post_type != "product"){
if(is_single() || is_page() ) {
	$content .= '<div class="video_class">'.do_shortcode('[sfv_video_show]').'</div>';
}
}
return $content;
}
// automatically add after post excerpt

$sfv_after_excerpt = get_option('sfv_after_excerpt');
if($sfv_after_excerpt == "true"){
	add_filter( 'the_excerpt', 'sfv_after_excerpt_fun' );
}
function sfv_after_excerpt_fun( $content ) {  
	global $post;
	if($post->post_type != "product"){
	if(is_single() || is_page()  ) {
		$content .= '<div class="video_class">'.do_shortcode('[sfv_video_show]').'</div>';
		
	}
	}
	return $content;
}
//woocommerce part
if ( get_option( 'sfv_woocommerce_option' )) {
$hook = '';
$sfv_woocommerce_option = get_option('sfv_woocommerce_option');

if($sfv_woocommerce_option == "short_description"){
	$hook = "woocommerce_before_add_to_cart_form";
}else if($sfv_woocommerce_option == "before_image_gallery"){
	$hook = "woocommerce_before_single_product_summary";
}else if($sfv_woocommerce_option == "after_add_to_cart_button"){
	$hook = "woocommerce_after_add_to_cart_button";
}else if($sfv_woocommerce_option == "after_summery"){
	$hook = "woocommerce_after_single_product_summary";
}
 if($sfv_woocommerce_option == "in_main_description"){
	add_action("the_content","sfv_main_desc_for_pdt");
}
function sfv_main_desc_for_pdt($content){
	
	$sfv_vid_woo ='';
	$sfv_after_contents = get_option('sfv_after_contents');
	global $post;
	if($post->post_type == "product"){
	$sfv_vid_woo .='<div class="woocommerce-product-video" style="margin:10px auto;">';
	$sfv_vid_woo .= '<div style="clear:both">'.do_shortcode('[sfv_video_show]').'</div>';
	$sfv_vid_woo .= "</div>";
	}
	return $content.$sfv_vid_woo;
}
$all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
if (stripos(implode($all_plugins), 'woocommerce.php')) {
	if($hook !=''){
	add_action( $hook, 'add_text_after_excerpt_single_product',9);
	}
}
function add_text_after_excerpt_single_product(){
    global $product;
	echo '<div class="woocommerce-product-video" style="margin:10px auto;">';
	echo '<div style="clear:both">'.do_shortcode('[sfv_video_show]').'</div>';
	echo "</div>";
}

}

// add instead of post thumbnail
$sfv_replace_thumbnail = get_option('sfv_replace_thumbnail');
if($sfv_replace_thumbnail == "true"){
add_filter('post_thumbnail_html', 'filter_post_thumbnail_html', 10, 5 );
}
// define the post_thumbnail_html callback 
function filter_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) { 
	$meta_key = 'featured_video_uploading';
	$meta_ket = get_post_meta($post_id, $meta_key, true);
	if($meta_ket){
	$sfv_vid_woo = '<div style="clear:both">'.do_shortcode("[sfv_video_show]").'</div>';
	return $sfv_vid_woo;
	}
	return $html;
};