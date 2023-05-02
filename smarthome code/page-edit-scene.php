<?php /* Template Name:Edit Scene Template */ ?>
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


	<main >
		<body>
	    <div class="navBack navGrid">
	      <button onclick="history.back(-1)" >Back</button>
	      <p class="center navHeading">Edit Scene</p>
	      <button><a href="<?php echo get_site_url(); ?>/setting/">Setting</a></button>
	    </div>

      <div class="center black">
				<?php
					$scene_id = $_GET['scene_id'];
					$room_id = $_GET['room_id'];

				$redirect_url = get_site_url() ."/rooms/?room_id=".$room_id;


				acf_form(array(
				 'id' => 'scene-form',
				 'post_id'       => $scene_id,
				 'new_post'      => array(
						 'post_type'     => 'scene',
						 'post_status'   => 'publish'
				 ),
					'field_groups'  => array('group_63ffa58833682'),
					'submit_value' => "Create Scene",



				 'return'      => 	$redirect_url,
				)); ?>




          ?>





			</div>

      <div id="content">



</div>






	    </div>
	  </body>


	</main>

	<!-- #main -->

<?php
get_sidebar();
get_footer();
