<?php /* Template Name:Home Template */ ?>
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


?>

<script
src="https://code.jquery.com/jquery-3.6.4.min.js"
integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
crossorigin="anonymous"></script>


	<main >


		<body>
    	<div class="navBack navGrid">
      	<button onclick="history.back(-1)" >Back</button>
      	<p class="center navHeading">Rooms</p>
      	<button><a href="<?php echo get_site_url(); ?>/setting/">Setting</a></button>
    	</div>

    	<div class="pageGrid" id="pageGrid">
				<?php


				#delete_all_room_data();

				display_rooms();



				?>












			<div class="item">
					<button ><a href="<?php echo get_site_url(); ?>/create-room/">+</a></button>
			</div>



  </div>







  	</body>


	</main>

	<!-- #main -->

<?php
get_sidebar();
get_footer();
