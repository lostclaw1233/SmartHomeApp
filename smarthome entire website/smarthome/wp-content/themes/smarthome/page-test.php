<?php /* Template Name: Test Template */ ?>
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


	<main id="primary" class="site-main">
		<head>
			<?php wp_enqueue_script('jquery'); ?>
	<script>
	  jQuery(document).ready(function($) {
	    $('#contact-form').submit(function(e) {
	      e.preventDefault();
	      var name = $('#name').val();
	      $.ajax({
	        url: '<?php echo admin_url('admin-ajax.php'); ?>',
	        type: 'post',
	        data: {
	          action: 'submit_name',
	          name: name
	        },
	        success: function(response) {
	          $('#response').html(response);
	        }
	      });
	    });
	  });
	</script>
		</head>




    <?php acf_form_head(); ?>
    <?php get_header(); ?>
		<body>

			<form id="contact-form" method="post">
  <label for="name">Name:</label>
  <input type="text" id="name" name="name" required>
  <button type="submit">Send</button>
</form>
<div id="response"></div>
 		</body>


	</main>

	<!-- #main -->

<?php
get_sidebar();
get_footer();
