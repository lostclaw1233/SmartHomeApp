<?php /* Template Name:Setting Template */ ?>
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


	<main >
	<body>
		<div class="navBack navGrid">
			<button onclick="<?php echo get_site_url(); ?>/home" >Back</button>
			<p class="center navHeading">Settings</p>
			<button><a href="<?php echo get_site_url(); ?>/setting/">Setting</a></button>
		</div>
		<div class="pageGrid">
			<div class="item"><button class="clean">Volume</button></div>
			<div class="item"><button>Dark Mode</button></div>
			<div class="item"><button>Help</button></div>
			<div class="item">
				<button><a href="<?php echo get_site_url(); ?>">Log Out</a></button>
			</div>
		</div>
	</body>


	</main>

	<!-- #main -->

<?php
get_sidebar();
get_footer();
