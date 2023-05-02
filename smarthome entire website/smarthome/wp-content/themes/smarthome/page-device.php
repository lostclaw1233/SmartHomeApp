<?php /* Template Name:Device Template */ ?>
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

get_header();

	$device_id = $_GET['device_id'];
	$room_id = $_GET['room_id'];

	$device_type = get_post_meta($device_id,'device_type',true);


#get the right field
	if($device_type == "light"){
		$device_level= 	get_post_meta($device,"light_level",true);
		$level_name = "light level";
	}elseif($device_type == "speaker"){
		$device_level= 	get_post_meta($device,"volume_level",true);
		$level_name = "volume level";
	}elseif($device_type == "heater"){
		$device_level= 	get_post_meta($device,"heater_level",true);
		$level_name = "heater level";
	}


?>

<script type="text/javascript">
//ajax delete device
jQuery(document).ready(function($){
			var device_id = '<?php echo	$device_id; ?>';

			$( ".roomDelete").click(function(){
				$.ajax({
					url:ajaxurl,
					data: {
						'action':'ajax_delete_post', // This is our PHP function below
						'id' : device_id, // This is the variable we are sending via AJAX
						'object': "device"
					},
					success:function(data) {
			// This outputs the result of the ajax request (The Callback)
							$(".delete").text(data);
					},
					error: function(errorThrown){
							window.alert(errorThrown);
					}

				});
			});


		//listern to slider changes and they use ajax to update the post meta field
			$("#slider").on('input', function(){
				var val = $(this).val();
				//get device field type
				var device_type = '<?php echo	$device_type; ?>';

				$.ajax({
		      url: ajaxurl,
		      type: "POST",
		      data: {
		        action: "ajax_update_slider",
						'id' : device_id,
		        'device_type': device_type,
		        'field_value': val
		      },
					success: function(data) {
		        // Handle the AJAX response.
		      }
		    });

			});



});




</script>


		<body>


    	<div class="navBack navGrid">
      	<button  ><a href="<?php echo get_site_url(); ?>/rooms/?room_id=<?php echo $room_id; ?>">Back</a></button>
				<?php
				// Retrieve the room ID from the query parameter



				// Get the room name and image using the room ID
				$device_name = get_post_meta($device_id, 'device_name', true);


				// Output the room name and image
				echo "<div class='headerThumbnail'>
				<div class='headerTitle'>$device_name</div>

				</div>"

				?>


      	<button><a href="<?php echo get_site_url(); ?>/setting/">Setting</a></button>
    	</div>








			<div class="pageGrid " >
				<div class="item">
						<button  class="roomDelete"><a  href="<?php echo get_site_url(); ?>/rooms/?room_id=<?php echo $room_id; ?>"> delete</a></button>
				</div>

				<div class="item">
						<p><?php echo $level_name; ?></p>
				</div>
					<div class="item">


							<input id="slider" type="range" min="0" max="100" value= "<?php echo $device_level; ?>" oninput="this.nextElementSibling.value = this.value">
							<output><?php echo $device_level; ?></output>

					</div>





			</div>





			</div>



  	</body>




	<!-- #main -->

<?php
get_sidebar();
get_footer();
