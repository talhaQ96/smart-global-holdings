<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Coalition_Technologies
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php 	
		if (have_posts()):
			if (is_home() && ! is_front_page()):
	?>
				<section class="section-archive has-padding-eq">
					<div class="container">
						<?php get_template_part('templates/archives/content'); ?>
					</div>
				</section>
	<?php
			endif;
		
		else:
			get_template_part('templates/content', 'none');
			
		endif;
	?>
</main>

<?php get_footer(); ?>
