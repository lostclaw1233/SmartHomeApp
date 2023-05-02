<?php /* Template Name: Login Template */ ?>
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

 $image = get_field('image');
 $picture = $image['sizes']['large'];
?>


	<main id="primary" class="site-main">

		<body>
	 <div class="navBack navGrid">
		 <p class="center navHeading"></p>
		 <button><a href="<?php echo get_site_url(); ?>/setting/">Setting</a></button>
	 </div>

	 <div class="logInGrid">
		 <div class="item">
			 <img src="<?php echo $picture; ?>" alt="">

		 </div>

		 <div class=" item">
			 <button class="logInButton"><a href="<?php echo get_site_url(); ?>/home/">Log In</a></button>
		 </div>
	 </div>
 </body>


	</main>

	<!-- #main -->

<?php
get_sidebar();
get_footer();
