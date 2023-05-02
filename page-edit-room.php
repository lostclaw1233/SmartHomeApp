<?php /* Template Name:Edit Room Template */ ?>
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
$roomType = get_field('room_type');
$room_id = $_GET['room_id'];

?>


	<main >
		<body>
	    <div class="navBack navGrid">
	      <button onclick="history.back(-1)" >Back</button>
	      <p class="center navHeading">Edit Room</p>
	      <button><a href="<?php echo get_site_url(); ?>/setting/">Setting</a></button>
	    </div>

      <div class="center black">
				<?php




         acf_form(array(

    	        'post_id'       => $room_id,
    	        'new_post'      => array(
    	            'post_type'     => 'room',
    	            'post_status'   => 'publish'
    	        ),
    					'field_groups' => array('group_63ef6de7256aa'),
    	        'submit_value'  => __("Edit Room", 'acf'),
              'return' =>  get_site_url()."/home/",

    	    ));




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
