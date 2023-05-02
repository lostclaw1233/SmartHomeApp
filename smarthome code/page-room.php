<?php /* Template Name:Room Template */ ?>
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

	$room_id = $_GET['room_id'];
?>




<script type="text/javascript">

//function to show scenes or buttons depending on button clicked it will hide the other
function showScenes(){
	var x = document.getElementById("scenes");
	var y = document.getElementById("devices");
	var sceneButton = document.getElementById("sceneButton");
	var deviceButton = document.getElementById("deviceButton");



	if(x.style.display != "grid"){

		y.style.display = "none";
		x.style.display = "grid";

		deviceButton.classList.remove("active");
sceneButton.classList.add("active");

	}

}

function showDevices(){
	var x = document.getElementById("scenes");
	var y = document.getElementById("devices");

	if(y.style.display != "grid"){
		x.style.display = "none";
		y.style.display = "grid";

		sceneButton.classList.remove("active");
deviceButton.classList.add("active");

	}
}



jQuery(document).ready(function($){
			var room_id = '<?php echo	$room_id; ?>';

			$( ".roomDelete").click(function(){
				$.ajax({
					url:ajaxurl,
					data: {
						'action':'ajax_delete_post', // This is our PHP function below
						'id' : room_id, // This is the variable we are sending via AJAX
						'object': "room"
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

});


</script>

		<body>

    	<div class="navBack navGrid">
       <button  ><a href="<?php echo get_site_url(); ?>/home">Back</a></button>
				<?php
				// Retrieve the room ID from the query parameter



				// Get the room name and image using the room ID
				$room_name = get_post_meta($room_id, 'room_name', true);
				$image_id = get_post_meta($room_id, 'room_image', true);
				$image = wp_get_attachment_image($image_id, 'large');

				// Output the room name and image
				echo "<div class='headerThumbnail'>
				<div class='headerTitle text-shadow'>$room_name</div>
				<div class='headerImage'>$image</div>
				<div class='edit'><a  href='" . get_site_url() . "/edit-room/?room_id=$room_id'>edit</a></div>
				</div>"

				?>


      	<button><a href="<?php echo get_site_url(); ?>/setting/">Setting</a></button>
    	</div>



			<button class="roomDelete"> <a  href="<?php echo get_site_url(); ?>/home"> Delete</a> </button>
			<div class=" deviceSceneButton">

				<button id="deviceButton"  type="button" name="button" onclick="showDevices()" class="active" >Devices</button>

				<button  id="sceneButton" type="button" name="button" onclick="showScenes()">Scenes</button>

			</div>



			<div class="pageGrid " id="scenes" style="display: none;">

					<button class="item" ><a href="<?php echo get_site_url(); ?>/create-scene/?room_id=<?php echo $room_id; ?>">add Scene</a></button>
						<?php display_scenes($room_id); ?>
			</div>

			<div class="deviceGrid " id="devices">


					<button class="item "><a href="<?php echo get_site_url(); ?>/add-device/?room_id=<?php echo $room_id; ?>">add Device</a></button>

						<?php
						update_device_titles_from_room_names($room_id);
						display_devices($room_id); ?>



			</div>






  	</body>






<?php
get_sidebar();
get_footer();
