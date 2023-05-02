

<?php /* Template Name:Add Device Template */ ?>
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
<?php  $room_id = $_GET['room_id'];?>

	<main >
		<body>
    	<div class="navBack navGrid">
      	<button onclick="history.back(-1)" >Back</button>
      	<p class="center navHeading">Add a Device</p>
      	<button><a href="<?php echo get_site_url(); ?>/setting/">Setting</a></button>
    	</div>
			<div class="center black">
        <?php

				  $redirect_url = get_site_url() ."/rooms/?room_id=".$room_id;




					add_filter('acf/prepare_field/name=light_level', 'hideField');
					add_filter('acf/prepare_field/name=volume_level', 'hideField');
					add_filter('acf/prepare_field/name=heater_level', 'hideField');





				acf_form(array(



    'post_id'       => 'new_post',
    'new_post'      => array(
        'post_type'     => 'device',
        'post_status'   => 'publish'
    ),
    'field_groups'  => array('group_63f65e1f9b23b'),
    'submit_value'  => "Add Device",
		'return' =>  $redirect_url ,






));

?>



			</div>

			<div class="pageGrid">

			</div>

  	</body>


	</main>

	<!-- #main -->

<?php
get_sidebar();
get_footer();
