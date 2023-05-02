<?php
/**
 * smart_home functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package smart_home
 */



if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


/* acf */




/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function smart_home_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on smart_home, use a find and replace
		* to change 'smart_home' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'smart_home', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );


	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'smart_home' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'smart_home_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'smart_home_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function smart_home_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'smart_home_content_width', 640 );
}
add_action( 'after_setup_theme', 'smart_home_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function smart_home_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'smart_home' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'smart_home' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'smart_home_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function smart_home_scripts() {
	wp_enqueue_style( 'smart_home-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'smart_home-style', 'rtl', 'replace' );

	wp_enqueue_script( 'smart_home-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'my-script', get_template_directory_uri() . '/js/ajax.js', array( 'jquery' ), '1.0', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'smart_home_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

#create post types

function create_room_post_type() {
  register_post_type( 'room',
    array(
      'labels' => array(
        'name' => __( 'room' ),
        'singular_name' => __( 'room' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );

	register_post_type( 'device',
    array(
      'labels' => array(
        'name' => __( 'device' ),
        'singular_name' => __( 'device' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
	register_post_type( 'scene',
    array(
      'labels' => array(
        'name' => __( 'scene' ),
        'singular_name' => __( 'scene' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}
add_action( 'init', 'create_room_post_type' );




# filter that hides the field in the form
function hideField($field){

		$field['wrapper']['class'] .= ' acf-hidden';
		return $field;
}
#hide relationship  room field
add_filter('acf/prepare_field/name=room_id', 'hideField');



#function that gets all the post meta room_name
function get_room_Ids(){
global $wpdb;
 $table_name = $wpdb->prefix . 'postmeta';
 	#get all posts with room name in metakey
 $results = $wpdb->get_results("SELECT * FROM $table_name WHERE meta_key = 'room_name'");


$item_ids = array();

// Loop through each row of data
foreach ($results as $row) {
    // Get the post ID for this meta row
    $post_id = $row->post_id;
		$room_ids[] = $post_id;


	}

#return $ids of rooms;
return $room_ids;

}




#function to get all ids related to room using its id  whether it be device or scenes
function get_room_item_IDS($room_id,$item){
	global $wpdb;
	 $table_name = $wpdb->prefix . 'posts';

	 #if statement depending if item is device or scene
	 if($item == 'device'){
		 $results = $wpdb->get_results("SELECT * FROM $table_name WHERE post_type = 'device'");
	 }
	 elseif($item == 'scene'){
		 $results = $wpdb->get_results("SELECT * FROM $table_name WHERE post_type = 'scene'");
	 }
	 #getting all the ids
	 $item_ids = array();
	 foreach ($results as $result) {
		 $room_link = get_post_meta($result->ID, 'room_id', true);
		 if($room_id == $room_link[0]){


				$item_ids[] = $result->ID;

		 }
	 }
		return  $item_ids;
}




#function to display all the devices of the room
function display_devices($room_id){
	#get all devices linked with room
	#returns device ids linked to room
	$devices_ids =get_room_item_IDS($room_id,'device');


	#goes through each device and gets it name and type
	foreach($devices_ids as $devices){
		$device_name = get_post_meta($devices,'device_name',true);
		$device_type =  get_post_meta($devices, 'device_type', true);
		#error_log("device type".$device_type);
		#get device type
		if($device_type == "light"){
			$level = get_post_meta($devices, 'light_level', true);
		}elseif($device_type == "speaker"){
			$level = get_post_meta($devices, 'volume_level', true);
		}elseif($device_type == "heater"){
			$level = get_post_meta($devices, 'heater_level', true);
		}
		# check if the device is on based on the light level
		$device_status = $level > 0 ? 'On' : 'Off';

		#html for the device display
		echo "<button class='item'>
		<span class='status '>$device_status</span>
	<a href='" . get_site_url() . "/devices/?device_id=$devices&room_id=$room_id' class='roomName'>$device_name</a>

		</button>";
	}

}


#function to display all the scenes of the room
function display_scenes($room_id){
	#get all scenes linked with room
	$scenes_ids =get_room_item_IDS($room_id,'scene');


	#go through each scene and display it
	foreach($scenes_ids as $scenes){
		$scene_name = get_post_meta($scenes,'scene_name',true);

		echo "<div class='item'><button>
	<a href='" . get_site_url() . "/scenes/?scene_id=$scenes&room_id=$room_id' >$scene_name</a>
	<div class='edit'><a  href='" . get_site_url() . "/edit-scene/?scene_id=$scenes&room_id=$room_id'>edit</a></div>
		</button></div>";
	}
}






#function to see if device is still in scene if not delete the scene device setting
function update_scene_devices($scene_id){



		#get all scene device settings posts
		$scene_device_posts = get_posts(array(
			'post_type' => 'scene_device',
			'meta_query' => array(
					array(
							'key' => 'scene_id',
							'value' => serialize(strval($scene_id)),
							'compare' => 'LIKE',
					),
			),
			'numberposts' => -1,
		));

			 $scene_devices = get_post_meta($scene_id,'scene_devices',true);

    #for loop to check if scene device is in scene's scene devices field
   foreach($scene_device_posts as $post){

			 #chcek if it is in scene devices_ids
			 $device_id = get_post_meta($post->ID, 'device_id', true);
			 error_log($device_id. " scene device id");
			 if(!in_array($device_id,$scene_devices)){
				error_log("no its not");

			 	wp_delete_post($post->ID, true);

			}

   }


}



#display the scene device settings in the scene

function display_scene_devices($scene_id,$room_id){

	error_log("scene id" .$scene_id);
  #get device ids from field
  $scene_devices = get_post_meta($scene_id,'scene_devices',true);


	#loop to go through all the scene devices to check if they have been intialised
  foreach($scene_devices as $device){
    $device_name = get_post_meta($device,'device_name',true);
		 error_log("device name and id ".$device_name.$device);
		 #check if the device already has a scene device setting
		 $scene_device_setting_id =get_scene_device_id($scene_id, $device);
		 #scene device already intiliased so they can edit
		 if(!empty($scene_device_setting_id)){
			 echo "<button class='item'>
               <a href='" . get_site_url() . "/edit-scene-device/?device_id=$device&scene_id=$scene_id&post_id=$scene_device_setting_id&room_id=$room_id' class='roomName'>$device_name</a>
             </button>";
		 }else{
			 #the device has not been used in the scene device setting
			 echo "<button class='item'>
							 <a href='" . get_site_url() . "/scene-device/?device_id=$device&scene_id=$scene_id&room_id=$room_id' class='roomName'>$device_name</a>
						 </button>";
		 }

  }
}




#check if there is already a scene device setting
function get_scene_device_id($scene_id, $device){
	#gets scene device setting with given parameters
	$scene_device_ID = get_posts(array(
		'post_type' => 'scene_device',
		'meta_query' => array(
				array(
						'key' => 'scene_id',
						'value' => serialize(strval($scene_id)),
						'compare' => 'LIKE',
				),
				array(
						'key' => 'device_id',
						'value' => $device,
						'compare' => 'LIKE',
				),
		),
		'numberposts' => -1,
	));

	foreach ($scene_device_ID as $post) {
			 return $post->ID;
	 }

}





#function to delete the room and all the devices and scenes and scene devices associated
function delete_room($room_id){
		#error_log("delete button");
		#get all devices
		$related_devices = get_posts(array(
            'post_type' => 'device',
            'meta_query' => array(
                array(
                    'key' => 'room_id',
                    'value' => serialize(strval($room_id)),
                    'compare' => 'LIKE',
                ),
            ),
            'numberposts' => -1,
        ));
				# get all scenes
				$related_scenes = get_posts(array(
								'post_type' => 'scene',
								'meta_query' => array(
										array(
												'key' => 'room_id',
												'value' => serialize(strval($room_id)),
												'compare' => 'LIKE',
										),
								),
								'numberposts' => -1,
						));






		// Delete each related 'scene' post
			foreach ($related_scenes as $scene) {
				#get all scene device settings
						$related_scene_devices = get_posts(array(
									'post_type' => 'scene_device',
										'meta_query' => array(
												array(
														'key' => 'scene_id',
														'value' => serialize(strval($scene->ID)),
														'compare' => 'LIKE',
												),
										),
										'numberposts' => -1,
									));
									##delete all scene device settings
									foreach ($related_scene_devices as $scene_device) {
																		wp_delete_post($scene_device->ID, true);
												}
						            wp_delete_post($scene->ID, true);
					  }

		// Delete each related 'device' post
		  foreach ($related_devices as $device) {
		            wp_delete_post($device->ID, true);
	  }

    #delete room
    wp_delete_post($room_id, true);
}






#delete all post data
function delete_all_room_data(){
	$room_ids = get_room_Ids();
	foreach ($room_ids as $room_id) {
		delete_room($room_id);

	}
}



#function to display the rooms created
function display_rooms(){
	#gets all the room ids
	$room_ids = get_room_Ids();
	#goes through all the rooms
  foreach ($room_ids as $room_id) {

    $room_name = get_post_meta($room_id,'room_name',true);
    $image = get_post_meta( $room_id, 'room_image', true );
    $room_image = wp_get_attachment_image($image, 'small');
		echo "<div class='item'>

		<a href='" . get_site_url() . "/rooms/?room_id=$room_id' class='roomName text-shadow'>$room_name</a>
		<div class='edit'><a  href='" . get_site_url() . "/edit-room/?room_id=$room_id'  class='text-shadow'>edit</a></div>
		<div class='imageThumbnail'> $room_image </div>
		</div>";
  }

}













#function to update the device posts so that the title is the device name
add_action('acf/save_post', 'update_post_title', 20);
function update_post_title($post_id) {
	if(get_post_type($post_id) == 'device'){
		$post = get_post($post_id);
		$post_title = get_field('device_name',$post_id);
	 // Update the post title
	 $post->post_title = $post_title;

	  wp_update_post($post);
	}

}

#links scene to room using relationship field
function load_room_id( $field ) {
	$room_id = $_GET['room_id'];


	 // Make sure that $room_id is an integer value
	 $room_id = absint( $room_id );
	 // Set the default value of the field to the room ID
	 $field['default_value'] = $room_id;

	 return $field;
}





add_filter( 'acf/load_field/name=room_id', 'load_room_id' );

#load the scene id
function load_scene_id($field){
		$scene_id = $_GET['scene_id'];
		#error_log("secene ".$scene_id);
		$device_id =  $_GET['device_id'];

	$scene_id = absint($scene_id);
	$field['default_value'] = $scene_id;

	return $field;


}
add_filter( 'acf/load_field/name=scene_id', 'load_scene_id' );
add_filter('acf/prepare_field/name=scene_id', 'hideField');
add_filter('acf/prepare_field/name=device_id', 'hideField');

#function to load the device id in acf form
function load_device_id($field){

		$device_id =  $_GET['device_id'];

	$scene_id = absint($device_id);
	$field['default_value'] = $device_id;

	return $field;


}

add_filter( 'acf/load_field/name=device_id', 'load_device_id' );


#load device type for scene devices
function load_device_type($field){
	$device_id =  $_GET['device_id'];
	error_log("device ".$device_id);
	$device_type = get_post_meta($device_id, 'device_type', true);
	error_log("device type ".$device_type);
	$field['default_value'] = $device_type;

		return $field;
}
add_filter( 'acf/load_field/name=device_type', 'load_device_type' );

#put room name in front of post title for post object search
function update_device_titles_from_room_names($room_id) {
    // Get all device posts
    $device_posts = get_posts(array(
        'post_type' => 'device',
        'posts_per_page' => -1 // Get all posts
    ));



    // Loop through each device post
    foreach ($device_posts as $device_post) {



					$device_room_id = get_post_meta($device_post->ID,'room_id',true);

						#check if room is same as room_id
					if(in_array($room_id,$device_room_id)){
						#error_log("true");
						$room_name = get_post_meta($room_id, 'room_name', true);
						#error_log("device room name ".$room_name);
						$device_title = $device_post->post_title;
						$new_title = "$room_name $device_title";
						error_log($new_title);
						// Check if room name is already present in device title
						 if (strpos($device_title, $room_name) === false) {
						 // If room name is not present, add it to the device title

							# error_log("true");
								 wp_update_post(array(
										 'ID' => $device_post->ID,
										 'post_title' => $new_title
								 ));

					 }
					}



    }
}






#delete scene and its scene devices
function delete_scene($scene_id){


	#delete all scene devices
	#get all scene device settings
			$related_scene_devices = get_posts(array(
						'post_type' => 'scene_device',
							'meta_query' => array(
									array(
											'key' => 'scene_id',
											'value' => serialize(strval($scene_id)),
											'compare' => 'LIKE',
									),
							),
							'numberposts' => -1,
						));
						##delete all scene device settings
						foreach ($related_scene_devices as $scene_device) {
															wp_delete_post($scene_device->ID, true);
						}

	#delete scene
	  wp_delete_post($scene_id, true);
}

function delete_device($device_id){

		#delete device
	 wp_delete_post($device_id, true);

}













/**
* WP AJAX Call Frontend
*/

//Load jQuery
wp_enqueue_script('jquery');

//Define AJAX URL
function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'myplugin_ajaxurl');


#delete room using ajax
function ajax_delete_post(){
	if ( isset($_REQUEST) ) {
		#get room id
		$post = $_REQUEST['object'];
		#checks what type to delete
		if($post == "room"){
			$room = $_REQUEST['id'];
			delete_room($room);
		}elseif ($post == "scene") {
			$scene = $_REQUEST['id'];
			error_log($scene);
			delete_scene($scene);
		}elseif ($post == "device") {
			$device = $_REQUEST['id'];
			error_log($device);
			delete_device($device);
		}


	}

 die();
}

add_action( 'wp_ajax_ajax_delete_post', 'ajax_delete_post' );
add_action( 'wp_ajax_nopriv_ajax_delete_post', 'ajax_delete_post' );


#function to allow user to dynamically update the device level
function ajax_update_slider(){
	if ( isset($_REQUEST) ) {
		#get device type

		$device_type = $_REQUEST['device_type'];
		$value = $_REQUEST['field_value'];
			$device = $_REQUEST['id'];

		#error_log("device type and value " .$device_type." ".$value);
		#update the level depending on type
		if($device_type == "light"){
				update_post_meta($device,"light_level",$value);
		}elseif($device_type == "speaker"){
				update_post_meta($device,"volume_level",$value);
		}elseif($device_type == "heater"){
				update_post_meta($device,"heat_level",$value);
		}




	}

 die();

}

add_action( 'wp_ajax_ajax_update_slider', 'ajax_update_slider' );
add_action( 'wp_ajax_nopriv_ajax_update_slider', 'ajax_update_slider' );
