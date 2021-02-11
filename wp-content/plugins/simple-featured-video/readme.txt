=== Simple Featured Video ===
Contributors: primisdigital,vinshakp
Plugin Name: Simple Featured Video
Plugin URI: https://www.primisdigital.com/wordpress-plugins/
version :1.3
Author: Prims digital
Tags:featured,video,videos,featured video,woocommerce video,product-video,video embed,video plugin,video post,posts featured video
Requires at least: any version
Tested up to: 5.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple Featured Video plugin helps to upload videos from wordpress posts, page, WooCommerce products and other custom post type.

== Description ==

The Simple Featured Video Plugin is nothing but a featured video uploading plugin for wordpress. Its a  user-friendly WordPress plugin which provides a simple interface to showcase your videos in Page, Post, and custom post type.

If you want to use your own videos in your WordPress website, then you can easily use this Plugin.

Upload Video section will be displayed below the featured image, The plugin will create a meta box there, just like featured image upload.

The plugin has a setting section that will display on the setting menu, here You can choose the Page, Post and Post Type in which you want to upload the featured video.

By Default  "Simple Featured Video" meta box Enabled in The Post Section, The Plugin will also offer you to change this From the Setting Section.

There are lots of options to display the video on pages and posts. In plugin settings page, there is an option to display video along with contents and excerpts of posts.

Also, Shortcodes are there to display the video on the page or post.

Bypassing Arguments like post id in shortcodes, you can display the featured video of that post.

To display the video on post page use shortcode : [sfv_video_show]

in code add shortcode like below :

<?php echo do_shortcode(['sfv_video_show']);?>

Also,ith post id you can display the video by using below shortcode :

<?php echo do_shortcode(['sfv_show_by_postid' postid="12"]);?>

Also this plugin is compatible with WooCommerce  product page.In back end of plugin settings page, there are lots of options available, from there you can choose the position of video. 

== Features ==
 
* Simple settings
* Support on custom posts types, pages, and posts
* Support WooCommerce product page
* Options to display video along with contents, excerpts
* Options to display video on different sections of WooCommerce products page.    



== Screenshots ==

1. Selecting post type from the settings.
2. Upload video button on posts .
3. Video uploaded screenshot.
4. Video uploaded in pages.



== Installation ==

= Admin Installer via search =
1. Visit the Add New plugin screen and search for "Simple Featured Video".
2. Click the "Install Now" button.
3. Activate the plugin.
4. Navigate to the settings >> "Simple Featured Video" Menu.

= Admin Installer via zip =
1. Visit the Add New plugin screen and click the "Upload Plugin" button.
2. Click the "Browse..." button and select zip file from your computer.
3. Click "Install Now" button.
4. Once done uploading, activate Simple Featured Video.

= Manual =
1. Upload the Simple Featured Video folder to the plugins directory in your WordPress installation.
2. Activate the plugin.
3. Navigate to the settings >> "Simple Featured Video" Menu.

After installation and activation of plugin go to settings >> "Simple Featured Video" Menu .

Select the post types , in which you want to display the video.

To display the video on post page use short code : [sfv_video_show]

In code add shortcode like below :

<?php echo do_shortcode(['sfv_video_show']);?>

Also with post id you can display the video by using below shortcode :

<?php echo do_shortcode(['sfv_show_by_postid' postid="12"]);?>

Use below code if you want to display the video with code: 

	global $post;
	$postid = $post->ID;
	$meta_key = 'featured_video_uploading';
	$meta_value = get_post_meta($postid, $meta_key, true);
	if( $media = wp_get_attachment_url($meta_value)) {  // getting video here
		$image = '<video controls="" src="'.$media.'" style="max-width:100%;display:block;"></video>';
		echo $image;
	}

== Frequently Asked Questions ==

1. How to select multiple post type?
	
	once you installed the plugin you can see settings in wordpress "Settings" menu
	
	Go to Settings >> Simple Featured Video
	Here you can select the posts type , pages, posts , in which you want to display the video.

2. How to upload large size video?

	Thats purely depends upon the uploading limit of your website configuration, check php-ini, htaccess, wp-config etc..

3. How to display video by passing the post id?

	Using shortcode [sfv_show_by_postid], you can display the video by post id.
	eg: - : [sfv_show_by_postid postid=""5"]
	
4. How to display video while listing the posts of a post type?

	you can display the video in listing posts, using the same shortcode [sfv_video_show] as below :

	<?php query_posts('post_type=post');  // post type 'post' ,change this to page,or other post type
	if ( have_posts() ) : while ( have_posts() ) : the_post();?> 
	<div class="col-lg-4 text-center">
	<?php the_post_thumbnail('thumbnail'); ?>
	<?php echo do_shortcode('[sfv_video_show]'); ?> // shortcode
	<h2><?php the_title();?></h2>
	<?php the_content(); ?>
	<p><a class="btn btn-primary" href="<?php the_permalink(); ?>" role="button">ReadMore</a></p>
	</div>
	<?php endwhile; endif;  ?>


== Changelog ==

= 1.0 - 2019-05-22  

- First version

= 1.1

Updated for woocommerce products also.
Different options implemented to display video on woocommerce product page. 
Along with manual adding shortcodes, implemented feature to automatically adding video with post contents or excerpts based on the options in back end.
Fixed some bugs in 1.0 version.

= 1.2

Updated plugin to 1.2
Feature to replace featured image with featured video if available

= 1.3

Updated plugin to 1.3
Some functions updated for latest woocommerce.