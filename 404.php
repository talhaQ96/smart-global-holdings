<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Coalition_Technologies
 */

get_header();
?>

<main id="primary" class="site-main">
	<section class="not-found has-padding-eq">
		<div class="container">
			<div class="wrapper">
				<h2>404 Oops</h2>
				<p>It looks like nothing was found at this location. Maybe try one of the links below or a search?</p>
				<?php get_search_form(); ?>
				<a href="<?php echo get_site_url(); ?>" class="button">Go Back To Home</a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
