<?php /* Template Name:Scene Template */ ?>
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
// Retrieve the room ID from the query parameter
$scene_id = $_GET['scene_id'];
	$room_id = $_GET['room_id'];

?>
<script type="text/javascript">
//ajax delete device
jQuery(document).ready(function($){
			var scene_id = '<?php echo	$scene_id; ?>';


			$( ".roomDelete").click(function(){
				$.ajax({
					url:ajaxurl,
					data: {
						'action':'ajax_delete_post', // This is our PHP function below
						'id' : scene_id, // This is the variable we are sending via AJAX
						'object': "scene"
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

		//filter the scene devices to the room
			var room_id = <?php echo ( $room_id ); ?>;

    $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
            'action': 'my_filter_posts',
            'room_id': room_id,
        },
        success: function(response) {
            // Display the filtered results
        },
    });

});

</script>




		<body>
    	<div class="navBack navGrid">
      	<button  ><a href="<?php echo get_site_url(); ?>/rooms/?room_id=<?php echo $room_id; ?>">Back</a></button>
				<?php



				// Get the room name and image using the room ID
				$scene_name = get_post_meta($scene_id, 'scene_name', true);


				// Output the room name and image
				echo "<div class='headerThumbnail'>
				<div class='headerTitle'>$scene_name</div>

				</div>"

				?>


      	<button><a href="<?php echo get_site_url(); ?>/setting/">Setting</a></button>
    	</div>








			<div class="pageGrid" id="sceneGrid" >
	<div class="item">
			<button class="roomDelete">	 <a  href="<?php echo get_site_url(); ?>/rooms/?room_id=<?php echo $room_id; ?>"> delete</a></button>
	</div>
				<?php
				#checkForRemovedDevices($scene_id,$room_id);
				update_scene_devices($scene_id);
				display_scene_devices($scene_id,$room_id);


				?>
			</div>





			</div>



  	</body>



	<!-- #main -->

<?php
get_sidebar();
get_footer();
