<?php /* Template Name:Scene Device Template */ ?>
<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package smart_home
 */
acf_form_head();
get_header();


?>





		<body>

    	<div class="navBack navGrid">
      	<button onclick="history.back(-1)" >Back</button>
				<?php
				// Retrieve the room ID from the query parameter
				$device_id = $_GET['device_id'];
					$scene_id =  $_GET['scene_id'];
					$room_id =  $_GET['room_id'];


				// Get the room name and image using the room ID
				$device_name = get_post_meta($device_id, 'device_name', true);


				// Output the room name and image
				echo "<div class='headerThumbnail'>
				<div class='headerTitle'>$device_name</div>

				</div>";


				#add_filter('acf/prepare_field/name=scene_id', 'hideField');

				?>


      	<button><a href="<?php echo get_site_url(); ?>/setting/">Setting</a></button>
    	</div>

			<div class="center">



			<?php

			$redirect_url =  get_site_url() ."/scenes/?scene_id=$scene_id&room_id=$room_id";
							acf_form(array(



			    'post_id'       => 'new_post',
			    'new_post'      => array(
			        'post_type'     => 'scene_device',
			        'post_status'   => 'publish'
			    ),
			    'field_groups'  => array('group_64255421f17c6'),
			    'submit_value'  => "Create Scene Device",
					'return' =>  $redirect_url ,






			)); ?>


			</div>




			</div>





			</div>



  	</body>




	<!-- #main -->

<?php
get_sidebar();
get_footer();
